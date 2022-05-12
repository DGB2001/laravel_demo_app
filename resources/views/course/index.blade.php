<h1>List of course</h1>
<div>
    <a href="{{ route('courses.create') }}">
        <button type="submit">Add Course</button>
    </a>
</div>
<div>
    <table border="1" width='60%' cellspacing='0'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
        @foreach ($courses as $course)
            <tr>
                <td>
                    {{ $course->id }}
                </td>
                <td>
                    {{ $course->name }}
                </td>
                <td>
                    {{ $course->created_at }}
                </td>
                <td>
                    {{ $course->updated_at->format('d/m/Y H:i:s') }} ({{ $course->updated_at->diffForHumans() }})
                </td>
                <td>
                    <a href="{{ route('courses.edit', $course) }}">
                        <button>Edit</button>
                    </a>
                    <form action="{{ route('courses.destroy', $course) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        {{--            <button href="{{ route('courses.destroy', ['course' => $course->id]) }}}">Delete</button>--}}
                        {{--            Neu co cot id thi moi lam kieu nay--}}
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
