<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(AdminMessages::class, 'message_id', 'id');
    }
}
