<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Proyek;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proyek = Proyek::get();

        $p = $request->proyek ?? Proyek::first()->id;
        // // dd($p);
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
        $data['Aktif'] = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Aktif')->get();


        $now = Carbon::now();
        $future = $now->addDays(1)->format('Y-m-d');
        return view('admin.task.index', compact('data','future','proyek'));
    }

    public function exportTask(Request $request)
    {
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

        if($status == 'Aktif')
        $data = Task::whereHas('getProyek', function($q) use ($p){
            $q->where('id', $p);
        })->where('status','Aktif')->get();

        $pdf = \PDF::loadView('pdf.export-task', compact('data'));
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
        
        $data = Proyek::get();

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

        return redirect('task')->with('success', 'Data Your Comment has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Proyek::where('id', $id)->first();
        return view('admin.task.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_proyek = Proyek::get();
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

        return redirect('task')->with('success', 'Data Your Comment has been created successfully');
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
        return redirect($url)->with('success', 'Data Your Comment has been created successfully');
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
        \Session::flash('notif', ['level' => 'success','message' => 'Data user berhasil didelete !']);
        return redirect()->route('task.index');
    }
}
