<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyCourseRequest;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;

class CourseController extends Controller
{
    private Builder $model;

    public function __construct()
    {
        $this->model = (new Course())->query();
        $router_name = Route::currentRouteName();
        $arr = explode('.', $router_name);
        $arr = array_map('ucfirst', $arr);
        $breadcrumb = implode(' / ', $arr);
        View::share('breadcrumb', $breadcrumb);
        View::share('title', 'Course');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $page_limit = 5;
//        $search = $request->get('q');
//        $courses = Course::query()->where('name', 'like', '%' . $search . '%')->paginate($page_limit);
//        $courses->appends(['q' => $search]);
//        $course_limit = 10;
//        $courses = Course::paginate($course_limit);
//        $courses = Course::query()->get();
//        $courses = Course::get();
//        return view('course.index', [
//            'courses' => $courses,
//            'search' => $search
//        ]);
        return view('course.index');
    }

    public function api()
    {
//        Khong dung thu vien
//        $data = $this->model->paginate();
//        $arr = [];
//        $arr['draw'] = $data->currentPage();
//        $arr['data'] = $data->items();
//        foreach ($data->items() as $item) {
//            $item->edit = route('courses.edit', $item);
//            $item->delete = route('courses.destroy', $item);
//        }
//        $arr['recordsTotal'] = $data->total();
//        $arr['recordsFiltered'] = $data->total();
//        return $arr;
//       *** Dung thu vien Datatables ***
//        cach 1
//        return Datatables::of(Course::query())
//            ->addColumn('edit', function ($object) {
//                $link = route('courses.edit', $object);
//                return "<a href='$link'>
//                            <button class='btn waves-effect waves-light btn-info text-white'>Edit</button>
//                        </a>";
//            })->rawColumns(['edit'])->make(true);
//        cach 2
        return Datatables::of($this->model)
            ->addColumn('edit', function ($object) {
                return route('courses.edit', $object);
            })
            ->addColumn('delete', function ($object) {
                return route('courses.destroy', $object);
            })
            ->make(true);
    }

    public function apiName(Request $request)
    {
        return $this->model->where('name', 'like', '%' . $request->get('q') . '%')
            ->get([
                'id',
                'name'
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Course\StoreCourseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
//        dd($request->validated());
//         $course = new Course;
//         $course->name = $request->get('name');
//         $course->save();
//        $course->fill($request->validated());
//        $course->save();
//        Course::query()->create($request->except('_token'));
        $this->model->create($request->validated()); // chi lay nhung field da qua validate
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Course $course
     * //     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
//        $object = Course::where('id', $course)->first();
//        $object = Course::find($course);
        return view('course.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Course\UpdateCourseRequest $request
     * @param \App\Models\Course $course
     * //     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, $courseId)
    {
//        cach 1 query builder
//        $this->model::where('id', $courseId)->update(
//            $request->validated()
//        );
//        cach 2 OOP
//        $course->fill($request->validated());
//        $course->save();
//        $course->update(
//            $request->except(['_token', '_method'])
//        );
        $object = $this->model->find($courseId);
        $object->fill($request->validated());
        $object->save();
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Course $course
     * //     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyCourseRequest $request, $courseId)
    {
//        $this->model->find($courseId)->delete();
        $this->model->where('id', $courseId)->delete();
//        $course->delete();
//        return redirect()->route('courses.index');

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
