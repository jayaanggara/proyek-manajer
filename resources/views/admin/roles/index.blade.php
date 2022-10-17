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
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Deskripsi</th>
                    <th>jumlah pemilik</th>
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
                <td>
                    <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('delete-user', $item->id) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">BIMC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid mollitia facere neque</p>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                            <tr>
                                <td>Company Name</td>
                                <td>:</td>
                                <td>BIMC Hospital</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>Active</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>:</td>
                                <td>Adi Satwika </td>
                            </tr>
                            <tr>
                                <td>Project Sart - End Date</td>
                                <td>:</td>
                                <td>19/08/2022 - 23/08/2022</td>
                            </tr>
                            <tr>
                                <td>Project Site</td>
                                <td>:</td>
                                <td>Https://bimcbali.com</td>
                            </tr>
                            <tr>
                                <td>Project Type</td>
                                <td>:</td>
                                <td>
                                    <a href="">Bulanan</a>, 
                                    <a href="">Graphic Designer</a>
                                </td>
                            </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                        <div class="px-2">
                        <img src="{{ asset('/assets') }}/img/logo.png" class="w-100" alt="">
                    </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection
