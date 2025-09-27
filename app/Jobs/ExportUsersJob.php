<?php

// app/Jobs/ExportUsersJob.php

namespace App\Jobs;

use App\Exports\UsersExport;
use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $exportRecord;

    public function __construct(Export $exportRecord)
    {
        $this->exportRecord = $exportRecord;
    }

    public function handle()
    {
        $fileName = 'users_export_'.now()->timestamp.'.xlsx';
        $filePath = 'exports/'.$fileName;

        $this->exportRecord->update(['status' => 'processing']);

        try {
            Excel::store(new UsersExport, $filePath, 'public');

            $this->exportRecord->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'status' => 'completed',
            ]);
        } catch (\Exception $e) {
            $this->exportRecord->update(['status' => 'failed']);
            throw $e;
        }
    }
}
