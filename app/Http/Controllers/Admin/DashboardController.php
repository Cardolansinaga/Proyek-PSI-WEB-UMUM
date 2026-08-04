<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achievement;
use App\Models\Post;
use App\Models\PpdbApplication;
use App\Models\Student;

class DashboardController extends AdminController
{
    public function __invoke()
    {
        return view('pages.admin.dashboard', [
            'stats' => [
                'posts' => Post::count(),
                'achievements' => Achievement::count(),
                'students' => Student::count(),
                'ppdb' => PpdbApplication::count(),
            ],
        ]);
    }
}
