<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $course_limit = 10;
//        $courses = Course::paginate($course_limit);
//        $courses = Course::query()->get();
        $courses = Course::get();
        return view('course.index', ['courses' => $courses]);
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
     * @param \App\Http\Requests\StoreCourseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         $course = new Course;
//         $course->name = $request->get('name');
//         $course->save();
//        $course->fill($request->except('_token'));
//        $course->save();
        Course::create($request->except('_token'));
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
     * @return \Illuminate\Http\Response
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
     * @param \App\Http\Requests\UpdateCourseRequest $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
//        cach 1 query builder
//        Course::where('id', $course->id)->update(
//            $request->except(['_token', '_method'])
//        );
//        cach 2 OOP
//        $course->fill($request->except(['_token', '_method']));
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
//        Course::destroy($course->id);
//        Course::where('id', $course)->delete();
        $course->delete();
        return redirect()->route('courses.index');
    }
}
