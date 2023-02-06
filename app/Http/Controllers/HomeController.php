<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\ProyekType;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $proyek_complete = Proyek::whereStatus('complete')->count();

        if(Auth::user()->role->name == 'Administrator' || Auth::user()->role->name == 'Proyek Manajer') {
            $project_progress = Proyek::with('getTask')->whereHas('getTask')->limit(5)->get();
        } else if(Auth::user()->role->name == 'Client') {
            $project_progress = Proyek::with(['getType','getTask'])->whereHas('getClient', function($query) {
                $query->whereId(Auth::user()->id);
            })->get();
        } else {
            $project_progress = Proyek::with(['getType','getTask'])->whereHas('getStaf', function($query) {
                $query->whereUserId(Auth::user()->id);
            })->get();
        }
        
        
        $dataProgress = [];
        $percentage = 0;
        foreach($project_progress as $item) {
            if($item->getTask()->whereStatus('complete')->count() > 0){
                $percentage = $item->getTask()->whereStatus('complete')->count() / $item->getTask->count();
            
            if($percentage){
                $dataProgress[] = [
                    'project_name' => $item->project_name,
                    'percentage' => ($percentage * 100)
                ];
            }
        } else {
            $dataProgress[] = [
                'project_name' => $item->project_name,
                'percentage' => 0
            ];
        }
        }

        return view('admin.dashboard.index', compact('users','proyek','task','proyek_complete', 'dataProgress'));
    }
}
