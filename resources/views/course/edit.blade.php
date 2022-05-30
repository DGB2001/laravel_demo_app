@extends('layouts.master')
@section('content')
    <h6>{{ $breadcrumb }}</h6>
    <h1>Form Edit Course</h1>

    <form action="{{ route('courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="txtNameCourse">Name of course:</label>
        <input type="text" id="txtNameCourse" name="name" placeholder="input name of course here"
               value="{{ $course->name }}" required>
        <button type="submit" class="btn waves-effect waves-light btn-info text-white">Update</button>
    </form>
    @if($errors->has('name'))
        <span class="error">
            {{ $errors->first('name') }}
    </span>
    @endif
@endsection
