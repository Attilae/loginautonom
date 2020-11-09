@extends('base')

@section('styles')
<link href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="pt-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="ml-0 pl-0 col-md-12">            
                @if(isset($_GET['updated']))
                <div class="alert alert-success" role="alert">
                    Updated successfully!
                </div>
                @endif

                <form action="/employee/{{$employee['emp_no']}}/update" method="POST">
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" name="first_name" value="{{ $employee['first_name'] }}" required="required">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="last_name" value="{{ $employee['last_name'] }}" required="required">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option value="M" @if($employee->gender=="M") selected="selected" @endif>Male</option>
                            <option value="F" @if($employee->gender=="F") selected="selected" @endif>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input class="form-control" name="birth_date" value="{{ $employee['birth_date'] }}" required="required">
                    </div>
                    <div class="form-group">
                        <label>Hire Date</label>
                        <input class="form-control" name="hire_date" value="{{ $employee['hire_date'] }}" required="required">
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Save</button>
                </form>                        
            </div>
        </div>
        <div class="row">
            <form action="/employee/{{$employee['emp_no']}}/delete" method="POST">
                <div class="form-group">
                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger mb-5">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $( document ).ready(function() {
        $('input[name=birth_date]').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('input[name=hire_date]').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
@endsection