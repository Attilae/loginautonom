<?php

namespace App\Repository;

use App\Model\Employee;
use Illuminate\Database\Capsule\Manager as DB;

class EmployeeRepository
{
    public $employee;

    public function __construct($employee = null)
    {
        if (!$employee) {
            $employee = Employee::query();
        }

        $this->employee = $employee;
    }

    public function paginate(int $page, int $perPage): self
    {
        $this->employee
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
        ;

        return $this;
    }

    public function search(string $searchKey, string $searchValue): self
    {

        if(!empty($searchKey) && !empty($searchValue)) {

            $searchKey = str_replace('-', '.', $searchKey);
            
            $this->employee
                ->where($searchKey, 'LIKE', "%$searchValue%")
            ;
        }

        return $this;
    }
}