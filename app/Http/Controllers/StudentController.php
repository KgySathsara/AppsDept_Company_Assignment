<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::query();
        $data = $user->with('student')->get();
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
            'name'=> ['required'],
            'email'=> ['required','unique:students'],
            'address' => ['required'],
            'phone' => ['required','digits:10','numeric'],
            'password' => ['required']
        ]);

        $user = User::create([
            'name'=> $validateData['name'],
            'email'=> $validateData['email'],
            'password'=> $validateData['password']
        ]);
        //dd($user);

        $student = $user->student()->create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'address' => $validateData['address'],
            'phone' => $validateData['phone'],
            'user_id' => $user->id
        ]);

        if (!$student) return response()->json(["Failed to create student"],500);

        return response()->json([["Student created succesfull"],200]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::query();
        $data = $user->with('student')->find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => ['required'],
            'email' => ['required','unique:students'],
            'address' => ['required'],
            'phone' => ['required','digits:10','numeric'],
            'id' => ['required'],
        ]);

        $user = User::find($id);

        if(!$user){
            return response() -> json(["User not found"]);
        }

        $user->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
        ]);

        //find the student  relationship with user
        $student = $user->student();

        //update student date
        $student->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'address' => $validateData['address'],
            'phone' => $validateData['phone'],
        ]);

        if(!$student){
            return response() -> json(["Student Update Error"]);
        }else{
            return response() -> json (["Student Update Success"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = student::find($id);

        if(!$student)
        {
            return response()->json(['student not found']);
        }
        $student->delete();
        return response()->json(['Student Deleted Successfully']);
    }
}
