<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Proyek;
use App\Models\Templates;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role->name == 'Administrator' || Auth::user()->role->name == 'Proyek Manajer') {
            $proyek = Proyek::get();
        } else if(Auth::user()->role->name == 'Client') {
            $proyek = Proyek::with('getType')->whereHas('getClient', function($query) {
                $query->whereId(Auth::user()->id);
            })->get();
        } else {
            $proyek = Proyek::with('getType')->whereHas('getStaf', function($query) {
                $query->whereUserId(Auth::user()->id);
            })->get();
        }

        $p = $request->proyek;
        
        if(!$p) {
            $user = Auth::user();
            
            if($user->roles_id == 4) {

                $proyekQuery = Proyek::whereClient($user->id)->first();
                $p = $proyekQuery->id;
                
            } else if($user->roles_id == 3) {
                $proyekQuery = Proyek::with('getStaf')->whereHas('getStaf', function($query) use ($user) {
                    $query->whereUserId($user->id);
                })->first(); 

                $p = $proyekQuery->id;
            } else {
                $proyekQuery = Proyek::first();
                $p = $proyekQuery->id;
            }
        }

        // dd(Task::whereHas('getProyek', function($q){
        //     $q->where('id', "1");
        // })->get());
        $data['Open'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Open')->get();
        $data['Pending'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Pending')->get();
        $data['Progres'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Progres')->get();
        $data['complete'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','complete')->get();

        // dd($proyek);

        $now = Carbon::now();
        $future = $now->addDays(1)->format('Y-m-d');
        return view('admin.task.index', compact('data','future','proyek'));
    }

    public function exportTask(Request $request)
    {
        $proyek = Proyek::find($request->proyek);
        if(empty($proyek)){
            $proyek = Proyek::find(1);
        }
        // dd($proyek);
        $status = request('status') ?? '';

        $p = $request->proyek ?? Proyek::first()->id;
        
        $data = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->get();

        // dd($data);
        
        if($status == 'Open')
        $data = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Open')->get();

        if($status == 'Pending')
        $data = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Pending')->get();

        if($status == 'Progres')
        $data = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Progres')->get();

        if($status == 'complete')
        $data = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','complete')->get();

        $proyek = proyek::find($p);
        $template = Templates::find($proyek->template_id);

        // dd($data);

        $pdf = \PDF::loadView('pdf.'.$template->name, compact('data','proyek'));
        // return $pdf->download('export.pdf');
        return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role->name == 'Administrator' || Auth::user()->role->name == 'Proyek Manajer') {
            $data = Proyek::get();
        } else if(Auth::user()->role->name == 'Client') {
            $data = Proyek::with('getType')->whereHas('getClient', function($query) {
                $query->whereId(Auth::user()->id);
            })->get();
        } else {
            $data = Proyek::with('getType')->whereHas('getStaf', function($query) {
                $query->whereUserId(Auth::user()->id);
            })->get();
        }


        return view('admin.task.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'proyek' => 'required',
            'status' => 'required',
            'title' => 'required',
            'risk' => 'required',
            'start' => 'required',
            'deadline' => 'required',
        ]);
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->risk = $request->risk;
        $task->attached_by = $request->user()->id;
        $task->start = $request->start;
        $task->deadline = $request->deadline;
        $task->project_id = $request->proyek;

        $task->save();
        
        $cektask = Task::whereId($task->id)->with(['getProyek.getStaf','getProyek.getClient'])->first();
        
        if(count($cektask->getProyek->getStaf) > 0)
        {
            foreach ($cektask->getProyek->getStaf as $item) {
                Notification::create([
                    'user_id' => $item->id,
                    'project_id' => $request->proyek,
                    'status' => 2,
                ]);
            }
        }
        Notification::create([
            'user_id' => $cektask->getProyek->getClient->id,
            'project_id' => $request->proyek,
            'status' => 2,
        ]);
        
        \Session::flash('notif', ['level' => 'success','message' => 'Data task has been created successfully']);
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(Auth::user()->role->name == 'Administrator' || Auth::user()->role->name == 'Proyek Manajer') {
            $proyek = Proyek::get();
        } else if(Auth::user()->role->name == 'Client') {
            $proyek = Proyek::with('getType')->whereHas('getClient', function($query) {
                $query->whereId(Auth::user()->id);
            })->get();
        } else {
            $proyek = Proyek::with('getType')->whereHas('getStaf', function($query) {
                $query->whereUserId(Auth::user()->id);
            })->get();
        }

        $p = $id;        

        $data['Open'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Open')->get();
        $data['Pending'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Pending')->get();
        $data['Progres'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Progres')->get();
        $data['complete'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','complete')->get();
       

       
        $now = Carbon::now();
        $future = $now->addDays(1)->format('Y-m-d');
        return view('admin.task.detail', compact('data','future','proyek'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role->name == 'Administrator' || Auth::user()->role->name == 'Proyek Manajer') {
            $data_proyek = Proyek::get();
        } else if(Auth::user()->role->name == 'Client') {
            $data_proyek = Proyek::with('getType')->whereHas('getClient', function($query) {
                $query->whereId(Auth::user()->id);
            })->get();
        } else {
            $data_proyek = Proyek::with('getType')->whereHas('getStaf', function($query) {
                $query->whereUserId(Auth::user()->id);
            })->get();
        }

        $data = Task::where('id', $id)->first();
        return view('admin.task.edit', compact('data','data_proyek'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->risk = $request->risk;
        $task->attached_by = $request->user()->id;
        $task->start = $request->start;
        $task->deadline = $request->deadline;
        $task->project_id = $request->proyek;
   
        $task->save();

        \Session::flash('notif', ['level' => 'success','message' => 'Data task has been updated successfully']);
        return redirect()->route('task.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UpdateStatus(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();
        $task->status = $request->status;
        $task->save();
        $url = route('task.index')."?proyek=".$task->project_id;
        \Session::flash('notif', ['level' => 'success','message' => 'Data status task has been updated successfully']);
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Task::where('id', $id)->delete();
        \Session::flash('notif', ['level' => 'success','message' => 'Data task has been deleted successfully']);
        return redirect()->route('task.index');
    }
}
