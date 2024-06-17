<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Location;
use DataTables;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function index()
    {
        return view('backend.masterdata.location.index');
    }

    public function data()
    {
        $locations = Location::select(['id', 'location_name', 'location_percent'])
            ->whereNull('deleted_at')
            ->where('project_id', $this->project_id);

        return DataTables::of($locations)
            ->addColumn('action', function ($location) {
                return '<a href="'.route('backend.masterdata.location.edit', $location->id).'" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded">Edit</a>
                        <form action="'.route('backend.masterdata.location.destroy', $location->id).'" method="POST" class="inline">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Delete</button>
                        </form>';
            })
            ->toJson();
    }

    public function create()
    {
        return view('backend.masterdata.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required',
            'location_percent' => 'required|numeric',
        ]);

        Location::create([
            'location_name' => $request->location_name,
            'location_percent' => $request->location_percent,
            'project_id' => $this->project_id,
        ]);

        return redirect()->route('backend.masterdata.location.index');
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('backend.masterdata.location.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location_name' => 'required',
            'location_percent' => 'required|numeric',
        ]);

        $location = Location::findOrFail($id);
        $location->update([
            'location_name' => $request->location_name,
            'location_percent' => $request->location_percent,
        ]);

        return redirect()->route('backend.masterdata.location.index');
    }

    public function destroy($id)
    {
        Location::findOrFail($id)->delete();
        return redirect()->route('backend.masterdata.location.index');
    }
}
