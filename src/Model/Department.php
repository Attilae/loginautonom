<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'dept_no';

    protected $visible = [
        'dept_no',
        'dept_name'        
    ];

    public function employees(): BelongsToMany
    {
        return $this->BelongsToMany(Employee::class, 'dept_emp', 'dept_no', 'emp_no');
    }
}