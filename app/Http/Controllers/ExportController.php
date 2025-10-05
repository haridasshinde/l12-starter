<?php

namespace App\Http\Controllers;

use App\Jobs\ExportUsersJob;
use App\Models\Export;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $query = Export::query()->latest();
        $exports = $query->take(10)->get();

        return response()->json(['data' => $exports]);
    }

    public function store()
    {
        $export = Export::create([
            'file_name' => '',
            'file_path' => '',
            'status' => 'pending',
        ]);

        ExportUsersJob::dispatch($export);

        return redirect()->back()->with('success', 'Export started, please wait...');
    }

    public function list(Request $request)
    {
        // Fetch only exports created today
        $exports = Export::query()
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->take(10)
            ->get();

        // Return JSON for Vue
        return response()->json([
            'data' => $exports
        ]);
    }
}
