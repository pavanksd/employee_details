<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CsvPostRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(){
        $emp_list = Employee::getAllEmployees();        
        return view('welcome',compact('emp_list'));
    }

    public function upload(){
        return view('upload');
    }
    
    public function employeeStore(Request $req){
        $validate_value = $req->validate([
            'employee_code' => 'required|numeric|min:1|max:5',
            'employee_name' => 'required|numeric|min:1|max:5',
            'employee_dept' => 'required|numeric|min:1|max:5',
            'employee_age'  => 'required|numeric|min:1|max:5',
            'employee_exp'  => 'required|numeric|min:1|max:5',
            ]);

        $fileExtension = $req->file('employee_csv')->getClientOriginalExtension();   
        
        if($fileExtension != 'csv'){
            $req->session()->flash('error_file', 'Upload a valid csv file');
            return back()->withInput();
            
        }
        $filepath       = $req->file('employee_csv')->getPathName();
        $csv_arr_val    = $this->csvToArray($filepath);
        if(count($csv_arr_val) > 20){
            $req->session()->flash('error_row', 'Max 20 rows allowed in csv file');
            return back()->withInput();

        }
        $employee_code  =  $validate_value['employee_code'] - 1;
        $emplyoee_name  =  $validate_value['employee_name'] - 1;
        $employee_dept  =  $validate_value['employee_dept'] - 1;
        $employee_age   =  $validate_value['employee_age'] - 1;
        $employee_exp   =  $validate_value['employee_exp'] - 1;
        
        //mapping user defined column to a respective array key
        $emp_arr        = array_map(function($csv_arr) use ($employee_code,$emplyoee_name,$employee_dept,$employee_age,$employee_exp) {
                                        return array(
                                            'emp_code' => $csv_arr[$employee_code],
                                            'emp_name' => $csv_arr[$emplyoee_name],
                                            'emp_dept' => $csv_arr[$employee_dept],
                                            'emp_age'  => $csv_arr[$employee_age],
                                            'emp_exp'  => $csv_arr[$employee_exp],
                                        );
                                    },$csv_arr_val);
                             
        $csv_Validator = new CsvPostRequest();
        $validator = Validator::make($emp_arr,$csv_Validator->rules(),$csv_Validator->messages())
                                ->stopOnFirstFailure(true);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Employee::saveEmpDetails($emp_arr);
        return redirect('/');
    }

    public function csvToArray($filepath){
        $file_handle = fopen($filepath, 'r');
        while (!feof($file_handle)) {
            $csv_vals[] = fgetcsv($file_handle);
        }

        fclose($file_handle);
        return $csv_vals;
    }
}
