@extends('layouts.admin')

@section('content')
<form method="post" action="{{ route('task.store') }}">
    @csrf
    <div class="row row-cols-3">
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
            <label for="exampleInputPassword1" class="form-label">Status</label>
            <select name="status" id="" class="form-control">
                <option value="Open">Open</option>
                <option value="complete">complete</option>
                <option value="Progres">Progres</option>
                <option value="Pending">Pending</option>
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
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
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
            <input type="text" class="form-control" name="title" id="exampleInputPassword1">
            @if($errors->has('title'))
            <span>
                {{ $errors->first('title') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">deskripsi</label>
            <textarea class=" editor-textarea" name="description" placeholder="Leave a Description here" id="floatingTextarea2" style="height: 100px"></textarea>
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
            <input type="date" class="form-control" name="start" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('start'))
            <span>
                {{ $errors->first('start') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">End Date</label>
            <input type="date" class="form-control" name="deadline" id="exampleInputPassword1">
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
