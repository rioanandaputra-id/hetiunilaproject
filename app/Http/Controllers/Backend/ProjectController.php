<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
class ProjectController extends Controller
{
    public $project_id;

    public function __construct() {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function edit()
    {
        $project = Project::find($this->project_id);
        return view('backend.masterdata.project.edit', compact('project'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'projectName' => 'required',
            'projectLogo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Example validation for image upload
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'durationDays' => 'required|integer|min:0',
            'durationWeeks' => 'required|integer|min:0',
        ]);

        $project = Project::findOrFail($this->project_id);

        if ($request->hasFile('projectLogo')) {
            $file = $request->file('projectLogo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('project_logos', $fileName, 'public');

            if ($project->project_logo) {
                Storage::disk('public')->delete($project->project_logo);
            }

            $project->update([
                'project_name' => $request->projectName,
                'project_logo' => $filePath,
                'project_start' => $request->startDate,
                'project_end' => $request->endDate,
                'project_day' => $request->durationDays,
                'project_week' => $request->durationWeeks,
            ]);
        } else {
            $project->update([
                'project_name' => $request->projectName,
                'project_start' => $request->startDate,
                'project_end' => $request->endDate,
                'project_day' => $request->durationDays,
                'project_week' => $request->durationWeeks,
            ]);
        }

        return redirect()->route('backend.masterdata.project.index')->with('success', 'Proyek berhasil diperbarui.');
    }
}
