<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_order extends Model
{
    use HasFactory;
    protected $table = 'm_order';
    const CREATED_AT = 'Sys_date';
    const UPDATED_AT  = 'Sys_date';
}
