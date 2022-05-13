<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyCourseRequest;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_limit = 5;
        $search = $request->get('q');
        $courses = Course::query()->where('name', 'like', '%' . $search . '%')->paginate($page_limit);
        $courses->appends(['q' => $search]);
//        $course_limit = 10;
//        $courses = Course::paginate($course_limit);
//        $courses = Course::query()->get();
//        $courses = Course::get();
        return view('course.index', [
            'courses' => $courses,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Course\StoreCourseRequest $request
* //     * @return \Illuminate\Http\Response
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
        Course::query()->create($request->validated()); // chi lay nhung field da qua validate
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Course $course
//     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Course $course
//     * @return \Illuminate\Http\Response
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
    public function update(UpdateCourseRequest $request, Course $course)
    {
//        cach 1 query builder
//        Course::where('id', $course->id)->update(
//            $request->except(['_token', '_method'])
//        );
//        cach 2 OOP
//        $course->fill($request->validated());
//        $course->save();
        $course->update(
            $request->except(['_token', '_method'])
        );
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Course $course
//     * @return \Illuminate\Http\Response
     */
    public function destroy( DestroyCourseRequest $request, $course)
    {
        Course::destroy($course);
//        Course::destroy($course->id);
//        Course::where('id', $course)->delete();
//        $course->delete();
        return redirect()->route('courses.index');
    }
}
