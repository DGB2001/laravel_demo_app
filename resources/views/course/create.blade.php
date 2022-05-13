<h1>Form Add Course</h1>

<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    <label for="txtNameCourse">Name of course:</label>
    <input type="text" id="txtNameCourse" name="name" value="{{ old('name') }}" placeholder="input name of course here">
    <button type="submit" name="create" value="create_course">Add</button>
</form>
@if($errors->has('name'))
    <span class="error">
            {{ $errors->first('name') }}
    </span>
@endif
{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
