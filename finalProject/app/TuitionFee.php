<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TuitionFee extends Model
{
    protected $fillable = ['student_name', 'amount'];
}
