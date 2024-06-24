<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Location;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'id' => 1,
                'project_logo' => 'default.png',
                'project_name' => 'CWU CONSTRUCTION BUILDING FOR RSPTN, IRC AND WWTP | UNIVERSITAS LAMPUNG',
                'project_start' => '2024-03-08',
                'project_end' => '2025-08-30',
                'project_day' => 540,
                'project_week' => 78,
            ]
        ];

        $locations = [
            [
                'id' => 1,
                'project_id' => 1,
                'location_name' => 'RSPTN',
                'location_bobot' => 68.74,
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'location_name' => 'IRC',
                'location_bobot' => 31.26,
            ],
            [
                'id' => 3,
                'project_id' => 1,
                'location_name' => 'WWTP',
                'location_bobot' => 0.00,
            ]
        ];

        $timelines = [
            [
                'id' => 1,
                'project_id' => 1,
                'timeline_week' => 1,
                'timeline_day' => 2,
                'timeline_start' => '2024-03-08',
                'timeline_end' => '2024-03-09',
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'timeline_week' => 2,
                'timeline_day' => 7,
                'timeline_start' => '2024-03-10',
                'timeline_end' => '2024-03-16',
            ],
            [
                'id' => 3,
                'project_id' => 1,
                'timeline_week' => 3,
                'timeline_day' => 7,
                'timeline_start' => '2024-03-17',
                'timeline_end' => '2024-03-23',
            ],
            [
                'id' => 4,
                'project_id' => 1,
                'timeline_week' => 4,
                'timeline_day' => 7,
                'timeline_start' => '2024-03-24',
                'timeline_end' => '2024-03-30',
            ],
            [
                'id' => 5,
                'project_id' => 1,
                'timeline_week' => 5,
                'timeline_day' => 7,
                'timeline_start' => '2024-03-31',
                'timeline_end' => '2024-04-06',
            ],
            [
                'id' => 6,
                'project_id' => 1,
                'timeline_week' => 6,
                'timeline_day' => 7,
                'timeline_start' => '2024-04-07',
                'timeline_end' => '2024-04-13',
            ],
            [
                'id' => 7,
                'project_id' => 1,
                'timeline_week' => 7,
                'timeline_day' => 7,
                'timeline_start' => '2024-04-14',
                'timeline_end' => '2024-04-20',
            ],
        ];

        $targets = [
            [
                'id' => 1,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 1,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 2,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 3,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 3,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 4,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 4,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 5,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 5,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 6,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 6,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 7,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 7,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 8,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 1,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 9,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 2,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 10,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 3,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 11,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 4,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 12,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 5,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 13,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 6,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
            [
                'id' => 14,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 7,
                'cvw_plan' => 0.00,
                'cvw_plan_cumulative' => 0.00,
                'cvw_real' => 0.00,
                'cvw_real_cumulative' => 0.00,
                'cvw_deviasi' => 0.00,
            ],
        ];


        $galleries = [
            [
                'id' => 1,
                'cvw_id' => 5,
                'gallery_image' => 'default.png',
                'gallery_desc' => 'bla bla bla',
            ]
        ];

        // Project::Truncate();
        Project::Insert($projects);

        // Location::Truncate();
        Location::Insert($locations);

        // Timeline::Truncate();
        Timeline::Insert($timelines);

        // // Target::Truncate();
        // Target::Insert($targets);

        // // Gallery::Truncate();
        // Gallery::Insert($galleries);
    }
}
