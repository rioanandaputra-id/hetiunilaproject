<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingGallery;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public $project_id;

    public function __construct() {
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
            $query->where('meeting_week', $request->week );
        }

        $meetings = $query->with('meetingGallery')->get();

        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('meetings.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'meeting_week' => 'required',
            'meeting_date' => 'required|date',
            'meeting_location' => 'required',
            'meeting_agenda' => 'required',
            'meeting_agenda_en' => 'required',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        // Buat pertemuan baru
        $meeting = Meeting::create([
            'project_id' => $this->project_id,
            'meeting_date' => $request->meeting_date,
            'meeting_location' => $request->meeting_location,
            'meeting_agenda' => $request->meeting_agenda,
            'meeting_agenda_en' => $request->meeting_agenda_en,
            'meeting_week' => $request->meeting_week,
        ]);

        // Proses dan simpan gambar galeri
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                // Simpan gambar di direktori 'public/meeting_galleries'
                $path = $image->store('public/meeting_galleries');

                // Tambahkan record galeri pertemuan
                $meeting->meetingGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('meetings.index');
    }

    public function edit(Meeting $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }


    public function update(Request $request, Meeting $meeting)
    {
        \Log::info($request->all());

        // Validate the incoming data
        $request->validate([
            'meeting_date' => 'required|date',
            'meeting_location' => 'required',
            'meeting_agenda' => 'required',
            'meeting_agenda_en' => 'required',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);

        // Update the meeting details
        $meeting->update([
            'meeting_date' => $request->meeting_date,
            'meeting_location' => $request->meeting_location,
            'meeting_agenda' => $request->meeting_agenda,
            'meeting_agenda_en' => $request->meeting_agenda_en,
            'meeting_week' => $request->meeting_week,
        ]);

        // Update existing gallery descriptions
        if ($request->filled('existing_descriptions')) {
            foreach ($request->existing_descriptions as $galleryId => $description) {
                $gallery = MeetingGallery::find($galleryId);
                if ($gallery) {
                    $gallery->update(['gallery_desc' => $description]);
                }
            }
        }

        // Delete removed images
        if ($request->filled('deleted_images')) {
            $deletedImageIds = explode(',', trim($request->deleted_images, ','));
            foreach ($deletedImageIds as $galleryId) {
                $gallery = MeetingGallery::find($galleryId);
                if ($gallery) {
                    // Delete the image file
                    \Storage::delete($gallery->gallery_image);
                    // Delete the record from the database
                    $gallery->delete();
                }
            }
        }

        // Process and save new gallery images if any files were uploaded
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                // Save the image in the 'public/meeting_galleries' directory
                $path = $image->store('public/meeting_galleries');

                // Add the new gallery record
                $meeting->meetingGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('meetings.index');
    }


    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meetings.index');
    }
}
