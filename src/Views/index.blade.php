@extends('base')

@section('content')

<div class="pt-5 bg-light">
    <div class="container">        
        <div class="row" style="overflow: auto">            
            <div class="form-group">
                <button class="prev btn btn-dark">< Prev </button>
                <button class="next btn btn-dark">Next ></button>
            </div>
            @if(isset($_GET['deleted']))
            <div class="form-group">
                <div class="alert alert-danger ml-2" role="alert">
                    Employee deleted
                </div>
            </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" ><input disabled="disabled"></th>
                        <th scope="col" ><input class="searchable" id="first_name"></th>
                        <th scope="col" ><input class="searchable" id="last_name"></th>
                        <th scope="col" ><input disabled="disabled"></th>
                        <th scope="col" ><input class="searchable" id="birth_date"></th>
                        <th scope="col" ><input class="searchable" id="hire_date"></th>
                        <th scope="col" ><input class="searchable" id="titles-title"></th>
                        <th scope="col" ><input disabled="disabled"></th>
                        <th scope="col" ><input class="searchable" id="departments-dept_name"></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th scope="col" class="sortable" data-sort="employees-emp_no">#</th>
                        <th scope="col" class="sortable" data-sort="employees-first_name">First Name</th>
                        <th scope="col" class="sortable" data-sort="employees-last_name">Last Name</th>
                        <th scope="col" data-sort="gender">Gender</th>
                        <th scope="col" class="sortable" data-sort="employees-birth_date">Birth Date</th>
                        <th scope="col" class="sortable" data-sort="employees-hire_date">Hire Date</th>
                        <th scope="col" class="sortable" data-sort="titles-title">Title</th>
                        <th scope="col" data-sort="salary">Salary</th>
                        <th scope="col" class="sortable" data-sort="departments-dept_name">Department</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

            <div class="form-group">
                <button class="prev btn btn-dark">< Prev </button>
                <button class="next btn btn-dark">Next ></button>
            </div>          
        </div>        
    </div>
</div>

@endsection

@section('scripts')
<script src="/js/table.js"></script>
@endsection

