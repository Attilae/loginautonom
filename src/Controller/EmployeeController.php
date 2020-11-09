<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Model\Employee;
use App\Repository\EmployeeRepository;

class EmployeeController
{
    public function list(Request $request, JsonResponse $response): JsonResponse
    {
        
        $employees = Employee::with(['title' => function($query) {
            $query->select('emp_no', 'title');
        }])->with(['salaries' => function($query) {
            $query->select('emp_no', 'salary', 'from_date', 'to_date')
                ->where('to_date', '=', '9999-01-01');
        }])
        ->with(['departments' => function($query) {
            $query->select('dept_name')
                ->where('to_date', '=', '9999-01-01');;
        }]);

        $employeeRepository = (new EmployeeRepository($employees));

        $pageCount = \ceil($employeeRepository->employee->count() / Employee::PER_PAGE);
        $currentPage = $request->query->get('page', 1);
        $sort = str_replace('-', '.', $request->query->get('sort', 'emp_no'));
        $direction = $request->query->get('dir', 'asc');        

        $employees = $employeeRepository
            ->paginate($currentPage, Employee::PER_PAGE)
            ->search($_GET['searchKey'], $_GET['searchValue'])
            ->employee
            ->leftJoin('titles', 'titles.emp_no', '=', 'employees.emp_no')
            ->leftJoin('dept_emp', 'dept_emp.emp_no', '=', 'employees.emp_no')
            ->leftJoin('departments', 'dept_emp.dept_no', '=', 'departments.dept_no')
            ->orderBy($sort, $direction)            
        ;
        
        $employees = $employees->get();

        return $response->setData(['employees' => $employees]);
    }
}