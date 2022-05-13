<h1>Form Edit Course</h1>

<form action="{{ route('courses.update', $course) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="txtNameCourse">Name of course:</label>
    <input type="text" id="txtNameCourse" name="name" placeholder="input name of course here"
           value="{{ $course->name }}" required>
    <button type="submit">Update</button>
</form>
@if($errors->has('name'))
    <span class="error">
            {{ $errors->first('name') }}
    </span>
@endif
