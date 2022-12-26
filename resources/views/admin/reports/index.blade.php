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
            <a href="{{ route('reports.create') }}" class="btn btn-primary">
                Create Reports
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
                    <th>Reports Name</th>
                    <th>Deskripsi</th>
                    <th>Date Reports</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Reports Name</th>
                    <th>Deskripsi</th>
                    <th>Date Reports</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($data as $i => $item)
            <tr> 
                <th scope="row">{{ $i+1 }}</th>
                <td>{{ $item->proyek->project_name }}</td>
                <td>{{ $item['description'] }}</td>
                <td>{{ date('F Y', strtotime($item->created_at)) }}</td>
                <td>                    
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{ $i+1 }}">View</a>
                    <form action="{{ route('reports.sendEmail', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Send</button>
                    </form>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="exampleModal{{ $i+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $item->proyek->project_name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <p>{{ $item['description'] }}</p>
                                <ul>
                                    @foreach($item->files as $i => $it)
                                    <li><a href="{{ \Storage::url('public/'.$it->name) }}" download>{{ $it->name }}</a></li>
                                    @endforeach
                                </ul>
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
</div>
@endsection
