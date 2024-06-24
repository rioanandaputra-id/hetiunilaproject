<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function index()
    {
        return view('backend.masterdata.timeline.index');
    }

    public function data()
    {
        $timelines = Timeline::select([
            'id',
            'project_id',
            'timeline_week',
            'timeline_day',
            'timeline_start',
            'timeline_end',
            'is_active',
        ])
            ->whereNull('deleted_at')
            ->where('project_id', $this->project_id);

        return DataTables::of($timelines)
            ->addColumn('action', function ($timeline) {
                return '<a href="' . route('backend.masterdata.timeline.edit', $timeline->id) . '" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded">Edit</a>
                        <form action="' . route('backend.masterdata.timeline.destroy', $timeline->id) . '" method="POST" class="inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Delete</button>
                        </form>';
            })
            ->toJson();
    }

    public function create()
    {
        return view('backend.masterdata.timeline.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'timeline_week' => 'required|numeric',
            'timeline_day' => 'required|numeric',
            'timeline_start' => 'required|date',
            'timeline_end' => 'required|date',
            'is_active' => 'required|boolean',
        ]);

        Timeline::create([
            'timeline_week' => $request->timeline_week,
            'timeline_day' => $request->timeline_day,
            'timeline_start' => $request->timeline_start,
            'timeline_end' => $request->timeline_end,
            'is_active' => $request->is_active,
            'project_id' => $this->project_id,
        ]);

        return redirect()->route('backend.masterdata.timeline.index');
    }

    public function edit($id)
    {
        $timeline = Timeline::findOrFail($id);
        return view('backend.masterdata.timeline.edit', compact('timeline'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'timeline_week' => 'required|numeric',
            'timeline_day' => 'required|numeric',
            'timeline_start' => 'required|date',
            'timeline_end' => 'required|date',
            'is_active' => 'required|boolean',
        ]);

        $timeline = Timeline::findOrFail($id);
        $timeline->update([
            'timeline_week' => $request->timeline_week,
            'timeline_day' => $request->timeline_day,
            'timeline_start' => $request->timeline_start,
            'timeline_end' => $request->timeline_end,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('backend.masterdata.timeline.index');
    }

    public function destroy($id)
    {
        Timeline::findOrFail($id)->delete();
        return redirect()->route('backend.masterdata.timeline.index');
    }
}
