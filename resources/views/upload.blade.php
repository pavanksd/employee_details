@extends('layout')

@section('content')
<div class="container mt-5 w-50">
    <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
      <h3 class="text-center mb-5">Upload File</h3>
        @csrf
      @if(Session::has('error_row'))
        <div class="alert alert-danger">
          {{ Session::get('error_row') }}
        </div>
      @endif
      @if(Session::has('error_file'))
      <div class="alert alert-danger">
        {{ Session::get('error_file') }}
      </div>
    @endif
      @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

        <input type="file" name="employee_csv" accept=".csv" id="emp_file" onchange="enableinputfields()" >
        <div class="form-group mt-2">
            <p>Please Enter respective column number of Uploaded CSV file</p>
            <label for="emp_code">Employee code</label>
            <input type="number" name="employee_code" id="emp_code" class="form-control" placeholder="Employee code column"  value="{{ old('employee_code') }}" disabled>
            <label for="emp_name">Name column</label>
            <input type="number"  name="employee_name" id="emp_name" class="form-control" placeholder="Name column" value="{{ old('employee_name') }}" disabled>
            <label for="emp_dept">Department column</label>
            <input type="number" name="employee_dept" id="emp_dept" class="form-control" placeholder="Department column" value="{{ old('employee_dept') }}" disabled>
            <label for="emp_age">Age column</label>
            <input type="number" name="employee_age" id="emp_age"  class="form-control" placeholder="Age column" value="{{ old('employee_age') }}" disabled>
            <label for="emp_exp">Expericence column</label>
            <input type="number" name="employee_exp" id="emp_exp"  class="form-control" placeholder="Expericence column" value="{{ old('employee_exp') }}" disabled>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4" disabled>
            Upload File
        </button>
    </form>
</div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" ></script>
@endpush
