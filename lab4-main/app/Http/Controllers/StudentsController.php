<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Exception;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $student =Students::all();
            if($student)
            {
                return response()->json(['status' => 200, "message" => "get Students successfullly" , "data" => $student]);
            }
            return response()->json(['status' => 404, "message" => "Students not found"]);
        }
        catch(Exception $e)
        {
         return response()->json(["status" => 500, "message" => $e->getMessage()]);
        } 
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            $validate = 
            [
                "name" => "required|string|min:5|max:20",
                "email" => "required|string|email",
                "password" => "required|string|min:5|max:20",
                "age" => "required|integer",
            ];
            $validateDate = $request->validate($validate);
            $student = Students::create($validateDate);
            if ($student)
            {
             return response()->json(['status' => 201, "message" => "Students created successfully"]);
            }
            return response()->json(['status' => 400, "message" => "Students was fail to create"]);
        }
        catch(Exception $e)
        {
        return response()->json(["status" => 500, "message" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        try
        {
            $student =Students::findOrFail($id);
            if($student)
            {
                return response()->json(['status' => 200, "message" => "Students was found" , "data" => $student]);
            }
            // return response()->json(['status' => 404, "message" => "Students not found"]);
        }
        catch(Exception $e)
        {
         return response()->json(["status" => 500, "message" => $e->getMessage()]);
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try
        { 
            if( $student = Students::findOrFail($id))
            {
            $validate = 
            [
                "name" => "required|string|min:5|max:20",
                "email" => "required|string|email",
                "password" => "required|string|min:5|max:20",
                "age" => "required",
            ];
            $validateDate = $request->validate($validate);
            $student->update($validateDate);
            if ($student)
            {
             return response()->json(['status' => 200, "message" => "Students updated successfully"]);
            }
        
            return response()->json(['status' => 400, "message" => "Students was fail to update"]);
            }
            return response()->json(['status' => 404, "message" => "Students not found"]);
        }
        catch(Exception $e)
        {
        return response()->json(["status" => 500, "message" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try
        {
            $student =Students::findOrFail($id); 
            $student->delete($id);
            return response()->json(['status' => 200, "message" => " Students deleted successfullly"]);
            
            // return response()->json(['status' => 404, "message" => "Students not found"]);
        }
        catch(Exception $e)
        {
         return response()->json(["status" => 500, "message" => $e->getMessage()]);
        } 
    }
}
