@extends('layouts.admin')

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div>
    <div class="row row-cols-3 mb-3">
        <div class="col">
            <a href="{{ route('task.create') }}" class="btn btn-primary">
                Create Task
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
                    <th>Title</th>
                    <th>Status</th>
                    <th>Risk</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
            <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Risk</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data->getTask as $i => $item)
            <tr>
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['status'] }}</td>
            <td>{{ $item['risk'] }}</td>
            <td>{{ $item['deadline'] }}</td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('delete-user', $item->id) }}" class="btn btn-danger">Delete</a>
            </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
