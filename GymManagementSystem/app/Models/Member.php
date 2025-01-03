<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'membership_type', 'membership_start_date', 'membership_end_date'
    ];
}
