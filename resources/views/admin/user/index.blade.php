@extends('layouts.admin')

@section('content')

<div>
    <div class="row row-cols-3 mb-3">
        <div class="col">
            <a href="{{ route('create-user') }}" class="btn btn-primary">
                Create User
            </a>
        </div>
    </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $i => $item)
    <tr>
        
      <th scope="row">{{ $i+1 }}</th>
      <td>{{ $item['name'] }}</td>
      <td>{{ $item['email'] }}</td>
      <td>{{ $item['role']['name'] }}</td>
      <td>
        <a href="{{ route('edit-user', $item->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('delete-user', $item->id) }}" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
