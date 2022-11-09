<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\ProyekType;
use App\Models\Task;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count(); 
        $proyek = Proyek::count();
        $task = Task::count();
        $proyek_complated = Proyek::whereStatus('Complated')->count();

        $project_progress = Proyek::with('getTask')->whereHas('getTask')->limit(5)->get();
        
        $dataProgress = [];

        foreach($project_progress as $item) {
            $percentage = $item->getTask()->whereStatus('Complated')->count() / $item->getTask->count();
            $dataProgress[] = [
                'project_name' => $item->project_name,
                'percentage' => ($percentage * 100)
            ];
        }

        return view('admin.dashboard.index', compact('users','proyek','task','proyek_complated', 'dataProgress'));
    }
}
