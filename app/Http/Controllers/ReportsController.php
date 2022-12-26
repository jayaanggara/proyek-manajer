<?php

namespace App\Http\Controllers;

use App\Mail\SendReportMail;
use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\Reports;
use App\Service\myImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Reports::with(['proyek','files'])->orderBy('id','DESC')->get();
        return view('admin.reports.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Proyek::get();
        return view('admin.reports.create', compact('data'));
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
            'deskripsi' => 'required',
            'file_reports' => 'required',
        ]);
        
        DB::beginTransaction();
        try {
            $files = [];
            if($request->hasFile('file_reports')){
                foreach ($request->file_reports as $item) {
                    $image = new myImage;
                    $files[] = $image->saveDocuments($item, Str::random('10'), 'reports');
                }            
            }

            $reports = Reports::create([
                'project_id' => $request->proyek,
                'description' => $request->deskripsi
            ]);
            
            if(count($files) > 0) {
                foreach ($files as $item) {
                    $reports->files()->create([
                        'name' => $item,
                    ]);
                }  
            }                      

            DB::commit();
            
            return redirect('reports')->with('success', 'Reports has been created successfully');
        } catch (\Exception $e) {
            // throw $e;
            DB::rollBack();
        }

        // dd($validated);

        
        // dd('upload berhasil');
        // Reports::create($validated);

        // return redirect('reports')->with('success', 'Data Your Comment has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail($id)
    {
        try {
            // get email
            $reports = Reports::with('files', 'proyek', 'proyek.getUser')->whereId($id)->first();
            Mail::to($reports->proyek->getUser->email)->cc($reports->proyek->getClient->email)->queue(new SendReportMail($reports));

            return redirect('reports')->with('success', 'Reports has been sent to email');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
