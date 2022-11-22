@extends('layouts.admin')

@section('content')

<div class="px-3">
    <div class="row row-cols-2 mb-3 px-1">
        <div class="col text-left">
            <a href="{{ route('task.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                Create Task
            </a>
            @if(Auth::user()->role->name != 'Staff')
            <a href="{{ route('task.export-task') }}?proyek={{ request('proyek') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> 
            @endif
        </div>
        <div class="col text-end text-right">
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
    @if(Auth::user()->role->name != 'Staff')
    <a href="{{ route('task.export-task') }}?status=Open&proyek={{ request('proyek') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3">
        Export Task Open
    </a>
    @endif
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
            bg-danger text-white
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Complated" {{ 'Complated' == $item['status'] ? 'selected' : '' }}>Complated</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                @if(Auth::user()->role->name != 'Staff')
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <button class="btn btn-danger border">Delete</button>
                    @method('delete')
                </form>
                @endif
            </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@if($data['Complated']->count() > 0)
<div class="card-body">
    @if(Auth::user()->role->name != 'Staff')
    <a href="{{ route('task.export-task') }}?status=Complated&proyek={{ request('proyek') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3">
        Export Task Complated
    </a>
    @endif
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
            @foreach($data['Complated'] as $i => $item)
            <tr class="
            @if($future == $item['deadline'])
            bg-danger text-white
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Complated" {{ 'Complated' == $item['status'] ? 'selected' : '' }}>Complated</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                @if(Auth::user()->role->name != 'Staff')
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <button class="btn btn-danger border">Delete</button>
                    @method('delete')
                </form>
                @endif
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
    @if(Auth::user()->role->name != 'Staff')
    <a href="{{ route('task.export-task') }}?status=Pending&proyek={{ request('proyek') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3">
        Export Task Pending
    </a>
    @endif
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
            bg-danger text-white
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Complated" {{ 'Complated' == $item['status'] ? 'selected' : '' }}>Complated</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                @if(Auth::user()->role->name != 'Staff')
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <button class="btn btn-danger border">Delete</button>
                    @method('delete')
                </form>
                @endif
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
    @if(Auth::user()->role->name != 'Staff')
    <a href="{{ route('task.export-task') }}?status=Progress&proyek={{ request('proyek') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-3">
        Export Task Progress
    </a>
    @endif
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
            bg-danger text-white
            @endif
            ">
                
            <th scope="row">{{ $i+1 }}</th>
            <td>{{ $item['title'] }}</td>
            <td>
                <form action="{{ route('task.UpdateStatus', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <select name="status" id="" class="form-control" onchange="this.form.submit()">
                        <option value="Open"  {{ 'Open' == $item['status'] ? 'selected' : '' }}>Open</option>
                        <option value="Complated" {{ 'Complated' == $item['status'] ? 'selected' : '' }}>Complated</option>
                        <option value="Progres" {{ 'Progres' == $item['status'] ? 'selected' : '' }}>Progres</option>
                        <option value="Pending" {{ 'Pending' == $item['status'] ? 'selected' : '' }}>Pending</option>
                    </select>
                    @method('post')
                </form>
            </td>
            <td>
                <a href="{{ route('task.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                @if(Auth::user()->role->name != 'Staff')
                <form action="{{ route('task.destroy', $item->id) }}" class="d-inline-block" method="post">
                    @csrf
                    <button class="btn btn-danger border">Delete</button>
                    @method('delete')
                </form>
                @endif
            </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
