@extends('layouts.admin')

@section('content')

<div>
    <div class="row row-cols-3 mb-3">
        <div class="col">
            <a href="{{ route('task.create') }}" class="btn btn-primary">
                Create Task
            </a>
            <a href="{{ route('task.export-task') }}?proyek={{ request('proyek') }}" class="btn btn-primary">
                Export All
            </a> 
        </div>
        <div class="col">
            <span for="exampleInputEmail1" class="form-label">Proyek Type</span>
                <form action="" class="d-inline-block" method="get">
                    <select name="proyek" id="" class="form-control select2" onchange="this.form.submit()">
                        @foreach ($proyek as $i => $pro)
                        <option value="{{ $pro['id'] }}" {{ (!empty(request('proyek')) && $pro['id'] == request('proyek')) ? 'selected' : "" }}>{{ $pro['project_name'] }}</option>
                        @endforeach
                    </select>
                </form>
        </div>
    </div>
</div>
@if($data['Open']->count() > 0)
<div class="card-body">
    <a href="{{ route('task.export-task') }}?status=Open&proyek={{ request('proyek') }}" class="btn btn-primary">
        Export Task Open
    </a>
    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data['Open'] as $i => $item)
            <tr class="
            @if($future == $item['deadline'])
            bg-danger
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Aktif" {{ 'Aktif' == $item['status'] ? 'selected' : '' }}>Aktif</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
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
@endif
@if($data['Aktif']->count() > 0)
<div class="card-body">
    <a href="{{ route('task.export-task') }}?status=Aktif&proyek={{ request('proyek') }}" class="btn btn-primary">
        Export Task Aktif
    </a>
    <div class="table-responsive">
        <table class="table table-bordered"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data['Aktif'] as $i => $item)
            <tr class="
            @if($future == $item['deadline'])
            bg-danger
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Aktif" {{ 'Aktif' == $item['status'] ? 'selected' : '' }}>Aktif</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
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
@endif

@if($data['Pending']->count() > 0)
<div class="card-body">
    <a href="{{ route('task.export-task') }}?status=Pending&proyek={{ request('proyek') }}" class="btn btn-primary">
        Export Task Pending
    </a>
    <div class="table-responsive">
        <table class="table table-bordered"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data['Pending'] as $i => $item)
            <tr class="
            @if($future == $item['deadline'])
            bg-danger
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Aktif" {{ 'Aktif' == $item['status'] ? 'selected' : '' }}>Aktif</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
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
@endif

@if($data['Progres']->count() > 0)
<div class="card-body">
    <a href="{{ route('task.export-task') }}?status=Progress&proyek={{ request('proyek') }}" class="btn btn-primary">
        Export Task Progress
    </a>
    <div class="table-responsive">
        <table class="table table-bordered"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data['Progres'] as $i => $item)
            <tr class="
            @if($future == $item['deadline'])
            bg-danger
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Aktif" {{ 'Aktif' == $item['status'] ? 'selected' : '' }}>Aktif</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
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
@endif

@endsection
