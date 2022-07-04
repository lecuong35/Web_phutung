<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status', 'address', 'able_receive', 'total', 'handled'
    ];

}
