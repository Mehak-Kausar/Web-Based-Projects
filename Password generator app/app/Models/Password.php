<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    protected $table = 'passwords';  // Specify the table name (optional)
    protected $fillable = ['generated_password'];  // Prevent mass-assignment issues
}
