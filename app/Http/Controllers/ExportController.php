<?php

namespace App\Http\Controllers;

use App\Jobs\ExportUsersJob;
use App\Models\Export;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExportController extends Controller
{
    public function index()
    {
        $exports = Export::latest()->get();
        return Inertia::render('Exports/Index', [
            'exports' => $exports
        ]);
    }

    public function store()
    {
        $export = Export::create([
            'file_name' => '',
            'file_path' => '',
            'status'    => 'pending'
        ]);

        ExportUsersJob::dispatch($export);

        return redirect()->back()->with('success', 'Export started, please wait...');
    }
}
