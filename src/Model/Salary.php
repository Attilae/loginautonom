<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Salary extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'emp_no';

    protected $visible = [
        'salary',
        'from_date',
        'to_date'        
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}