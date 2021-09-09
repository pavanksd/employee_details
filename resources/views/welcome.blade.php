@extends('layout')

@section('content')
<div>
    <h1 style="margin: 10px auto; text-align:center">Employee Details</h1>
    <a href="{{route('upload')}}" class="btn btn-primary float-right mr-4 mb-3">Upload Employee details</a>
</div>

<div class="p-4">
    <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">Emplyoee code</th>
              <th scope="col">Name</th>
              <th scope="col">Deptartment</th>
              <th scope="col">Age</th>
              <th scope="col">Experience</th>
            </tr>
          </thead>
          <tbody>
            @forelse($emp_list as $emp)
              <tr>
                <th scope="row">{{$emp->emp_code}}</th>
                <td>{{$emp->emp_name}}</td>
                <td>{{$emp->emp_dept}}</td>
                <td>{{$emp->emp_age}}</td>
                <td>{{$emp->emp_exp}}</td>
              </tr>
              @empty
              <tr>
                <td colspan="5">No Employee Records</td>
              </tr>
              @endforelse
            
          </tbody>
      </table>
</div>

@endsection