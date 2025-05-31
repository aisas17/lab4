<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Teachers;
use Exception;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $teachers = Teachers::all();
            if ($teachers) {
                return response()->json(['status' => 200, "message" => "Get teachers successfully", "data" => $teachers]);
            }
            return response()->json(['status' => 404, "message" => "Teachers not found"]);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = [
                "name" => "required|string|min:5|max:20",
                "email" => "required|string|email",
                "password" => "required|string|min:5|max:20",
                "age" => "required|integer",
            ];
            $validatedData = $request->validate($validate);
            $teacher = Teachers::create($validatedData);
            if ($teacher) {
                return response()->json(['status' => 201, "message" => "Teacher created successfully"]);
            }
            return response()->json(['status' => 400, "message" => "Failed to create teacher"]);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $teacher = Teachers::findOrFail($id);
            return response()->json(['status' => 200, "message" => "Teacher found", "data" => $teacher]);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $teacher = Teachers::findOrFail($id);
            $validate = [
                "name" => "required|string|min:5|max:20",
                "email" => "required|string|email",
                "password" => "required|string|min:5|max:20",
                "age" => "required|integer",
            ];
            $validatedData = $request->validate($validate);
            $teacher->update($validatedData);
            return response()->json(['status' => 200, "message" => "Teacher updated successfully"]);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $teacher = Teachers::findOrFail($id);
            $teacher->delete();
            return response()->json(['status' => 200, "message" => "Teacher deleted successfully"]);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()]);
        }
    }
}
