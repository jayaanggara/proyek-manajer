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
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                Create Roles
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
                    <th>Role Name</th>
                    <th>Deskripsi</th>
                    <th>jumlah pemilik</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Deskripsi</th>
                    <th>jumlah pemilik</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data as $i => $item)
            <tr> 
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['deskripsi'] }}</td>
                <td><a href="{{ route('roles.show', $item->id) }}">{{ $item['user_count'] }}</a></td>
                @if($item['name'] != 'Administrator')
                <td>
                    <form action="{{ route('roles.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                                    @csrf
                                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                                        <option value="1"  {{ '1' == $item['status'] ? 'selected' : '' }}>Aktif</option>
                                        <option value="2"  {{ '2' == $item['status'] ? 'selected' : '' }}>Deaktif</option>
                                    </select>
                                    @method('post')
                    </form>
                </td>
                <td>
                    <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <!-- <a href="{{ route('delete-user', $item->id) }}" class="btn btn-danger">Delete</a> -->
                </td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
        
    </div>
</div>
@endsection
