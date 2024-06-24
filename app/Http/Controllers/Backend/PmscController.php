<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pmsc;
use App\Models\PmscGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Timeline;

class PmscController extends Controller
{
    public $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function index(Request $request)
    {
        $query = Pmsc::query();
        $query->where('project_id', $this->project_id);

        if (!empty($request->date)) {
            $query->whereDate('pmsc_date', $request->date);
        }

        if (!empty($request->timeline_id)) {
            $query->where('timeline_id', $request->timeline_id);
        }

        $pmscs = $query->with('pmscGallery')->get();

        $timelines = Timeline::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        return view('backend.monitoring.pmsc.index', compact('pmscs', 'timelines'));
    }

    public function create()
    {
        $timelines = Timeline::whereNull('deleted_at')->where('project_id', $this->project_id)->get();
        return view('backend.monitoring.pmsc.create', compact('timelines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'timeline_id' => 'required',
            'pmsc_date' => 'required|date',
            'pmsc_location' => 'required',
            'pmsc_agenda' => 'required',
            'pmsc_agenda_en' => 'required',
            'pmsc_galleries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pmsc = Pmsc::create([
            'timeline_id' => $request->timeline_id,
            'pmsc_date' => $request->pmsc_date,
            'pmsc_location' => $request->pmsc_location,
            'pmsc_agenda' => $request->pmsc_agenda,
            'pmsc_agenda_en' => $request->pmsc_agenda_en,
            'project_id' => $this->project_id,
        ]);

        if ($request->hasFile('pmsc_galleries')) {
            foreach ($request->file('pmsc_galleries') as $index => $image) {
                $path = $image->store('public/pmsc_galleries');
                $pmsc->PmscGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('backend.monitoring.pmsc.index')->with('status', 'Pmsc created successfully!');
    }

    public function edit(Pmsc $pmsc)
    {
        return view('backend.monitoring.pmsc.edit', compact('pmsc'));
    }

    public function update(Request $request, Pmsc $pmsc)
    {
        $request->validate([
            'timeline_id' => 'required',
            'pmsc_date' => 'required|date',
            'pmsc_location' => 'required',
            'pmsc_agenda' => 'required',
            'pmsc_agenda_en' => 'required',
            'pmsc_galleries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pmsc->update([
            'timeline_id' => $request->timeline_id,
            'pmsc_date' => $request->pmsc_date,
            'pmsc_location' => $request->pmsc_location,
            'pmsc_agenda' => $request->pmsc_agenda,
            'pmsc_agenda_en' => $request->pmsc_agenda_en,
        ]);

        if ($request->filled('existing_descriptions')) {
            foreach ($request->existing_descriptions as $galleryId => $description) {
                $gallery = PmscGallery::find($galleryId);
                if ($gallery) {
                    $gallery->update(['gallery_desc' => $description]);
                }
            }
        }

        if ($request->filled('deleted_images')) {
            $deletedImageIds = explode(',', trim($request->deleted_images, ','));
            foreach ($deletedImageIds as $galleryId) {
                $gallery = PmscGallery::find($galleryId);
                if ($gallery) {
                    Storage::delete($gallery->gallery_image);
                    $gallery->delete();
                }
            }
        }

        if ($request->hasFile('pmsc_galleries')) {
            foreach ($request->file('pmsc_galleries') as $index => $image) {
                $path = $image->store('public/pmsc_galleries');
                $pmsc->PmscGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('backend.monitoring.pmsc.index')->with('status', 'Pmsc updated successfully!');
    }

    public function destroy(Pmsc $pmsc)
    {
        $pmsc->delete();
        return redirect()->route('backend.monitoring.pmsc.index')->with('status', 'Pmsc deleted successfully!');
    }
}
