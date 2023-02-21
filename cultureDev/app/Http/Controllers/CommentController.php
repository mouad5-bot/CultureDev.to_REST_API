<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CommentController extends Controller
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
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $comment = Comment::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully save comment',
            'data' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $comment
     * @return JsonResponse
     */

    // TODO : khas nbdl had l param l type article 7it kndwz id dyal article wnjib comments dyalo
    public function show(int $comment): JsonResponse
    {
        $comments = Comment::where('article_id', $comment)->get();

        return response()->json([
            'status' => 'success',
            'length' => count($comments),
            'data' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param int $comment
     * @return JsonResponse
     */
    public function update(UpdateCommentRequest $request, int $comment): JsonResponse
    {
        $comment = Comment::find($comment);

        if(!$comment){
            return response()->json([
                'status' => 'error',
                'message' => 'comment not found'
            ], 404);
        }

        $comment->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully update comment',
            'data' => $comment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $comment
     * @return JsonResponse
     */
    public function destroy(int $comment): JsonResponse
    {
        $comment = Comment::find($comment);

        if(!$comment){
            return response()->json([
                'status' => 'error',
                'message' => 'comment not found'
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully delete comment',
            'data' => $comment,
        ]);
    }
}
