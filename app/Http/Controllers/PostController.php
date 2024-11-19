<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $allPosts = Post::all();
        return view('create', compact('allPosts'));
    }

    public function fileStoring(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:posts|max:255',
            'Description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ImageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('UploadedImage'), $ImageName);
        }

        $post = new Post();
        $post->name = $request->name;
        $post->Description = $request->Description;
        $post->image = $ImageName;

        $post->save();

        return redirect()->route('create')->with('success', "Your post has been created successfully");
    }

    public function updateData($id)
    {
        $sendedPost = Post::findOrFail($id);
        return view('update', compact('sendedPost'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:posts,name,' . $id . '|max:255',
            'Description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('UploadedImage'), $ImageName);

            if ($post->image && file_exists(public_path('UploadedImage/' . $post->image))) {
                unlink(public_path('UploadedImage/' . $post->image));
            }

            $post->image = $ImageName;
        }

        $post->name = $request->name;
        $post->Description = $request->Description;
        $post->save();

        return redirect()->route('create')->with('success', "Your post has been updated successfully");
    }

    public function delete($id){

    $post = Post::findOrFail($id);


        if ($post->image && file_exists(public_path('UploadedImage/' . $post->image))) {
            unlink(public_path('UploadedImage/' . $post->image));
        }

        
        $post->delete();

        return redirect()->route('create')->with('success', 'Post deleted successfully');
       }

}
