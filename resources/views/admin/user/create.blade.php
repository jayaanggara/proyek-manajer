@extends('layouts.admin')

@section('content')
<form method="post" action="{{ route('proses-create-user') }}">
    @csrf
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('name'))
            <span>
                {{ $errors->first('name') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="exampleInputPassword1">
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
                @foreach ($data as $i => $item)
                    @if($item['name'] != 'Administrator')
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endif
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
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            @if($errors->has('password'))
            <span>
                {{ $errors->first('password') }}
            </span>
            @endif
        </div>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
