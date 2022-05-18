@extends('layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.css"/>
@endpush
@section('content')
    <h1>List of course</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <a href="{{ route('courses.create') }}">
            <button type="submit" class="btn waves-effect waves-light btn-success text-white">Add Course</button>
        </a>
    </div>
    <div>
        <table class="table table-bordered" id="table-index">
            {{--            <caption class="dataTables_filter">--}}
            {{--                <form>--}}
            {{--                    <label for="txtSearch">Search:</label>--}}
            {{--                    <input type="search" name="q" id="txtSearch" class="form-control form-control-sm"--}}
            {{--                           value="{{ $search }}">--}}
            {{--                </form>--}}
            {{--            </caption>--}}
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            {{--            @foreach ($courses as $course)--}}
            {{--                <tr>--}}
            {{--                    <td>--}}
            {{--                        {{ $course->id }}--}}
            {{--                    </td>--}}
            {{--                    <td>--}}
            {{--                        {{ $course->name }}--}}
            {{--                    </td>--}}
            {{--                    <td>--}}
            {{--                        {{ $course->created_at }}--}}
            {{--                    </td>--}}
            {{--                    <td>--}}
            {{--                        {{ $course->updated_at->format('d/m/Y H:i:s') }} ({{ $course->updated_at->diffForHumans() }}--}}
            {{--                        )--}}
            {{--                    </td>--}}
            {{--                    <td>--}}
            {{--                                    <a href="{{ route('courses.edit', $course) }}">--}}
            {{--                                        <button class="btn waves-effect waves-light btn-info text-white">Edit</button>--}}
            {{--                                    </a>--}}
            {{--                        <form action="{{ route('courses.destroy', $course) }}" method="POST">--}}
            {{--                            @csrf--}}
            {{--                            @method('DELETE')--}}
            {{--                            --}}{{--            <button href="{{ route('courses.destroy', ['course' => $course->id]) }}}">Delete</button>--}}
            {{--                            --}}{{--            Neu co cot id thi moi lam kieu nay--}}
            {{--                            <button type="submit" class="btn waves-effect waves-light btn-danger text-white">Delete--}}
            {{--                            </button>--}}
            {{--                        </form>--}}
            {{--                    </td>--}}
            {{--                </tr>--}}
            {{--            @endforeach--}}

        </table>
    </div>
    {{--    {{ $courses->links() }}--}}
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.js"></script>

    <script>
        $(function () {
            buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };
            let table = $('#table-index').DataTable({
                dom: 'Blfrtip',
                select: true,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print'
                    }),
                    'colvis'
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('courses.api-index') !!}',
                columnDefs: [
                    {className: "not-export", "targets": [4, 5]}
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {
                        data: 'edit',
                        name: 'edit',
                        targets: 4,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            // console.log(data, type, row, meta);
                            return `<a class="btn waves-effect waves-light btn-info text-white" href="${data}">Edit</a>`;
                        }
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        targets: 5,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            // console.log(data, type, row, meta);
                            return `<form action="${data}" method="POST">
                                    @csrf
                            @method('DELETE')
                            <button type="button" class="btn waves-effect waves-light btn-danger text-white btn-delete">Delete</button>
                            </form>`;
                        }
                    }
                ]
            });
            $(document).on('click', '.btn-delete', function () {
                let row = $(this).parents('tr');
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function () {
                        console.log('Success');
                        // row.remove();
                        table.draw();
                    },
                    error: function () {
                        console.log('Fail');
                    }
                })
            });
        });
    </script>
@endpush
