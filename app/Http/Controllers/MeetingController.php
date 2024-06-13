<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Timeline;
use App\Models\MeetingGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $query = Meeting::query();

        if ($request->has('date')) {
            $query->whereDate('meeting_date', $request->date);
        }

        if ($request->has('week')) {
            $week = $request->week;
            $timeline = Timeline::where('time_week', $week)->first();
            if ($timeline) {
                $query->whereBetween('meeting_date', [$timeline->time_start, $timeline->time_end]);
            }
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
        $meeting = Meeting::create($request->all());

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('public/meeting_galleries');
                $meeting->meetingGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->gallery_desc,
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
        $meeting->update($request->all());

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('public/meeting_galleries');
                $meeting->meetingGallery()->create([
                    'gallery_image' => $path,
                    'gallery_desc' => $request->gallery_desc,
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

    public function show(Meeting $meeting)
    {
        $meeting->load('meetingGallery');
        return view('meetings.show', compact('meeting'));
    }
}
