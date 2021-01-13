<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class H_order extends Model
{
    use HasFactory;
    protected $table = 'h_order';
    public $timestamps = false;
}
