<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/comments",
     *     summary="Get list of comments",
     *     tags={"Comments"},
     *     @OA\Response(
     *         response=200,
     *         description="List of comments",
     *     )
     * )
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * @OA\Post(
     *     path="/api/comments",
     *     summary="Create a new comment",
     *     tags={"Comments"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"user_id", "post_id", "body"},
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="integer",
     *                     example=3
     *                 ),
     *                  @OA\Property(
     *                      property="post_id",
     *                      type="integer",
     *                      example=1
     *                  ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     example="Очень крутой комментарий"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="comment created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(StoreCommentsRequest $request)
    {
        $comment = Comment::create([
            'body' => $request->body,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);

        return response()->json($comment, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/comments/{id}",
     *     summary="Get comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID comment",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *          ),
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="List of comments",
     *     )
     * )
     */
    public function show(int $id)
    {
        $comment = Comment::find($id);
        return response()->json($comment, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/comments/{id}",
     *     summary="Update comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the comment to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"body"},
     *              @OA\Property(property="body", type="string", example="Обновленный крутой комментарий")
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Сomment updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Сomment not found",
     *     )
     * )
     */
    public function update(UpdateCommentRequest $request, int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['body'=>$request->body]);
        return response()->json($comment, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     summary="Delete comments",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of comment to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Comment deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->noContent();
    }
}
