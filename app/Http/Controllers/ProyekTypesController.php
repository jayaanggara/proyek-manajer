<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyekType;

class ProyekTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProyekType::get();
        return view('admin.project-types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project-types.create');
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
            'type_name' => 'required',
            'type_description' => 'required',
        ]);
        ProyekType::create($validated);
        return redirect('proyek-type')->with('success', 'Data Your Comment has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ProyekType::where('id', $id)->first();
        return view('admin.Project-types.edit', compact('data'));
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
        $this->validate($request,[
            'type_name' => 'required',
            'type_description' => 'required',
        ]);
        $proyek_type = ProyekType::where('id', $id)->first();
        $proyek_type->type_name = $request->type_name;
        $proyek_type->type_description = $request->type_description;
        $proyek_type->save();
        return redirect('proyek-type')->with('success', 'Data Your Comment has been created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProyekType::where('id', $id)->delete();
        \Session::flash('notif', ['level' => 'success','message' => 'Data user berhasil didelete !']);
        return redirect()->route('proyek-type.index');
    }
}
