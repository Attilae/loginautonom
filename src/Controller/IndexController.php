<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Jenssegers\Blade\Blade;
use App\Model\Employee;

class IndexController {

    private $blade;

    public function __construct() 
    {
        $this->blade = new Blade('../src/Views', '../cache');
    }

    public function index(Request $request)
    {        
        print $this->blade->make('index')->render();
    }

    public function edit(Request $request) 
    {
        $employee = Employee::where('emp_no', $request->query->get('id'))->first();

        print $this->blade->make('edit', ['employee' => $employee])->render();
    }

    public function update(Request $request) 
    {
        $employee = Employee::find($request->query->get('id'));
        $employee->first_name = $request->request->get('first_name');
        $employee->last_name = $request->request->get('last_name');
        $employee->gender = $request->request->get('gender');
        $employee->birth_date = $request->request->get('birth_date');
        $employee->hire_date = $request->request->get('hire_date');
        $employee->save();

        header('Location: /employee/' . $request->query->get('id') . '/edit?updated');
    }

    public function delete(Request $request) 
    {
        $employee = Employee::find($request->query->get('id'));
        $employee->delete();

        header('Location: /?deleted');
    }
}