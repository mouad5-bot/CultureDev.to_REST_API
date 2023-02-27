<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Http\Requests\UpdateArticle_tagRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ArticleTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Article $article)
    {
        $credentials = [
          'article_id' => $article->id,
          'tag_id' => $request->tag_id,
        ];

        ArticleTag::create($credentials);

        return response()->json([
            'status' => 'success',
            'message' => 'Tag added successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->tags;
        return response()->json([
            'status' => 'success',
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleTag $article_tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticle_tagRequest  $request
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticle_tagRequest $request, ArticleTag $article_tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Article $article)
    {
        $user = Auth::user();

        if(!$user->can('delete All article') && $article->user_id != $user->id){
            return response()->json([
                'status' => false,
                'message' => "You don't have the permission for delete this article!"
            ], 200);
        }

        $tag = $article->tags->find($request->tag_id);

        $tag->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tag deleted successfully'
        ], 200);
    }
}
