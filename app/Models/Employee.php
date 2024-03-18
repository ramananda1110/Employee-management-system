<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;

    protected $table = 'employees';
    protected $fillable = [
        'employee_id',
        'grade',
        'name',
        'status',
        'division',
        'project_name',
        'project_code',
        'division',
        'designation',
        'mobile_number',
        'email',
    ];
}
