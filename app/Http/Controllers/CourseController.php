<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = student::query();
        $data = $student->with('course')->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validateData = $request->validate([
            'course_name'=> ['required'],
            'faculty_name'=> ['required'],
            'course_no' => ['required']
        ]);

        $student = student::create([
            'faculty_name'=> $validateData['faculty_name']
        ]);

        $student->student()->create([
            'course_name'=> $validateData['course_name'],
            'faculty_name'=> $validateData['faculty_name'],
            'course_no' => $validateData['course_no'],
            'student_id' => $student->id
        ]);

        if (!$student) return response()->json(
            ["message" => "Failed to create Course"],
            500
        );
        return response()->json([
            ["message" => "Course created succesfull"],
            200
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = student::query();
        $data = $student->with('course')->find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course $course)
    {
        //
    }
}
