<?php
namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::with('galleries')->get();
        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('meetings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'meeting_date' => 'required|date',
            'meeting_location' => 'required|string|max:255',
            'meeting_agenda' => 'required|string|max:255',
            'meeting_agenda_en' => 'required|string|max:255',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'descriptions.*' => 'nullable|string|max:255',
        ]);

        $meeting = Meeting::create($request->all());

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('public/gallery_images');
                MeetingGallery::create([
                    'meeting_id' => $meeting->id,
                    'gallery_image' => $path,
                    'gallery_desc' => $request->descriptions[$index] ?? '', // Add a field for description if needed
                ]);
            }
        }

        return redirect()->route('meetings.index');
    }

    public function show(Meeting $meeting)
    {
        return view('meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'project_id' => 'required',
            'meeting_date' => 'required|date',
            'meeting_location' => 'required|string|max:255',
            'meeting_agenda' => 'required|string|max:255',
            'meeting_agenda_en' => 'required|string|max:255',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $meeting->update($request->all());

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('public/gallery_images');
                MeetingGallery::create([
                    'meeting_id' => $meeting->id,
                    'gallery_image' => $path,
                    'gallery_desc' => '', // Add a field for description if needed
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
