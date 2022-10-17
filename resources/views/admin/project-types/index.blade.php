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
            <a href="{{ route('proyek-type.create') }}" class="btn btn-primary">
                Create Project Type
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
                    <th>Type Name</th>
                    <th>Type Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Type Name</th>
                    <th>Type Description</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data as $i => $item)
            <tr> 
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['type_name'] }}</td>
                <td>{{ $item['type_description'] }}</td>
                <td>
                    <a href="{{ route('proyek-type.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('proyek-type.destroy', $item->id) }}" class="d-inline-block" method="post">
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                        @method('delete')
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
