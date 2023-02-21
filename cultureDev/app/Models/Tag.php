<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
        // Define the table name if it's different from the default
        protected $table = 'tags';
    
        // Define the fillable attributes for mass assignment
        protected $fillable = [
            'name',
        ];
}
