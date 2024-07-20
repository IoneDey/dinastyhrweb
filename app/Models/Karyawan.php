<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model {
    use HasFactory;
    protected $fillable = [
        'EmpID',
        'FullName',
        'Gender',
        'BirthDate',
        'MobilePhone',
        'HireDate',
        'Address',
        'EmployeeStatus',
        'StatusPKBTerakhir',
        'PT',
        'Department',
        'Position',
        'Email'
    ];
}
