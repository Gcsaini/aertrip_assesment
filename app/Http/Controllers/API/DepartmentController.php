<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Validator;
use Exception;
use App\Traits\ErrorTrait;
use App\Traits\ResponseTrait;


class DepartmentController extends Controller
{
    use ErrorTrait, ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $department = Department::latest()->paginate(10);
            return [
                'status'=>true,
                'data'=>$department
            ];
        } catch (Exception $e) {
            return $this->sendError('Somethng went wrong', [], 500); 
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:departments,name',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        try {
            
            $department = Department::create(['name'=>$request->name]);
            
            return $this->sendResponse($department, 'Department added successfully');
        } catch (Exception $e) {
            return $this->sendError('Somethng went wrong', [], 500); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->sendResponse(Department::find($id));
        } catch (Exception $e) {
            return $this->sendError('Somethng went wrong', [], 500); 
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100|unique:departments,name,'.$id,
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        try {
            $department = Department::find($id);
		   	$department->update(['name'=>$request->name]);
            return $this->sendResponse($department, 'Updated successfully');
        } catch (Exception $e) {
            return $this->sendError('Somethng went wrong', [], 500); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Department::destroy($id);
            return $this->sendResponse([], 'Deleted successfully');
        } catch (Exception $e) {
            return $this->sendError('Somethng went wrong', [], 500); 
        }

    }
}
