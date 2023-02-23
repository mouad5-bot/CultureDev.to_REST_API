<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'article_tag';

    use HasFactory;
    protected $fillable = [
        'article_id',
        'tag_id',
    ];
}
