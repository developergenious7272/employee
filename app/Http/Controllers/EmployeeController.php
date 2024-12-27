<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Country;
use App\Models\Hobby;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $data = [];

    public function index()
    {
        $employees = Employee::paginate(3);
        $this->data['employees'] = $employees;
        return view('employees.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        $hobbies = Hobby::get();
        $this->data['countries'] = $countries;
        $this->data['hobbies'] = $hobbies;
        return view('employees.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees|max:255',
            'phone_number' => 'nullable|numeric|digits_between:5,15',
            'phone_code' => 'required_if:phone_number,!null|string',
            
            'gender' => 'required|in:Male,Female,Other',

            "hobby_id"    => "required|array",
            "hobby_id.*"  => "exists:hobbies,id",

            'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff,gif |max:4096',
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('uploads/employees'), $imageName);

        $employee = new Employee;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone_code = $request->phone_code;
        $employee->phone_number = $request->phone_number;
        $employee->gender = $request->gender;
        $employee->hobby_id = $request->hobby_id ? implode(',', $request->hobby_id) : null;
        $employee->address = $request->address;
        $employee->image = $imageName;
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee createdd');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = base64_decode($id);
        $employee = Employee::where('id',$id)->first();
        $hobbies = Hobby::get();
        $this->data['employee'] = $employee;
        $this->data['hobbies'] = $hobbies;
        
        if($this->data['employee']){
            return view('employees.show',$this->data);
        }
        else{
            return redirect()->route('employees.index')->with('error', 'No data found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = base64_decode($id);
        $employee = Employee::where('id',$id)->first();
        $countries = Country::get();
        $hobbies = Hobby::get();

        $this->data['employee'] = $employee;
        $this->data['countries'] = $countries;
        $this->data['hobbies'] = $hobbies;
        
        if($this->data['employee']){
            return view('employees.edit',$this->data);
        }
        else{
            return redirect()->route('employees.index')->with('error', 'No data found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $id = base64_decode($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'phone_number' => 'nullable|numeric|digits_between:5,15',
            'phone_code' => 'required_if:phone_number,!null|string',
            
            'gender' => 'required|in:Male,Female,Other',

            "hobby_id"    => "required|array",
            "hobby_id.*"  => "exists:hobbies,id",

            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,gif |max:4096',
        ]);

        $employee = Employee::where('id',$id)->first();

        if(isset($request->image)){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploads/employees'), $imageName);
            $employee->image = $imageName;
        }

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone_code = $request->phone_code;
        $employee->phone_number = $request->phone_number;
        $employee->gender = $request->gender;
        $employee->hobby_id = $request->hobby_id ? implode(',', $request->hobby_id) : null;
        $employee->address = $request->address;
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = base64_decode($id);
        $employee = Employee::where('id',$id)->first();
        if(!$employee){
            return redirect()->route('employees.index')->with('error', 'Record not found');
        }
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted');
    }
}
