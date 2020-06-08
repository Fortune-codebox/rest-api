<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Resources\EmployeeResource;
use App\Helper\Functions\ApiReturnResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class EmployeeController extends Controller
{

    use ApiReturnResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();
        $resourcedEmployees = EmployeeResource::collection($employees);
        // dd($resourcedEmployee);
        if(!$employees) {
            return $this->apiResponse(
                false,
                'No Employees Available',
                []
        ); 
      }
      return $this->apiResponse(true, 'Created successfully', $resourcedEmployees, 200);


    }

    public function singleEmployee($id) {
        
        $appointment = Employee::findOrFail($id);
        // $resourcedEmployee = EmployeeResource::collection($appointment);
        if(!$appointment) {
            return $this->apiResponse(
                false,
                'Employee Not Available',
                []
        ); 
        }
        return $this->apiResponse(true, 'fetched successfully', $appointment, 200);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|',
            'last_name' => 'required|',
            'job_title' => 'required|',
            'salary' => 'required|',
            'period' => 'required|'
        ];
        $validation =  $this->validateRequest($request, $rules);

        if(!$validation['status']) return $validation;
        $employee = Employee::createIfNotExist($request->all());
        if(!$employee) {
            return $this->apiResponse(
                false,
                'Not Allowed To Create Duplicates',
                []
        );  
        }
        return $this->apiResponse(true, 'Created successfully', [], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $rules =  [
            'period' => 'required|'
        ];
        $validation =  $this->validateRequest($request, $rules);
        if(!$validation['status']) return $validation;

        $req = $request->only(['first_name', 'last_name', 'job_title', 'salary', 'period']);
        if(!$employee->update($req)){
            return $this->apiResponse(
                false,
                trans('Updating Error'),
                []
            );
        }
        return $this->apiResponse(true,'Updated successfully', [], 200);
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return $this->apiResponse(true,'Deleted successfully', [], 200);

    }
}
