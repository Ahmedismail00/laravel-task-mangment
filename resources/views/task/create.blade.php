@extends('layouts.app')
@inject('projects','App\Models\Project')

@section('content')
    <form action="{{ route('task.store') }}" method="POST" >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="exampleInputPriority" class="form-label" required>Priority</label>
            <input name="priority" type="number" class="form-control" id="exampleInputPriority" required>
        </div>

        <div class="mb-3">
            <select name="project_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected>Open this select menu</option>
                @foreach ($projects->get(['id','name']) as $project)
                <option value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection