@extends('layouts.admin')

@section('content')

<div>
    <div class="row row-cols-3 mb-3">
        <div class="col">
            <a href="{{ route('proyek.create') }}" class="btn btn-primary">
                Create Project
            </a>
        </div>
    </div>
</div>

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data as $i => $item)
            <tr>
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['project_name'] }}</td>
                <td>
                    @foreach($item['getType'] as $type)
                    <a href="">{{ $type['type_name'] }}</a>, 
                    @endforeach
                </td>
                <td>{{ $item['status'] }}</td>
                <td>
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{ $i+1 }}">View</a>
                    <a href="{{ route('proyek.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('task.show', $item->id) }}" class="btn btn-primary">Task</a>
                    <form action="{{ route('proyek.destroy', $item->id) }}" class="d-inline-block" method="post">
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                        @method('delete')
                    </form>
                    
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="exampleModal{{ $i+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $item['project_name'] }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $item['project_description'] }}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                        <tr>
                                            <td>Company Name</td>
                                            <td>:</td>
                                            <td>{{ $item['company_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>{{ $item['status'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td>:</td>
                                            <td>{{ $item->getUser->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Project Sart - End Date</td>
                                            <td>:</td>
                                            <td>{{ $item['start_date'] }} - {{ $item['end_date'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Project Site</td>
                                            <td>:</td>
                                            <td>{{ $item['site'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Project Type</td>
                                            <td>:</td>
                                            <td>
                                            @foreach($item['getType'] as $type)
                                            <a href="{{ route('proyek.show', $item->id) }}">{{ $type['type_name'] }}</a>, 
                                            @endforeach
                                            </td>
                                        </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="px-2">
                                    <img src="{{ $item['logo_url'] }}" class="w-100" alt="">
                                </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@endsection
