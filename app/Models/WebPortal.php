<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Subscription;

class WebPortal extends Model
{
    use HasFactory;

    protected $fillable = [
        'portal_name',
        'status',
        'secret_key',
        'created_at',
        'updated_at',
    ]; 

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'portal_id'); // foreign key in the 'subscription' table is 'portal_id'
    }    
}

