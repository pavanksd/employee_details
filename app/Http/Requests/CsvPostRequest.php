<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvPostRequest extends FormRequest
{

    // protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.emp_code'   => 'bail|required|alpha_num|unique:Employees,emp_code',
            '*.emp_name'   => 'bail|required|alpha',
            '*.emp_dept'   => 'bail|required|alpha',
            '*.emp_age'    => 'bail|required|numeric',
            '*.emp_exp'    => 'bail|required|numeric',
        ];
    }

    public function messages()
    {
        return [
            '*.emp_code.required'      => 'Employee code is required',
            '*.emp_name.required'      => 'Employee name is required',
            '*.emp_dept.required'      => 'Employee department is required',
            '*.emp_age.required'       => 'Employee age is required',
            '*.emp_exp.required'       => 'Employee Exp is required',
            '*.emp_name.alpha'         => 'Employee Name should be in Alphabet',
            '*.emp_code.alpha_num'     => 'Employee code should be in Alpha Numeric',
            '*.emp_dept.alpha'         => 'Employee department should be a Number',
            '*.emp_age.numeric'        => 'Employee age should be a Number',
            '*.emp_exp.numeric'        => 'Employee age should be a Number',
            '*.emp_code.unique'        => 'Employee code Must be unique',
        ];
    }
}
