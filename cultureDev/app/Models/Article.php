<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'date_published',
        'description',
        'category_id',
        'auteur_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
        // return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
        // return $this->hasMany('App\Comment');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
        // return $this->belongsTo('App\category');
    }

    public function tags()  
    {  
        // Un article appartient à une ou plusieurs tages. 
        return $this->belongsToMany(Tag::class);  
    }  
}
