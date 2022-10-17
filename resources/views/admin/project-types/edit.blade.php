@extends('layouts.admin')

@section('content')
<form method="post" action="{{ route('proyek-type.update', $data->id) }}">
    @csrf
    @method('put')
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name="type_name" id="exampleInputEmail1" value="{{ $data['type_name'] }}">
            @if($errors->has('type_name'))
            <span>
                {{ $errors->first('type_name') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" name="type_description" id="exampleInputPassword1" value="{{ $data['type_description'] }}">
            @if($errors->has('type_description'))
            <span>
                {{ $errors->first('type_description') }}
            </span>
            @endif
        </div>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
