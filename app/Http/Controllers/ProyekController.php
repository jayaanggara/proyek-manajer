<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\User;
use App\Models\ProyekType;
use App\Models\RelationsProjectsTypes;
use App\Models\RelationsProjectsUsers;
use App\Models\Templates;
use App\Service\myImage;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Template\Template;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->name == 'Administrator' || Auth::user()->role->name == 'Proyek Manajer') {
            $data = Proyek::with('getType')->get();
        } else if(Auth::user()->role->name == 'Client') {
            $data = Proyek::with('getType')->whereHas('getClient', function($query) {
                $query->whereId(Auth::user()->id);
            })->get();
        } else {
            $data = Proyek::with('getType')->whereHas('getStaf', function($query) {
                $query->whereUserId(Auth::user()->id);
            })->get();
        }
        

        return view('admin.proyek.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ProyekType::get();
        $user = User::where('roles_id', 3)->get();
        $client = User::where('roles_id', 4)->get();
        $template = Templates::get();
        return view('admin.proyek.create', compact('data','user','client','template'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            'status' => 'required',
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'site' => 'required',
            'company_name' => 'required',
        ]);
        $proyek = new Proyek;
        $proyek->project_name = $request->project_name;
        $proyek->project_description = $request->project_description;
        if($request->hasFile('logo')){
            $image = new myImage;
            $proyek->logo = $image->saveImage($request->logo, $request->project_name);
        }
        $proyek->status = $request->status;
        $proyek->user = $request->user()->id;
        $proyek->start_date = $request->start_date;
        $proyek->end_date = $request->end_date;
        $proyek->client = $request->client;
        $proyek->site = $request->site;
        $proyek->template_id = $request->template;
        $proyek->company_name = $request->company_name;
        $proyek->save();
        
        $proyek->getType()->sync($request->proyek_type);

        $proyek->getStaf()->sync($request->proyek_user);

        // $RelationsProjectTypes = new RelationsProjectsTypes;
        // $RelationsProjectTypes->user_id = $request->user()->id;
        // $RelationsProjectTypes->project_id = $proyek->id;
        // $RelationsProjectTypes->project_type_id = $request->proyek_type;
        // $RelationsProjectTypes->save();

        return redirect('proyek')->with('success', 'Data Your Comment has been created successfully');
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
            $data = Proyek::whereHas('getType', function($query) use ($id) {
                $query->where('project_type_id', $id);
            })->get();
        } else if(Auth::user()->role->name == 'Client') {
            $data = Proyek::whereHas('getType', function($query) use ($id) {
                $query->where('project_type_id', $id);
            })->whereHas('getClient', function($query) {
                $query->whereId(Auth::user()->id);
            })->get();
        } else {
            $data = Proyek::whereHas('getType', function($query) use ($id) {
                $query->where('project_type_id', $id);
            })->whereHas('getStaf', function($query) {
                $query->whereUserId(Auth::user()->id);
            })->get();
        }

        return view('admin.proyek.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Proyek::with('getType')->where('id', $id)->first();
        $proyektype = ProyekType::get();
        $selected_proyektype = $data->getType->pluck('id')->toArray();
        $user = User::where('roles_id', 3)->get();
        $client = User::where('roles_id', 4)->get();
        $template = Templates::get();
        $selected_user = $data->getStaf->pluck('id')->toArray();
        return view('admin.proyek.edit', compact('data','proyektype', 'selected_proyektype','user','client','selected_user','template'));
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
        $validated = $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            'status' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
            'site' => 'required',
            'company_name' => 'required',
        ]);
        $proyek = Proyek::with('getType')->where('id', $id)->first();;
        $proyek->project_name = $request->project_name;
        $proyek->project_description = $request->project_description;
        if($request->hasFile('logo')){
            $image = new myImage;
            if($proyek->logo != ""){
                $image->deleteImage($proyek->logo);    
            }
            $proyek->logo = $image->saveImage($request->logo, $request->project_name);
        }
        $proyek->status = $request->status;
        $proyek->user = $request->user()->id;
        $proyek->client = $request->client;
        $proyek->start_date = $request->start_date;
        $proyek->end_date = $request->end_date;
        $proyek->site = $request->site;
        $proyek->template_id = $request->template;
        $proyek->company_name = $request->company_name;
        $proyek->save();

        $proyek->getType()->sync($request->proyek_type);

        $proyek->getStaf()->sync($request->proyek_user);

        return redirect('proyek')->with('success', 'Data Your Comment has been created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Proyek::where('id', $id)->delete();
        \Session::flash('notif', ['level' => 'success','message' => 'Data user berhasil didelete !']);
        return redirect()->route('proyek.index');
    }
}
