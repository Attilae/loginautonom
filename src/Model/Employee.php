<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{

    public $timestamps = false;

    public const PER_PAGE = 20;

    protected $primaryKey = 'emp_no';

    protected $visible = [
        'emp_no',
        'birth_date',
        'first_name',
        'last_name',
        'gender',
        'hire_date',

        'title',

        'salaries',

        'departments'
    ];

    public function title(): HasOne
    {
        return $this->hasOne(Title::class, 'emp_no', 'emp_no');
    }

    public function salaries(): HasMany
    {
        return $this->HasMany(Salary::class, 'emp_no', 'emp_no');
    }

    public function departments(): BelongsToMany
    {
        return $this->BelongsToMany(Department::class, 'dept_emp', 'emp_no', 'dept_no');
    }
}