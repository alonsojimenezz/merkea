<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCron extends Model
{
    use HasFactory;

    protected $table = 'test_crons';

    protected $fillable = [
        'Test',
    ];
}
