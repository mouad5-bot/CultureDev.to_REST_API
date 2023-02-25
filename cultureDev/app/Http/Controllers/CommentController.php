<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        $credentials = [
            'comment' => $request->comment,
            'article_id' => $request->article_id,
            'user_id' => Auth::user()->id,
        ];

        $comment = Comment::create($credentials);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully save comment',
            'data' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $comment = Comment::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $comment,
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

        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'comment not found'
            ], 404);
        }

        if(Auth::user()->cannot('edit comments') && Auth::user()->id != $comment->user_id){
            return response()->json([
                'status' => 'success',
                'message' => 'user does not have the right permissions'
            ], 403);
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

        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'comment not found'
            ], 404);
        }

        if(Auth::user()->cannot('delete comments') && Auth::user()->id != $comment->user_id){
            return response()->json([
                'status' => 'success',
                'message' => 'user does not have the right permissions'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully delete comment',
            'data' => $comment,
        ]);
    }
}
