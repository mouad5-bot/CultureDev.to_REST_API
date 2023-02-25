<?php

namespace App\Http\Controllers;

use App\Models\ArticleTag;
use App\Http\Requests\StoreArticle_tagRequest;
use App\Http\Requests\UpdateArticle_tagRequest;

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
     * @param  \App\Http\Requests\StoreArticle_tagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle_tagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticleTag  $article_tag
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleTag $article_tag)
    {
        //
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
    public function destroy(ArticleTag $article_tag)
    {
        //
    }
}
