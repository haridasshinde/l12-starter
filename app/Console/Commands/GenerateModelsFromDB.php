<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateModelsFromDB extends Command
{
    protected $signature = 'generate:models';

    protected $description = 'Generate Eloquent models from existing database tables';

    public function handle()
    {
        $modelsPath = app_path('Models');
        if (! is_dir($modelsPath)) {
            mkdir($modelsPath, 0755, true);
        }

        $tables = DB::select('SHOW TABLES');
        $dbNameKey = 'Tables_in_'.DB::getDatabaseName();

        // Tables we don't want to create models for
        $skipTables = [
            'migrations',
            'password_resets',
            'password_reset_tokens',
            'sessions',
            'cache',
            'cache_locks',
            'jobs',
            'failed_jobs',
            'personal_access_tokens',
            'job_batches',
            'failed_jobs',
        ];

        foreach ($tables as $table) {
            $tableName = $table->$dbNameKey;

            if (in_array($tableName, $skipTables)) {
                $this->info("⏩ Skipping table: {$tableName}");

                continue;
            }

            $this->generateModel($tableName);
        }

        $this->info('✅ Model generation complete!');
    }

    protected function generateModel($tableName)
    {
        $className = Str::studly(Str::singular($tableName));
        $primaryKey = $this->getPrimaryKey($tableName);
        $fillable = $this->getFillableColumns($tableName);

        $timestamps = $this->hasTimestamps($tableName) ? 'true' : 'false';

        $fillableString = "['".implode("', '", $fillable)."']";

        $content = <<<PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class {$className} extends Model
{
    protected \$table = '{$tableName}';
    protected \$primaryKey = '{$primaryKey}';
    public \$timestamps = {$timestamps};
    protected \$fillable = {$fillableString};
}

PHP;

        file_put_contents(app_path("Models/{$className}.php"), $content);
        $this->info("📄 Model created: {$className}");
    }

    protected function getPrimaryKey($table)
    {
        $indexes = DB::select("SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'");

        return $indexes[0]->Column_name ?? 'id';
    }

    protected function getFillableColumns($table)
    {
        $columns = DB::select("SHOW COLUMNS FROM {$table}");
        $fillable = [];

        foreach ($columns as $column) {
            if ($column->Key !== 'PRI') {
                $fillable[] = $column->Field;
            }
        }

        return $fillable;
    }

    protected function hasTimestamps($table)
    {
        $columns = DB::select("SHOW COLUMNS FROM {$table}");
        $colNames = array_map(fn ($col) => $col->Field, $columns);

        return in_array('created_at', $colNames) && in_array('updated_at', $colNames);
    }
}
