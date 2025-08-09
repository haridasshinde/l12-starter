<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateModelsFromDB extends Command
{
    protected $signature = 'generate:models';

    protected $description = 'Generate Eloquent models from existing DB tables with fillable fields and primary key detection, skipping Laravel defaults';

    public function handle()
    {
        // Laravel default tables to skip
        $skipTables = [
            'migrations',
            'users',
            'password_reset_tokens',
            'sessions',
            'cache',
            'cache_locks',
            'jobs',
            'job_batches',
            'failed_jobs',
        ];

        $tables = DB::select('SHOW TABLES');
        $dbName = DB::getDatabaseName();
        $key = 'Tables_in_'.$dbName;

        $modelsPath = app_path('Models');
        if (! is_dir($modelsPath)) {
            mkdir($modelsPath, 0755, true);
        }

        foreach ($tables as $table) {
            $tableName = $table->$key;

            // Skip Laravel's default/system tables
            if (in_array($tableName, $skipTables)) {
                $this->warn("Skipping Laravel default table: $tableName");

                continue;
            }

            // Get columns
            $columns = DB::select("SHOW COLUMNS FROM `$tableName`");

            // Detect primary key
            $primaryKey = 'id';
            $fillable = [];

            foreach ($columns as $col) {
                if ($col->Key === 'PRI') {
                    $primaryKey = $col->Field;
                } else {
                    $fillable[] = $col->Field;
                }
            }

            // Build model name
            $modelName = Str::studly(Str::singular($tableName));
            $filePath = $modelsPath.'/'.$modelName.'.php';

            if (file_exists($filePath)) {
                $this->warn("Model $modelName already exists, skipping...");

                continue;
            }

            // Create model content
            $content = "<?php\n\n";
            $content .= "namespace App\Models;\n\n";
            $content .= "use Illuminate\\Database\\Eloquent\\Model;\n\n";
            $content .= "class $modelName extends Model\n";
            $content .= "{\n";
            $content .= "    protected \$table = '$tableName';\n";
            if ($primaryKey !== 'id') {
                $content .= "    protected \$primaryKey = '$primaryKey';\n";
            }
            $content .= "    public \$timestamps = false;\n";
            $content .= '    protected $fillable = '.var_export($fillable, true).";\n";
            $content .= "}\n";

            file_put_contents($filePath, $content);

            $this->info("Created model: $modelName");
        }

        $this->info('✅ Model generation completed (Laravel defaults skipped)!');

        return Command::SUCCESS;
    }
}
