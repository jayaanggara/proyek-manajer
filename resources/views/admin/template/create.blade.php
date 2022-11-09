@extends('layouts.admin')

@section('content')
<form method="post" action="{{ route('template.store') }}">
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
            <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" id="exampleInputPassword1">
            @if($errors->has('deskripsi'))
            <span>
                {{ $errors->first('deskripsi') }}
            </span>
            @endif
        </div>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
