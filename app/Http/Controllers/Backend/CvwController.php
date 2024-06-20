<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Target;
use App\Models\Timeline;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class CvwController extends Controller
{
    public $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function index()
    {
        return view('backend.monitoring.cvw.index');
    }

    public function data()
    {
        $targets = \DB::table('targets as tg')
        ->join('locations as locc', function ($join) {
            $join->on('tg.location_id', '=', 'locc.id')
                 ->whereNull('tg.deleted_at')
                 ->whereRaw('locc.project_id = tg.project_id');
        })
        ->join('timelines as tmm', function ($join) {
            $join->on('tg.timeline_id', '=', 'tmm.id')
                 ->whereNull('tmm.deleted_at')
                 ->whereRaw('tmm.project_id = tg.project_id');
                //  ->where('tmm.is_active', '=', true);
        })
        ->where('tg.project_id', $this->project_id)
        ->whereNull('tg.deleted_at')
        ->select(
            'tg.id',
            'tg.project_id',
            'tg.location_id',
            'tg.timeline_id',
            'locc.location_name',
            'locc.location_percent',
            'tg.plan_kumulatif',
            'tg.real_kumulatif',
            'tmm.time_week',
            // \DB::raw('(tg.real_kumulatif - tg.plan_kumulatif) AS deviasi'),
            // \DB::raw('(locc.location_percent - (tg.real_kumulatif - tg.plan_kumulatif)) AS progress')
        );

        return DataTables::of($targets)
            ->addColumn('action', function ($target) {
                return '<a href="'.route('backend.monitoring.cvw.edit', $target->id).'" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded">Edit</a>
                        <form action="'.route('backend.monitoring.cvw.destroy', $target->id).'" method="POST" class="inline">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Delete</button>
                        </form>';
            })
            ->toJson();
    }

    public function create()
    {
        $timelines = Timeline::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        $locations = Location::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        return view('backend.monitoring.cvw.create', compact('timelines', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'timeline_id' => 'required|numeric',
            'location_id' => 'required|numeric',
            'plan_kumulatif' => 'required|numeric',
            'real_kumulatif' => 'required|numeric',
        ]);

        Target::create([
            'timeline_id' => $request->timeline_id,
            'location_id' => $request->location_id,
            'plan_kumulatif' => $request->plan_kumulatif,
            'real_kumulatif' => $request->real_kumulatif,
            'project_id' => $this->project_id,
        ]);

        return redirect()->route('backend.monitoring.cvw.index');
    }

    public function edit($id)
    {
        $timelines = Timeline::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        $locations = Location::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        $targets = Target::findOrFail($id);
        return view('backend.monitoring.cvw.edit', compact('timelines', 'locations', 'targets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'timeline_id' => 'required|numeric',
            'location_id' => 'required|numeric',
            'plan_kumulatif' => 'required|numeric',
            'real_kumulatif' => 'required|numeric',
        ]);

        $target = Target::findOrFail($id);
        $target->update([
            'timeline_id' => $request->timeline_id,
            'location_id' => $request->location_id,
            'plan_kumulatif' => $request->plan_kumulatif,
            'real_kumulatif' => $request->real_kumulatif,
        ]);

        return redirect()->route('backend.monitoring.cvw.index');
    }

    public function destroy($id)
    {
        Target::findOrFail($id)->delete();
        return redirect()->route('backend.monitoring.cvw.index');
    }
}
