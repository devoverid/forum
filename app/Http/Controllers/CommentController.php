<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request, $type, $slug)
    {
        $acc_type = ['discussion'];
        if (!in_array($type, $acc_type)) return abort(404);

        // if discussion comment
        if ($type == 'discussion')
        {
            // valdiate
            $request->validate(['content' => 'required|min:10']);

            // 
            $discussion = Discussion::whereSlug($slug)->first();

            // 404
            if (!$discussion) return abort(404);

            // comment
            $discussion->comments()->create([
                'user_id' => auth()->user()->id,
                'text' => $request->content
            ]);

            // redirect
            return redirect()->back();
        }

        return $request->all();
    }

    public function delete(Comment $comment)
    {
        // delete
        $comment->delete();

        // 
        return redirect()->back();
    }
}
