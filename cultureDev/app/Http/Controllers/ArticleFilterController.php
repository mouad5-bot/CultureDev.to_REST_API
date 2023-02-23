<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleFilterController extends Controller
{
    public function filter(Request $request)
    {
        $query = Article::query();
    
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->has('tags')) {
            $tags = explode(',', $request->tags);
            $query->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('name', $tags);
            });
        }
    
        $articles = $query->get();
    
        return response()->json([
            'data' => $articles
        ]);
    }
    
}
