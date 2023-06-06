@extends('layouts.app')
@section('content')

<a href="{{route('project.create')}}" class="btn btn-outline-success me-2 mb-3" type="button">New Project</a>
    <ul class="list-group">
        @foreach ($records as $record)
            <li class="list-group-item" aria-current="true">
                <div class="row">
                    <div class="col-md-8">
                        <p>Name: {{$record->name}}</p>
                    </div>
                    <div class="col-md-2">
                        <select name="project_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                            <option selected>tasks</option>
                            @foreach ($record->tasks as $task)
                            <option>{{$task->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <div class="col-md-12 bg-light" style="text-align: right;" >
                            <a href="{{route('project.edit',$record->id)}}" class="btn btn-primary me-2" type="button">Update</a>    
                            <form method="POST" action="{{route('project.destroy',$record->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger delete-user" value="Delete">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="mb-2">{!! $records->links() !!}</div>
@endsection