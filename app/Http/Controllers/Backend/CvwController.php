<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CvwGallery;
use App\Models\Location;
use App\Models\Cvw;
use App\Models\Timeline;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvwController extends Controller
{
    public $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function index()
    {
        $timelines = Timeline::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        return view('backend.monitoring.cvw.index', compact('timelines'));
    }

    public function data(Request $request)
    {
        $cvws = \DB::table('cvws as cvw')
            ->join('locations as loc', function ($join) {
                $join->on('cvw.location_id', '=', 'loc.id')
                    ->whereNull('cvw.deleted_at')
                    ->whereRaw('loc.project_id = cvw.project_id');
            })
            ->join('timelines as tmm', function ($join) {
                $join->on('cvw.timeline_id', '=', 'tmm.id')
                    ->whereNull('tmm.deleted_at')
                    ->whereRaw('tmm.project_id = cvw.project_id');
            })
            ->where('cvw.project_id', $this->project_id)
            ->whereNull('cvw.deleted_at')
            ->select(
                'cvw.id',
                'cvw.project_id',
                'cvw.location_id',
                'cvw.timeline_id',
                'loc.location_name',
                'loc.location_bobot',
                'cvw.cvw_plan',
                'cvw.cvw_real',
                'cvw.cvw_plan_cumulative',
                'cvw.cvw_real_cumulative',
                'cvw.cvw_deviasi',
                'tmm.timeline_week',
                \DB::raw('loc.location_bobot - cvw.cvw_deviasi AS cvw_progress')
            );

        if ($request->filled('timeline_week')) {
            $cvws->where('tmm.timeline_week', $request->timeline_week);
        }

        return DataTables::of($cvws)
            ->addColumn('action', function ($cvw) {
                return '<a href="' . route('backend.monitoring.cvw.edit', $cvw->id) . '" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded">Edit</a>
                        <form action="' . route('backend.monitoring.cvw.destroy', $cvw->id) . '" method="POST" class="inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded">Delete</button>
                        </form>';
            })
            ->toJson();
    }

    public function getDataBefore($timeline_id, $location_id)
    {
        $cvws = Cvw::whereNull('deleted_at')
            ->where('project_id', $this->project_id)
            ->where('timeline_id', $timeline_id)
            ->where('location_id', $location_id)
            ->get();
        return $cvws;
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
            'timeline_id' => 'required|exists:timelines,id',
            'location_id' => 'required|exists:locations,id',
            'cvw_plan' => 'required|numeric',
            'cvw_plan_cumulative' => 'required|numeric',
            'cvw_real' => 'required|numeric',
            'cvw_real_cumulative' => 'required|numeric',
            'cvw_deviasi' => 'required|numeric',
            'cvw_galleries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $existingCvw = Cvw::where('timeline_id', $request->timeline_id)
            ->where('location_id', $request->location_id)
            ->first();

        if ($existingCvw) {
            return redirect()->route('backend.monitoring.cvw.index')->with('status', 'The combination of Minggu Ke and Lokasi already exists.');
        }

        $cvw = Cvw::create([
            'timeline_id' => $request->timeline_id,
            'location_id' => $request->location_id,
            'cvw_plan' => $request->cvw_plan,
            'cvw_plan_cumulative' => $request->cvw_plan_cumulative,
            'cvw_real' => $request->cvw_real,
            'cvw_real_cumulative' => $request->cvw_real_cumulative,
            'cvw_deviasi' => $request->cvw_deviasi,
            'project_id' => $this->project_id,
        ]);

        if ($request->hasFile('cvw_galleries')) {
            foreach ($request->file('cvw_galleries') as $index => $image) {
                $path = $image->store('public/cvw_galleries');
                $cvw->cvwGallery()->create([
                    'location_id' => $request->location_id,
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('backend.monitoring.cvw.index')->with('status', 'Civil Work created successfully!');
    }

    public function edit(Cvw $cvw)
    {
        $timelines = Timeline::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        $locations = Location::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        return view('backend.monitoring.cvw.edit', compact('timelines', 'locations', 'cvw'));
    }


    public function update(Request $request, Cvw $cvw)
    {
        $request->validate([
            'timeline_id' => 'required|exists:timelines,id',
            'location_id' => 'required|exists:locations,id',
            'cvw_plan' => 'required|numeric',
            'cvw_plan_cumulative' => 'required|numeric',
            'cvw_real' => 'required|numeric',
            'cvw_real_cumulative' => 'required|numeric',
            'cvw_deviasi' => 'required|numeric',
            'cvw_galleries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $duplicate = Cvw::where('timeline_id', $request->timeline_id)
            ->where('location_id', $request->location_id)
            ->where('id', '!=', $cvw->id)
            ->exists();

        if ($duplicate) {
            return back()->withErrors([
                'duplicate' => 'A Civil Work entry with the same timeline and location already exists.'
            ])->withInput();
        }

        $cvw->update([
            'timeline_id' => $request->timeline_id,
            'location_id' => $request->location_id,
            'cvw_plan' => $request->cvw_plan,
            'cvw_plan_cumulative' => $request->cvw_plan_cumulative,
            'cvw_real' => $request->cvw_real,
            'cvw_real_cumulative' => $request->cvw_real_cumulative,
            'cvw_deviasi' => $request->cvw_deviasi,
        ]);

        if ($request->filled('existing_descriptions')) {
            foreach ($request->existing_descriptions as $galleryId => $description) {
                $gallery = CvwGallery::find($galleryId);
                if ($gallery) {
                    $gallery->update(['location_id' => $request->location_id, 'gallery_desc' => $description]);
                }
            }
        }

        if ($request->filled('deleted_images')) {
            $deletedImageIds = explode(',', trim($request->deleted_images, ','));
            foreach ($deletedImageIds as $galleryId) {
                $gallery = CvwGallery::find($galleryId);
                if ($gallery) {
                    Storage::delete($gallery->gallery_image);
                    $gallery->delete();
                }
            }
        }

        if ($request->hasFile('cvw_galleries')) {
            foreach ($request->file('cvw_galleries') as $index => $image) {
                $path = $image->store('public/cvw_galleries');
                $cvw->cvwGallery()->create([
                    'location_id' => $request->location_id,
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('backend.monitoring.cvw.index')->with('status', 'Civil Work updated successfully!');
    }

    public function destroy($id)
    {
        Cvw::findOrFail($id)->delete();
        return redirect()->route('backend.monitoring.cvw.index');
    }
}
