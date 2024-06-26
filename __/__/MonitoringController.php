<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    private $project_id;

    public function __construct()
    {
        $this->project_id = env('COMPANY_DEFAULT_ID');
    }

    function getData()
    {

        $project = \DB::select("
            SELECT
                pj.id,
                pj.project_logo,
                pj.project_name,
                pj.project_number,
                pj.project_start,
                pj.project_end,
                pj.project_day AS project_day,
                pj.project_week AS project_week
            FROM
                projects AS pj
            WHERE
                pj.id = ?;
        ", [1]);

        $timeline_current = \DB::select("
            SELECT
                tm.id,
                tm.project_id,
                tm.time_week,
                tm.time_day,
                tm.time_start,
                tm.time_end,
                tm.time_week AS time_week_usage,
                CAST(
                    (
                        SELECT
                            SUM(time_day)
                        FROM
                            timelines
                        WHERE
                            time_end <= tm.time_end
                            AND deleted_at IS NULL
                            AND project_id = tm.project_id
                    ) AS UNSIGNED INTEGER
                ) AS time_day_usage
            FROM
                timelines AS tm
            WHERE
                tm.project_id = ?
                AND tm.is_active = TRUE
                AND tm.deleted_at IS NULL
        ", [$this->project_id]);

        $timeline_last1 = \DB::select("
            SELECT
                tm.id,
                tm.project_id,
                tm.time_week,
                tm.time_day,
                tm.time_start,
                tm.time_end
            FROM
                timelines AS tm
            WHERE
                tm.project_id = ?
                AND tm.time_week = ?
                AND tm.deleted_at IS NULL
        ", [$this->project_id, ($timeline_current[0]->time_week - 1)]);

        $timeline_last2 = \DB::select("
            SELECT
                tm.id,
                tm.project_id,
                tm.time_week,
                tm.time_day,
                tm.time_start,
                tm.time_end
            FROM
                timelines AS tm
            WHERE
                tm.project_id = ?
                AND tm.time_week = ?
                AND tm.deleted_at IS NULL
        ", [$this->project_id, ($timeline_current[0]->time_week - 2)]);

        $timeline_next = \DB::select("
            SELECT
                tm.id,
                tm.project_id,
                tm.time_week,
                tm.time_day,
                tm.time_start,
                tm.time_end
            FROM
                timelines AS tm
            WHERE
                tm.project_id = ?
                AND tm.time_week = ?
                AND tm.deleted_at IS NULL
        ", [$this->project_id, ($timeline_current[0]->time_week + 1)]);


        $target_current = \DB::select("
            SELECT
                tg.id,
                tg.project_id,
                tg.location_id,
                tg.timeline_id,
                locc.location_name,
                tg.plan_kumulatif,
                tg.real_kumulatif
            FROM
                targets AS tg
                JOIN locations AS locc ON tg.location_id = locc.id
                AND tg.deleted_at IS NULL
            WHERE
                tg.project_id = ?
                AND tg.deleted_at IS NULL
                AND tg.timeline_id = ?
        ", [$this->project_id, $timeline_current[0]->id]);

        $target_last1 = \DB::select("
            SELECT
                tg.id,
                tg.project_id,
                tg.location_id,
                tg.timeline_id,
                locc.location_name,
                tg.plan_kumulatif,
                tg.real_kumulatif
            FROM
                targets AS tg
                JOIN locations AS locc ON tg.location_id = locc.id
                AND tg.deleted_at IS NULL
            WHERE
                tg.project_id = ?
                AND tg.deleted_at IS NULL
                AND tg.timeline_id = ?
        ", [$this->project_id, $timeline_last1[0]->id]);

        $target_last2 = \DB::select("
            SELECT
                tg.id,
                tg.project_id,
                tg.location_id,
                tg.timeline_id,
                locc.location_name,
                tg.plan_kumulatif,
                tg.real_kumulatif
            FROM
                targets AS tg
                JOIN locations AS locc ON tg.location_id = locc.id
                AND tg.deleted_at IS NULL
            WHERE
                tg.project_id = ?
                AND tg.deleted_at IS NULL
                AND tg.timeline_id = ?
        ", [$this->project_id, $timeline_last2[0]->id]);

        $target_next = \DB::select("
            SELECT
                tg.id,
                tg.project_id,
                tg.location_id,
                tg.timeline_id,
                locc.location_name,
                tg.plan_kumulatif,
                tg.real_kumulatif
            FROM
                targets AS tg
                JOIN locations AS locc ON tg.location_id = locc.id
                AND tg.deleted_at IS NULL
            WHERE
                tg.project_id = ?
                AND tg.deleted_at IS NULL
                AND tg.timeline_id = ?
        ", [$this->project_id, $timeline_next[0]->id]);

        $target_all = \DB::select("
            SELECT
                tm.id,
                tm.project_id,
                tm.time_start,
                tm.time_end,
                tm.time_week,
                tm.time_day,
                tm.is_active,
                (SELECT SUM(plan_kumulatif) FROM targets WHERE project_id = tm.project_id AND timeline_id = tm.id AND deleted_at IS NULL) AS plan_kumulatif,
                (SELECT SUM(real_kumulatif) FROM targets WHERE project_id = tm.project_id AND timeline_id = tm.id AND deleted_at IS NULL) AS real_kumulatif
            FROM
                timelines AS tm
                WHERE project_id = ? AND deleted_at IS NULL
        ", [$this->project_id]);

        $gallery = \DB::select("SELECT * FROM galleries WHERE deleted_at IS NULL AND timeline_id = ? ORDER BY created_at ASC", [$timeline_current[0]->id]);

        $data_target_current = [];
        $data_target_current_plan_kumulatif_sum = 0;
        $data_target_current_real_kumulatif_sum = 0;
        foreach ($target_current as $tc) {
            $data_target_current[] = [
                "id" => $tc->id,
                "location_id" => $tc->location_id,
                "location_name" => $tc->location_name,
                "plan_kumulatif" => $tc->plan_kumulatif,
                "real_kumulatif" => $tc->real_kumulatif,
                "deviasi_kumulatif" => round($tc->real_kumulatif - $tc->plan_kumulatif, 2),
            ];

            $data_target_current_plan_kumulatif_sum += $tc->plan_kumulatif;
            $data_target_current_real_kumulatif_sum += $tc->real_kumulatif;
        }


        $data_target_last1 = [];
        $data_target_last1_plan_kumulatif_sum = 0;
        $data_target_last1_real_kumulatif_sum = 0;
        foreach ($target_last1 as $tc) {
            $data_target_last1[] = [
                "id" => $tc->id,
                "location_id" => $tc->location_id,
                "location_name" => $tc->location_name,
                "plan_kumulatif" => $tc->plan_kumulatif,
                "real_kumulatif" => $tc->real_kumulatif,
                "deviasi_kumulatif" => round($tc->real_kumulatif - $tc->plan_kumulatif, 2),
            ];

            $data_target_last1_plan_kumulatif_sum += $tc->plan_kumulatif;
            $data_target_last1_real_kumulatif_sum += $tc->real_kumulatif;
        }

        $data_target_last2 = [];
        $data_target_last2_plan_kumulatif_sum = 0;
        $data_target_last2_real_kumulatif_sum = 0;
        foreach ($target_last2 as $tc) {
            $data_target_last2[] = [
                "id" => $tc->id,
                "location_id" => $tc->location_id,
                "location_name" => $tc->location_name,
                "plan_kumulatif" => $tc->plan_kumulatif,
                "real_kumulatif" => $tc->real_kumulatif,
                "deviasi_kumulatif" => round($tc->real_kumulatif - $tc->plan_kumulatif, 2),
            ];

            $data_target_last2_plan_kumulatif_sum += $tc->plan_kumulatif;
            $data_target_last2_real_kumulatif_sum += $tc->real_kumulatif;
        }

        $data_target_next = [];
        $data_target_next_plan_kumulatif_sum = 0;
        $data_target_next_real_kumulatif_sum = 0;
        foreach ($target_next as $tc) {
            $data_target_next[] = [
                "id" => $tc->id,
                "location_id" => $tc->location_id,
                "location_name" => $tc->location_name,
                "plan_kumulatif" => $tc->plan_kumulatif,
                "real_kumulatif" => $tc->real_kumulatif,
                "deviasi_kumulatif" => round($tc->real_kumulatif - $tc->plan_kumulatif, 2),
            ];

            $data_target_next_plan_kumulatif_sum += $tc->plan_kumulatif;
            $data_target_next_real_kumulatif_sum += $tc->real_kumulatif;
        }

        $data = [
            "id" => $this->project_id ?? null,
            "project_logo" => $project[0]->project_logo ?? null,
            "project_name" => $project[0]->project_name ?? null,
            "project_number" => $project[0]->project_number ?? null,
            "project_start" => $project[0]->project_start ?? null,
            "project_end" => $project[0]->project_end ?? null,
            "project_day" => $project[0]->project_day ?? null,
            "project_week" => $project[0]->project_week ?? null,
            "project_day_usage" => $timeline_current[0]->time_day_usage ?? null,
            "project_week_usage" => $timeline_current[0]->time_week_usage ?? null,
            "project_day_limit" => ($project[0]->project_day - $timeline_current[0]->time_day_usage) ?? null,
            "project_week_limit" => ($project[0]->project_week - $timeline_current[0]->time_week_usage) ?? null,
            "target_weekly" => [
                "current" => [
                    "id" => $timeline_current[0]->id ?? null,
                    "time_week" => $timeline_current[0]->time_week ?? null,
                    "time_day" => $timeline_current[0]->time_day ?? null,
                    "time_start" => $timeline_current[0]->time_start ?? null,
                    "time_end" => $timeline_current[0]->time_end ?? null,
                    "plan_kumulatif" => $data_target_current_plan_kumulatif_sum,
                    "real_kumulatif" => $data_target_current_real_kumulatif_sum,
                    "deviasi_kumulatif" => round($data_target_current_real_kumulatif_sum - $data_target_current_plan_kumulatif_sum, 2),
                    "target" => $data_target_current,
                ],
                "last1" => [
                    "id" => $timeline_last1[0]->id ?? null,
                    "time_week" => $timeline_last1[0]->time_week ?? null,
                    "time_day" => $timeline_last1[0]->time_day ?? null,
                    "time_start" => $timeline_last1[0]->time_start ?? null,
                    "time_end" => $timeline_last1[0]->time_end ?? null,
                    "plan_kumulatif" => $data_target_last1_plan_kumulatif_sum,
                    "real_kumulatif" => $data_target_last1_real_kumulatif_sum,
                    "deviasi_kumulatif" => round($data_target_last1_real_kumulatif_sum - $data_target_last1_plan_kumulatif_sum, 2),
                    "target" => $data_target_last1,
                ],
                "last2" => [
                    "id" => $timeline_last2[0]->id ?? null,
                    "time_week" => $timeline_last2[0]->time_week ?? null,
                    "time_day" => $timeline_last2[0]->time_day ?? null,
                    "time_start" => $timeline_last2[0]->time_start ?? null,
                    "time_end" => $timeline_last2[0]->time_end ?? null,
                    "plan_kumulatif" => $data_target_last2_plan_kumulatif_sum,
                    "real_kumulatif" => $data_target_last2_real_kumulatif_sum,
                    "deviasi_kumulatif" => round($data_target_last2_real_kumulatif_sum - $data_target_last2_plan_kumulatif_sum, 2),
                    "target" => $data_target_last2,
                ],
                "next" => [
                    "id" => $timeline_next[0]->id ?? null,
                    "time_week" => $timeline_next[0]->time_week ?? null,
                    "time_day" => $timeline_next[0]->time_day ?? null,
                    "time_start" => $timeline_next[0]->time_start ?? null,
                    "time_end" => $timeline_next[0]->time_end ?? null,
                    "plan_kumulatif" => $data_target_next_plan_kumulatif_sum,
                    "real_kumulatif" => $data_target_next_real_kumulatif_sum,
                    "deviasi_kumulatif" => round($data_target_next_real_kumulatif_sum - $data_target_next_plan_kumulatif_sum, 2),
                    "target" => $data_target_next,
                ],
            ],
            "target_all" => $target_all,
            "gallery" => $gallery,
        ];

        return $data;
    }

    function index()
    {
        $data = $this->getData();
        return view('frontend.cvw.index', compact('data'));
    }
}
