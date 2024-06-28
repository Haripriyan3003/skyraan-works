<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Education;
use Validator;

class ApiTesting extends Controller
{
    public function index(Request $request ,$id)
    {
        // Find the student by ID
        $student = Student::with('education')->find($id);

        // Check if the student exists
        if (!$student) {
            $data = [
                'status' => 404,
                'message' => 'Student not found'
            ];
            return response()->json($data, 404);
        }

        // Prepare the response data
        $data = [
            'status' => 200,
            'student' => $student, // Return the specific student with their education
        ];

        return response()->json($data, 200);
    }







    public function upload(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'email' => 'required|email|unique:students,email',
            'phone_no' => 'required|numeric',
            'address' => 'required',
            'degree' => 'required|array',
            'degree.*' => 'required|string',
            'institution_name' => 'required|array',
            'institution_name.*' => 'required',
            'percentage' => 'required|array',
            'percentage.*' => 'required|numeric',
            'year_of_passing' => 'required|array',
            'year_of_passing.*' => 'required|date_format:Y-m-d'
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        // Create a new student record
        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone_number = $request->phone_no;
        $student->address = $request->address;
        $student->save();

        // Loop through each education entry and save it
        for ($i = 0; $i < count($request->degree); $i++) {
            $education = new Education;
            $education->student_id = $student->id;
            $education->degree = $request->degree[$i];
            $education->institution_name = $request->institution_name[$i];
            $education->percentage = $request->percentage[$i];
            $education->year_of_passing = $request->year_of_passing[$i];
            $education->save();
        }

        // Prepare and return the response
        $data = [
            'status' => 200,
            'message' => 'Data stored successfully' ,
            'Student id ' =>$student->id
        ];
        return response()->json($data, 200);
    }




/*

    public function edit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:students,email,' . $id,
            'address' => 'required|string|max:100',
            'phone_no' => 'required|digits:10',
            'degree' => 'required|array',
            'degree.*' => 'required|string|max:50',
            'institution_name' => 'required|array',
            'institution_name.*' => 'required|string|max:255',
            'year_of_passing' => 'required|array',
            'year_of_passing.*' => 'required|date_format:Y-m-d',
            'percentage' => 'nullable|array',
            'percentage.*' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_no')
        ]);

        $educations = [];
        $updatedEducationIds = [];
        $existingEducation = $student->education ?? collect();

        foreach ($request->input('degree') as $index => $degree) {
            $institution_name = $request->input('institution_name')[$index];
            $year_of_passing = $request->input('year_of_passing')[$index];
            $percentage = $request->input('percentage')[$index] ?? null;

            $educationData = [
                'student_id' => $student->id,
                'degree' => $degree,
                'institution_name' => $institution_name,
                'year_of_passing' => $year_of_passing,
                'percentage' => $percentage,
            ];

            $existingEdu = $existingEducation->firstWhere('degree', $degree);

            if ($existingEdu) {
                $existingEdu->update($educationData);
                $educations[] = $existingEdu;
            } else {
                $newEducation = new Education($educationData);
                $newEducation->save();
                $educations[] = $newEducation;
            }
        }

        $updatedEducationIds = collect($educations)->pluck('id')->toArray();
        foreach ($existingEducation as $existingEdu) {
            if (!in_array($existingEdu->id, $updatedEducationIds)) {
                $existingEdu->delete();
            }
        }

        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student,
        ], 200);
    }
*/



public function edit(Request $request, $id)
{
    // Find the student by ID
    $student = Student::find($id);
    if (!$student) {
        return response()->json([
            'status' => 404,
            'message' => 'Student not found'
        ], 404);
    }

    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'name' => 'string|max:40',
        'email' => 'email|unique:students,email,' . $student->id,
        'phone_no' => 'numeric|digits:10',
        'degree' => 'array',
        'degree.*' => 'required|string|max:40',
        'institution_name' => 'array',
        'institution_name.*' => 'required|string|max:70',
        'percentage' => 'array',
        'percentage.*' => 'required|numeric',
        'year_of_passing' => 'array',
        'year_of_passing.*' => 'required|date_format:Y-m-d'
    ]);

    // Return validation errors if any
    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'message' => $validator->errors()
        ], 422);
    }

    // Update student details
    if ($request->has('name')) {
        $student->name = $request->name;
    }
    if ($request->has('email')) {
        $student->email = $request->email;
    }
    if ($request->has('address')) {
        $student->address = $request->address;
    }
    if ($request->has('phone_no')) {
        $student->phone_no = $request->phone_no;
    }
    $student->save();

    // Update or create education records if provided
    if ($request->has('degree')) {
        for ($i = 0; $i < count($request->degree); $i++) {
            if (isset($request->education[$i]['id'])) {
                // Update existing education record
                $education = Education::find($request->education[$i]['id']);
                if ($education && $education->student_id == $student->id) {
                    $education->degree = $request->degree[$i];
                    $education->institution_name = $request->institution_name[$i];
                    $education->percentage = $request->percentage[$i];
                    $education->year_of_passing = $request->year_of_passing[$i];
                    $education->save();
                }
            } else {
                // Create new education record
                $education = new Education;
                $education->student_id = $student->id;
                $education->degree = $request->degree[$i];
                $education->institution_name = $request->institution_name[$i];
                $education->percentage = $request->percentage[$i];
                $education->year_of_passing = $request->year_of_passing[$i];
                $education->save();
            }
        }
    }

    // Prepare and return the response
    return response()->json([
        'status' => 200,
        'message' => 'Data updated successfully'
    ], 200);
}














    public function delete($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            $data = [
                'status' => 200,
                'message' => "Data Deleted Successfully!!!"
            ];
        } else {
            $data = [
                'status' => 404,
                'message' => "Student not found"
            ];
        }

        return response()->json($data, 200);
    }

}

