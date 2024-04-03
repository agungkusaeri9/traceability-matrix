<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BugReport;
use App\Models\Project;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Dashboard')->only('index');
    }

    public function index()
    {
        $count = [
            'project' => Project::count(),
            'user' => User::count(),
            'bug' => BugReport::whereIn('status', [0, 1])->count(),
            'repository' => Repository::count()
        ];
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'count' => $count
        ]);
    }
}
