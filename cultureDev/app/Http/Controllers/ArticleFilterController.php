<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArticleFilterController extends Controller
{

    // public function filter(Request $request)
    // {
    //     $categoryName = Category::query();
        
    // // dd($categoryName);

    //     $articles = Article::select('articles.*')
    //                 ->join('categories', 'categories.id', '=', 'articles.category_id')
    //                 ->where('categories.name', $categoryName)
    //                 ->get();
    
    //     return response()->json([
    //         'data' => $articles
    //     ]);
    // }

    // public function filter(Request $request){
    //     $articl_query = Article::with(['category','tags']);

    //     if ($request->category) {
    //         $articl_query->whereHas('category', function($articles) use($request){
    //             $articles->where('name', $request->category);
    //         });
    //     }
    
    //     if ($request->tag) {
    //         $articl_query->whereHas('tag', function ($articles) use ($request) {
    //             $articles->where('name', $request->tag);
    //         });
    //     }
    
    //     $articles = $articl_query->get();
    //     return response()->json([
    //         'data'=>$articles,
    //     ], 200);
    // }







    // public function filter(Request $request){
    //     function FilterByCategory(Request $request){
    //         $articl_query = Article::with(['category']);

    //         if ($request->category) {
    //             $articl_query->whereHas('category', function($articles) use($request){
    //                 $articles->where('name', $request->category);
    //             });
    //         }
        
    //         $articles = $articl_query->get();

    //         return response()->json([
    //             'data'=>$articles,
    //         ], 200);
    //     }

    //     







    public function filter(Request $request){
        $articl_query = Article::with(['user','category','tags']);

        if ($request->category) {

            $dataCat = $request->category;

            $articl_query->whereHas('category', function($articles) use($dataCat){
                $articles->where('name', 'like', '%' . $dataCat . '%');
            });
        }
    
        if ($request->tags) {
            
            $data = $request->tags;
            
            $articl_query->whereHas('tags', function ($articles) use ($data) {
                $articles->where('name', 'like', '%' . $data . '%');
            });
            
        }
    
        $articles = $articl_query->get();
        return response()->json([
            'data'=>$articles,
        ], 200);
    }

}

