<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerifyStudent extends Controller
{
    public function show()
    {
        return view('verify-student');
    }
    public function verifyStudent(Request $request)
{
    // Validate incoming request
    $request->validate([
        'id' => 'required|integer', // Expecting a numeric student ID
    ]);

    // Retrieve student based on ID and role
    $student = User::where('id', $request->id)
        ->where('role', 'student')
        ->first();

    // Check if the student exists and if the bus number matches
    if ($student) {
        // Assuming the logged-in user has a 'busno' field
        if ($student->busno === auth()->user()->busno) {
            return response()->json([
                'success' => true,
                'message' => 'Student verified successfully.',
                'data' => [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bus number does not match.',
                'student_busno' => $student->busno, // Include the student's bus number
            ], 403); // Forbidden response
        }
    }

    return response()->json([
        'success' => false,
        'message' => 'Invalid student ID.',
    ], 404);
}

}
