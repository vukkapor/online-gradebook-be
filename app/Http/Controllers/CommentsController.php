<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comment;
class CommentsController extends Controller
{
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return $comment;
    }
}