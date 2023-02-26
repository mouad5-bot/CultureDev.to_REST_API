<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ArticleController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('role:admin');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'articles' => $articles
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $user = Auth::user();
       $article= $user->articles()->create($request->all());
        // $article = Article::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "Article Created successfully!",
            'article' => $article
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->find($article->id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        return response()->json($article, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $user = Auth::user();

        if(!$user->can('edit All article') && $article->user_id != $user->id){
            return response()->json([
                'status' => false,
                'message' => "You don't have the permission for edit this article!"
            ], 200);
        }

        $article->update($request->all());

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "Article Updated successfully!",
            'article' => $article
        ], 200);
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $user = Auth::user();

        if(!$user->can('delete All article') && $article->user_id != $user->id){
            return response()->json([
                'status' => false,
                'message' => "You don't have the permission for delete this article!"
            ], 200);
        }

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        $article->delete();
        return response()->json([
            'status' => true,
            'message' => 'Article deleted successfully'
        ], 200);
     
    }
}
