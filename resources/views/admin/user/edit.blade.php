@extends('layouts.admin')

@section('content')
<form method="post" action="{{ route('proses-edit-user', $data->id) }}" autocomplate="disable">
    @csrf
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $data['name'] }}">
            @if($errors->has('name'))
            <span>
                {{ $errors->first('name') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $data['email'] }}">
            @if($errors->has('email'))
            <span>
                {{ $errors->first('email') }}
            </span>
            @endif
        </div>
    </div>
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Role</label>
            <select name="roles_id" id="" class="form-control">
                @foreach ($data_role as $i => $item)
                <option value="{{ $item['id'] }}" {{ $item['id'] == $data['roles_id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                @endforeach
            </select>
            @if($errors->has('role'))
            <span>
                {{ $errors->first('role') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="">
            @if($errors->has('password'))
            <span>
                {{ $errors->first('password') }}
            </span>
            @endif
        </div>
    </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
