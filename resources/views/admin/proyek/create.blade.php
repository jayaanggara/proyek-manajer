@extends('layouts.admin')

@section('content')

<form method="post" action="{{ route('proyek.store') }}" enctype="multipart/form-data" >
    @csrf
    @method('post')
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Project Name</label>
            <input type="text" class="form-control" name="project_name" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('project_name'))
            <span>
                {{ $errors->first('project_name') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Proyek Type</label>
            <select name="proyek_type[]" id="" class="form-control select2 select-multiple" multiple>
                @foreach ($data as $i => $item)
                <option value="{{ $item['id'] }}">{{ $item['type_name'] }}</option>
                @endforeach
            </select>
            @if($errors->has('proyek_type'))
            <span>
                {{ $errors->first('proyek_type') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Staf Proyek</label>
            <select name="proyek_user[]" id="" class="form-control select2 select-multiple" multiple>
                @foreach ($user as $i => $u)
                <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>
                @endforeach
            </select>
            @if($errors->has('proyek_type'))
            <span>
                {{ $errors->first('proyek_type') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Client Proyek</label>
            @foreach ($client as $i => $cliens)
                @if(Auth::user()->id == $cliens['id'])
                <input type="hidden" name="client" value="{{ $cliens['id'] }}">
                @endif
            @endforeach
            <select name="{{ (Auth::user()->role->name == 'Client') ? '': 'client' }}" id="" class="form-control" {{ (Auth::user()->role->name == 'Client') ? 'disabled': '' }}>
                @foreach ($client as $i => $cliens)
                <option value="{{ $cliens['id'] }}" {{ (Auth::user()->id == $cliens['id']) ? 'selected':'' }}>Client - {{ $cliens['name'] }}</option>
                @endforeach
            </select>
            @if($errors->has('proyek_type'))
            <span>
                {{ $errors->first('proyek_type') }}
            </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Project Description</label>
            <textarea class="form-control" name="project_description" placeholder="Leave a Description here" id="floatingTextarea2" style="height: 100px"></textarea>
            @if($errors->has('project_description'))
            <span>
                {{ $errors->first('project_description') }}
            </span>
            @endif
        </div>
    </div>
    <div class="row row-cols-3">
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Company Name</label>
            <input type="text" class="form-control" name="company_name" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('company_name'))
            <span>
                {{ $errors->first('company_name') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Site</label>
            <input type="text" class="form-control" name="site" id="exampleInputPassword1">
            @if($errors->has('site'))
            <span>
                {{ $errors->first('site') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Template</label>
            <select name="template" id="" class="form-control">
                @foreach ($template as $i => $templates)
                <option value="{{ $templates['id'] }}">templates - {{ $templates['name'] }}</option>
                @endforeach
            </select>
            @if($errors->has('site'))
            <span>
                {{ $errors->first('site') }}
            </span>
            @endif
        </div>
    </div>
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputEmail1" class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if($errors->has('start_date'))
            <span>
                {{ $errors->first('start_date') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" id="exampleInputPassword1">
            @if($errors->has('end_date'))
            <span>
                {{ $errors->first('end_date') }}
            </span>
            @endif
        </div>
    </div>
    <div class="row row-cols-2">
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Status</label>
            <select name="status" id="" class="form-control">
                <option value="Aktif">Aktif</option>
                <option value="Pending">Pending</option>
                <option value="complete">complete</option>
            </select>
            @if($errors->has('status'))
            <span>
                {{ $errors->first('status') }}
            </span>
            @endif
        </div>
        <div class="mb-3 col">
            <label for="exampleInputPassword1" class="form-label">Logo</label>
            <input class="form-control" type="file" name="logo" placeholder="Choose image" id="image">
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
