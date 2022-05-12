<h1>Form Add Course</h1>

<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    <label for="txtNameCourse">Name of course:</label>
    <input type="text" id="txtNameCourse" name="name" placeholder="input name of course here" required>
    <button type="submit" name="create" value="create_course">Add</button>
</form>
