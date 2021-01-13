<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TEST extends Model
{
    use HasFactory;
    protected $table = 'test';
    public $timestamps = false;
}
