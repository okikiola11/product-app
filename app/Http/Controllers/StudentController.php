<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        //DB::connection()->enableQueryLog();
        //$students = Student::all();

        $students = Student::withCount('comments')->with('courses')->get(); //eager loading using WITH

        // $students = Student::whereDoesntHave('comments', function($query) {
        //     $query->where('content', 'like', '%Another%');
        // })->get();

        // dd(DB::getQueryLog());
        //dd($students);

        if($students) {
            return view('students/index', [
                'students' => $students,
                'message' => 'Student record retrieved successfully',
            ]);

        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No student record found'
            ], 404);
        }
    }

    //  to open the create blade page
    public function showCreate() {
        return view('students/create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FirstName' => 'required|string|max:191',
            'LastName' => 'required|string|max:191',
            'phonenumber' => 'required|string',
            //'course' => 'required|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()->toArray()
            ]);
        } else {
            $student = Student::create([
                'student_id' => $request->student_id, //bcos this saved in the relationship, find a way to get the value
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName,
                'phone' => $request->phonenumber,
                //'course' => $request->course,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 201,
                    'redirect_url' => ('students.index'),
                    'message' => "Student created successfully",
                    'student' => $student,
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong",
                ]);
            }
        }
    }


    public function show($id)
    {
        $student = Student::find($id);

        if($student) {
            return response()->json([
                'status' => 200,
                'message' => $student
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such student found",
            ]);
        }
    }

    public function edit($id)
    {
        $student = Student::find($id);

        if($student) {
            return response()->json([
                'status' => 200,
                'message' => $student
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such student found",
            ], 404);
        }
    }


    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'FirstName' => 'required|string|max:191',
            'LastName' => 'required|string|max:191',
            'phone' => 'required|digits:11',
            'course' => 'required|max:191',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        } else {
            $student = Student::find($id);

            if ($student) {

                $student->update([
                    'FirstName' => $request->FirstName,
                    'LastName' => $request->LastName,
                    'phone' => $request->phone,
                    'course' => $request->course,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Student record updated successfully",
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such record found",
                ], 404);
            }
        }
    }

    public function destroy(int $id)
    {
        $student = Student::find($id);

        if($student) {
            $student->delete();

            return response()->json([
                'status' => 200,
                'message' =>  'Student record deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Something went wrong",
            ], 404);
        }
    }

    function home() {
        return 'You have logged in as a student';
    }
    // function search($FirstName)
    // {
    //     //dd($FirstName);
    //     return Student::where("FirstName", "like", "%". $FirstName . "%")->get();
    // }
}
