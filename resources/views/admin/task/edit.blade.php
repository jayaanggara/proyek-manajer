@extends('layouts.admin')

@section('content')
<form method="post" action="{{ route('task.update', $data->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="row row-cols-3">
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Proyek</label>
            <select name="proyek" id="" class="form-control">
                @foreach ($data_proyek as $i => $item)
                <option value="{{ $item['id'] }}" {{ $item['id'] }}" {{ $item['id'] == $data['project_id'] ? 'selected' : '' }}>{{ $item['project_name'] }}</option>
                @endforeach
            </select>
            @if($errors->has('proyek'))
            <span>
                {{ $errors->first('proyek') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Status</label>
            <select name="status" id="" class="form-control">
                <option value="Open"  {{ 'Open' == $data['status'] ? 'selected' : '' }}>Open</option>
                <option value="Aktif"  {{ 'Aktif' == $data['status'] ? 'selected' : '' }}>Aktif</option>
                <option value="Progres"  {{ 'Progres' == $data['status'] ? 'selected' : '' }}>Progres</option>
                <option value="Pending"  {{ 'Pending' == $data['status'] ? 'selected' : '' }}>Pending</option>
            </select>
            @if($errors->has('status'))
            <span>
                {{ $errors->first('status') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Risk</label>
            <select name="risk" id="" class="form-control">
            <option value="Low"  {{ 'Low' == $data['status'] ? 'selected' : '' }}>Low</option>
            <option value="Medium"  {{ 'Medium' == $data['status'] ? 'selected' : '' }}>Medium</option>
            <option value="Hard"  {{ 'Hard' == $data['status'] ? 'selected' : '' }}>Hard</option>
            </select>
            @if($errors->has('risk'))
            <span>
                {{ $errors->first('risk') }}
            </span>
            @endif
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Name</label>
            <input type="text" class="form-control" name="title" value="{{ $data['title'] }}" id="exampleInputPassword1">
            @if($errors->has('title'))
            <span>
                {{ $errors->first('title') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">deskripsi</label>
            <textarea class=" editor-textarea" name="description" placeholder="Leave a Description here" id="floatingTextarea2" style="height: 100px">{{ $data['description'] }}</textarea>
            @if($errors->has('description'))
            <span>
                {{ $errors->first('description') }}
            </span>
            @endif
        </div>
    </div>

    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start" id="exampleInputEmail1" value="{{ $data['start'] }}" aria-describedby="emailHelp">
            @if($errors->has('start'))
            <span>
                {{ $errors->first('start') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">End Date</label>
            <input type="date" class="form-control" name="deadline"  value="{{ $data['deadline'] }}" id="exampleInputPassword1">
            @if($errors->has('deadline'))
            <span>
                {{ $errors->first('deadline') }}
            </span>
            @endif
        </div>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
