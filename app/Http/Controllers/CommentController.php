<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request){
        // dd($request->input('product'));
        Comment::create([
            'content' => $request->input('comment'),
            'product_id' => $request->input('product'),
            'user_id' => Auth::user()->id,
        ]);
        return "Thành công";
    }

    public function show($product_id){
        $result = [];
        $product = Product::find($product_id);
        foreach ($product->comment as $comment){
            $avatar = $comment->user->information->avatar ? $comment->user->information->avatar : 'user.jpg';
            array_push($result, [
                'username' => $comment->user->information->fullname,
                'avatar' => $avatar,
                'comment' => $comment->content,
                'user_id' => $comment->user->id,
                'user_role' => $comment->user->role,
                'id' => $comment->id
                // 'time' => (time() - $comment->created_at)
            ]);
        }
        return json_encode($result);
    }

    public function update($id, Request $request){
        Comment::find($id)->update($request->input());
        return 1;
    }
    public function delete($id){
        Comment::find($id)->delete();
        return 1;
    }
}
