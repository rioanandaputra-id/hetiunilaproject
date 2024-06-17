<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PmscController extends Controller
{
    public $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function index(Request $request)
    {
        $query = Meeting::query();
        $query->where('project_id', $this->project_id);

        if (!empty($request->date)) {
            $query->whereDate('meeting_date', $request->date);
        }

        if (!empty($request->week)) {
            $query->where('meeting_week', $request->week);
        }

        $meetings = $query->with('meetingGallery')->get();

        return view('backend.monitoring.pmsc.index', compact('meetings'));
    }

    public function create()
    {
        return view('backend.monitoring.pmsc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'meeting_week' => 'required',
            'meeting_date' => 'required|date',
            'meeting_location' => 'required',
            'meeting_agenda' => 'required',
            'meeting_agenda_en' => 'required',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $meeting = Meeting::create([
            'project_id' => $this->project_id,
            'meeting_date' => $request->meeting_date,
            'meeting_location' => $request->meeting_location,
            'meeting_agenda' => $request->meeting_agenda,
            'meeting_agenda_en' => $request->meeting_agenda_en,
            'meeting_week' => $request->meeting_week,
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('public/meeting_galleries');
                $meeting->meetingGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('backend.monitoring.pmsc.index')->with('status', 'Meeting created successfully!');
    }

    public function edit(Meeting $meeting)
    {
        return view('backend.monitoring.pmsc.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'meeting_date' => 'required|date',
            'meeting_location' => 'required',
            'meeting_agenda' => 'required',
            'meeting_agenda_en' => 'required',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $meeting->update([
            'meeting_date' => $request->meeting_date,
            'meeting_location' => $request->meeting_location,
            'meeting_agenda' => $request->meeting_agenda,
            'meeting_agenda_en' => $request->meeting_agenda_en,
            'meeting_week' => $request->meeting_week,
        ]);

        if ($request->filled('existing_descriptions')) {
            foreach ($request->existing_descriptions as $galleryId => $description) {
                $gallery = MeetingGallery::find($galleryId);
                if ($gallery) {
                    $gallery->update(['gallery_desc' => $description]);
                }
            }
        }

        if ($request->filled('deleted_images')) {
            $deletedImageIds = explode(',', trim($request->deleted_images, ','));
            foreach ($deletedImageIds as $galleryId) {
                $gallery = MeetingGallery::find($galleryId);
                if ($gallery) {
                    Storage::delete($gallery->gallery_image);
                    $gallery->delete();
                }
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('public/meeting_galleries');
                $meeting->meetingGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('backend.monitoring.pmsc.index')->with('status', 'Meeting updated successfully!');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('backend.monitoring.pmsc.index')->with('status', 'Meeting deleted successfully!');
    }
}
