@extends('layouts.app')
@section('content')

    <a href="{{route('task.create')}}" class="btn btn-outline-success me-2 mb-3" type="button">New Task</a>
    <ul class="list-group">
        @foreach ($records as $record)
            <li class="list-group-item" aria-current="true">
                <div class="row">
                    <div class="col-md-10">
                        <p>Name: {{$record->name}}</p>
                        <p>Priority: {{$record->priority}}</p>
                        <p>project: {{$record->project->name}}</p>
                    </div>
                    <div class="col-md-1">
                        <div class="col-md-12 bg-light" style="text-align: right;" >
                            <a href="{{route('task.edit',$record->id)}}" class="btn btn-primary me-2" type="button">Update</a>    
                            <form method="POST" action="{{route('task.destroy',$record->id)}}">
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