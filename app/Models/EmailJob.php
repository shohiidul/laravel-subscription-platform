<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'email_body',
        'status',
    ]; 
}
