@extends('layouts.app')
@section('content')
    <form action="{{ route('project.update',$record->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required value="{{$record->name}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection