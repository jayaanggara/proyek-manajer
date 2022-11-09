@extends('layouts.admin')

@section('content')
<form method="post" action="{{ route('reports.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Proyek</label>
            <select name="proyek" id="" class="form-control">
                @foreach ($data as $i => $item)
                <option value="{{ $item['id'] }}">{{ $item['project_name'] }}</option>
                @endforeach
            </select>
            @if($errors->has('proyek'))
            <span>
                {{ $errors->first('proyek') }}
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
    <div class="row">
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">File Reports</label>
            <input class="form-control" type="file" name="file_reports[]" placeholder="Choose image" id="image" multiple>
            @if($errors->has('status'))
            <span>
                {{ $errors->first('status') }}
            </span>
            @endif
        </div>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
