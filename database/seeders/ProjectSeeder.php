<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Location;
use App\Models\Target;
use App\Models\Gallery;

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
                'project_number' => '6919/UN26/LK.032023',
            ]
        ];

        $locations = [
            [
                'id' => 1,
                'project_id' => 1,
                'location_name' => 'RSPTN & IRC',
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'location_name' => 'WWTP',
            ]
        ];

        $timelines = [
            [
                'id' => 1,
                'project_id' => 1,
                'time_week' => 1,
                'time_day' => 2,
                'time_start' => '2024-03-08',
                'time_end' => '2024-03-09',
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'time_week' => 2,
                'time_day' => 7,
                'time_start' => '2024-03-10',
                'time_end' => '2024-03-16',
            ],
            [
                'id' => 3,
                'project_id' => 1,
                'time_week' => 3,
                'time_day' => 7,
                'time_start' => '2024-03-17',
                'time_end' => '2024-03-23',
            ],
            [
                'id' => 4,
                'project_id' => 1,
                'time_week' => 4,
                'time_day' => 7,
                'time_start' => '2024-03-24',
                'time_end' => '2024-03-30',
            ],
            [
                'id' => 5,
                'project_id' => 1,
                'time_week' => 5,
                'time_day' => 7,
                'time_start' => '2024-03-31',
                'time_end' => '2024-04-06',
            ],
            [
                'id' => 6,
                'project_id' => 1,
                'time_week' => 6,
                'time_day' => 7,
                'time_start' => '2024-04-07',
                'time_end' => '2024-04-13',
            ],
            [
                'id' => 7,
                'project_id' => 1,
                'time_week' => 7,
                'time_day' => 7,
                'time_start' => '2024-04-14',
                'time_end' => '2024-04-20',
            ],
        ];

        $targets = [
            [
                'id' => 1,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 1,
                'plan_kumulatif' => 0.02,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 2,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 2,
                'plan_kumulatif' => 0.03,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 3,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 3,
                'plan_kumulatif' => 0.05,
                'real_kumulatif' => 0.04,
            ],
            [
                'id' => 4,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 4,
                'plan_kumulatif' => 0.07,
                'real_kumulatif' => 0.13,
            ],
            [
                'id' => 5,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 5,
                'plan_kumulatif' => 0.07,
                'real_kumulatif' => 0.18,
            ],
            [
                'id' => 6,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 6,
                'plan_kumulatif' => 0.07,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 7,
                'project_id' => 1,
                'location_id' => 1,
                'timeline_id' => 7,
                'plan_kumulatif' => 0.08,
                'real_kumulatif' => 0.00,
            ],

            [
                'id' => 8,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 1,
                'plan_kumulatif' => 0.00,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 9,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 2,
                'plan_kumulatif' => 0.00,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 10,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 3,
                'plan_kumulatif' => 0.00,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 11,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 4,
                'plan_kumulatif' => 0.00,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 12,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 5,
                'plan_kumulatif' => 0.00,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 13,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 6,
                'plan_kumulatif' => 0.00,
                'real_kumulatif' => 0.00,
            ],
            [
                'id' => 14,
                'project_id' => 1,
                'location_id' => 2,
                'timeline_id' => 7,
                'plan_kumulatif' => 0.00,
                'real_kumulatif' => 0.00,
            ],
        ];


        $galleries = [
            [
                'id' => 1,
                'timeline_id' => 5,
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

        // Target::Truncate();
        Target::Insert($targets);

        // Gallery::Truncate();
        Gallery::Insert($galleries);
    }
}
