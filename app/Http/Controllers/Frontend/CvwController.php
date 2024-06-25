<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CvwController extends Controller
{
    public $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    public function getData(Request $request)
    {
        $currentTimeline = null;

        if ($request->has('timeline_id')) {
            $timeline = DB::table('timelines')
                ->where('id', $request->timeline_id)
                ->whereNull('deleted_at')
                ->first();

            if ($timeline) {
                $currentTimeline = $timeline;
                $weekStart = $timeline->timeline_week - 1;
                $weekEnd = $timeline->timeline_week + 1;
            }
        }

        if (!$currentTimeline) {
            $activeTimeline = DB::table('timelines')
                ->where('is_active', 1)
                ->where('project_id', $this->project_id)
                ->whereNull('deleted_at')
                ->first();

            if ($activeTimeline) {
                $currentTimeline = $activeTimeline;
                $weekStart = $activeTimeline->timeline_week - 1;
                $weekEnd = $activeTimeline->timeline_week + 1;
            }
        }

        if (isset($weekStart) && isset($weekEnd) && isset($currentTimeline)) {
            $projectDayUsage = DB::table('timelines')
                ->where('project_id', $this->project_id)
                ->where('timeline_week', '<=', $currentTimeline->timeline_week)
                ->whereNull('deleted_at')
                ->sum('timeline_day');

            $projectWeekUsage = $currentTimeline->timeline_week;

            $timelines = DB::table('timelines as tmm')
                ->select(
                    'tmm.id',
                    'tmm.project_id',
                    'tmm.timeline_start',
                    'tmm.timeline_end',
                    'tmm.timeline_week',
                    'tmm.is_active',
                    DB::raw('(SELECT SUM(tmm_sub.timeline_day)
                               FROM timelines AS tmm_sub
                               WHERE tmm_sub.project_id = tmm.project_id
                                 AND tmm_sub.timeline_week <= tmm.timeline_week
                                 AND tmm_sub.deleted_at IS NULL) AS timeline_day')
                )
                ->whereNull('tmm.deleted_at')
                ->where('tmm.project_id', $this->project_id)
                ->whereBetween('tmm.timeline_week', [$weekStart, $weekEnd])
                ->orderBy('tmm.timeline_week', 'ASC')
                ->get();

            $timelineIds = $timelines->pluck('id')->toArray();

            $cvwsData = DB::table('cvws AS cvw')
                ->select(
                    'cvw.id',
                    'cvw.project_id',
                    'cvw.location_id',
                    'loc.location_bobot',
                    'loc.location_name',
                    'cvw.timeline_id',
                    'cvw.cvw_plan',
                    'cvw.cvw_plan_cumulative',
                    'cvw.cvw_real',
                    'cvw.cvw_real_cumulative',
                    'cvw.cvw_deviasi'
                )
                ->join('locations as loc', function ($join) {
                    $join->on('cvw.location_id', '=', 'loc.id')
                        ->whereNull('loc.deleted_at')
                        ->whereRaw('loc.project_id = cvw.project_id');
                })
                ->whereIn('cvw.timeline_id', $timelineIds)
                ->whereNull('cvw.deleted_at')
                ->get();

            $cvwsGrouped = $cvwsData->groupBy('timeline_id');

            // Retrieve cvw_galleries data
            $cvwIds = $cvwsData->pluck('id')->toArray();
            $cvwGalleries = DB::table('cvw_galleries as cgal')
                ->select(
                    'cgal.id',
                    'cgal.cvw_id',
                    'cgal.gallery_image',
                    'cgal.gallery_desc'
                )
                ->whereNull('cgal.deleted_at')
                ->whereIn('cgal.cvw_id', $cvwIds)
                ->get()
                ->groupBy('cvw_id');

            $lastTimelines = new \stdClass();
            $currentTimelines = new \stdClass();
            $nextTimelines = new \stdClass();

            foreach ($timelines as $timeline) {
                $cvws = $cvwsGrouped->get($timeline->id, collect());

                // Merge galleries into cvws
                $cvws->each(function ($cvw) use ($cvwGalleries) {
                    $cvw->galleries = $cvwGalleries->get($cvw->id, collect());
                });

                $timeline->sum_location_bobot = $cvws->sum('location_bobot');
                $timeline->sum_cvw_plan = $cvws->sum('cvw_plan');
                $timeline->sum_cvw_real = $cvws->sum('cvw_real');
                $timeline->sum_cvw_plan_cumulative = $cvws->sum('cvw_plan_cumulative');
                $timeline->sum_cvw_real_cumulative = $cvws->sum('cvw_real_cumulative');
                $timeline->sum_cvw_deviasi = $cvws->sum('cvw_deviasi');

                $timeline->cvws = $cvws->values();

                if ($timeline->timeline_week < $currentTimeline->timeline_week) {
                    $lastTimelines = $this->convertToObject($timeline);
                } elseif ($timeline->timeline_week > $currentTimeline->timeline_week) {
                    $nextTimelines = $this->convertToObject($timeline);
                } else {
                    $currentTimelines = $this->convertToObject($timeline);
                }
            }

            // Retrieve grafik data
            $chartData = DB::table('timelines as tm')
                ->select(
                    'tm.id',
                    'tm.project_id',
                    'tm.timeline_start',
                    'tm.timeline_end',
                    'tm.timeline_week',
                    'tm.timeline_day',
                    DB::raw('IFNULL((
                        SELECT SUM(cvw.cvw_plan_cumulative)
                        FROM cvws AS cvw
                        WHERE cvw.deleted_at IS NULL
                        AND cvw.timeline_id = tm.id
                        AND cvw.project_id = tm.project_id
                    ), 0.00) AS cvw_plan_cumulative'),
                    DB::raw('IFNULL((
                        SELECT SUM(cvw.cvw_real_cumulative)
                        FROM cvws AS cvw
                        WHERE cvw.deleted_at IS NULL
                        AND cvw.timeline_id = tm.id
                        AND cvw.project_id = tm.project_id
                    ), 0.00) AS cvw_real_cumulative'),
                    'tm.is_active'
                )
                ->where('tm.project_id', $this->project_id)
                ->whereNull('tm.deleted_at')
                ->get();

            // Mark is_selected for chart data
            $chartData->each(function ($item) use ($currentTimeline) {
                $item->is_selected = $item->id === $currentTimeline->id;
            });

            $project = DB::table('projects')->where('id', $this->project_id)->first();

            if ($project) {
                $projectDayLimit = $project->project_day - $projectDayUsage;
                $projectWeekLimit = $project->project_week - $projectWeekUsage;

                $projectDetails = (object)[
                    'id' => $project->id,
                    'project_logo' => $project->project_logo,
                    'project_name' => $project->project_name,
                    'project_start' => $project->project_start,
                    'project_end' => $project->project_end,
                    'project_day' => $project->project_day,
                    'project_week' => $project->project_week,
                    'project_day_usage' => $projectDayUsage,
                    'project_week_usage' => $projectWeekUsage,
                    'project_day_limit' => $projectDayLimit,
                    'project_week_limit' => $projectWeekLimit,
                ];

                $data = (object)[
                    'project' => $projectDetails,
                    'timelines' => (object)[
                        'last' => $lastTimelines,
                        'current' => $currentTimelines,
                        'next' => $nextTimelines,
                    ],
                    'charts' => $chartData
                ];

                return $data;
            }
        }

        return [];
    }

    private function convertToObject($timeline)
    {
        $object = new \stdClass();
        foreach ($timeline as $key => $value) {
            $object->{$key} = $value;
        }
        return $object;
    }

    public function index(Request $request)
    {
        $timelines = DB::table('timelines')
            ->where('project_id', $this->project_id)
            ->whereNull('deleted_at')
            ->get();
        $data = $this->getData($request);
        return view('frontend.cvw.index', compact('data', 'timelines'));
    }
}
