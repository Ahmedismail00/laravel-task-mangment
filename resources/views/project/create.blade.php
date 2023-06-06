@extends('layouts.app')
@section('content')
    <form action="{{ route('project.store') }}" method="POST" >
        @csrf
        <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection