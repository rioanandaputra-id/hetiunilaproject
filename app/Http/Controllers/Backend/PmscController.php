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
        $query = Pmsc::query()
            ->select([
                'pmscs.id',
                'pmscs.project_id',
                'pmscs.timeline_id',
                'tmm.timeline_week',
                'pmscs.pmsc_date',
                'pmscs.pmsc_location',
                'pmscs.pmsc_agenda',
                'pmscs.pmsc_agenda_en'
            ])
            ->join('timelines as tmm', function ($join) {
                $join->on('tmm.id', '=', 'pmscs.timeline_id')
                     ->whereColumn('tmm.project_id', 'pmscs.project_id')
                     ->whereNull('tmm.deleted_at');
            })
            ->where('pmscs.project_id', $this->project_id)
            ->whereNull('pmscs.deleted_at');

        if (!empty($request->timeline_id)) {
            $query->where(function ($q) use ($request) {
                $q->where('pmscs.timeline_id', $request->timeline_id)
                  ->orWhere('tmm.is_active', true);
            });
        } else {
            $query->where('tmm.is_active', true);
        }

        $pmscs = $query->with('pmscGallery')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'pmscs' => view('backend.monitoring.pmsc.partials.pmsc_list', compact('pmscs'))->render(),
                'next_page_url' => $pmscs->nextPageUrl()
            ]);
        }

        $timelines = Timeline::whereNull('deleted_at')
                             ->where('project_id', $this->project_id)
                             ->get();

        return view('backend.monitoring.pmsc.index', compact('pmscs', 'timelines'));
    }
    public function indexxx(Request $request)
    {
        $query = Pmsc::query()
            ->select([
                'pmscs.id',
                'pmscs.project_id',
                'pmscs.timeline_id',
                'tmm.timeline_week',
                'pmscs.pmsc_date',
                'pmscs.pmsc_location',
                'pmscs.pmsc_agenda',
                'pmscs.pmsc_agenda_en'
            ])
            ->join('timelines as tmm', function ($join) {
                $join->on('tmm.id', '=', 'pmscs.timeline_id')
                     ->whereColumn('tmm.project_id', 'pmscs.project_id')
                     ->whereNull('tmm.deleted_at');
            })
            ->where('pmscs.project_id', $this->project_id)
            ->whereNull('pmscs.deleted_at');

        if (!empty($request->timeline_id)) {
            $query->where(function ($q) use ($request) {
                $q->where('pmscs.timeline_id', $request->timeline_id)
                  ->orWhere('tmm.is_active', true);
            });
        } else {
            $query->where('tmm.is_active', true);
        }

        $pmscs = $query->with('pmscGallery')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'pmscs' => view('frontend.pmsc.partials.pmsc_list', compact('pmscs'))->render(),
                'next_page_url' => $pmscs->nextPageUrl()
            ]);
        }

        $timelines = Timeline::whereNull('deleted_at')
                             ->where('project_id', $this->project_id)
                             ->get();

        return view('frontend.pmsc.index', compact('pmscs', 'timelines'));
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
