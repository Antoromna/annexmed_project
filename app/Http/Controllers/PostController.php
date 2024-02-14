<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Rules\UniquePostTitle;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();


        $posts = Post::query();

        if ($request->has('category')) {
            $categoryId = $request->category;
            $posts->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });
        }

        $posts = $posts->paginate(2);

        return view('home', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', new UniquePostTitle],
            'content' => ['required', 'string'],
            'publication_date' => ['required', 'date'],
        ], [
            'title.unique_post_title' => 'The post title must be unique.',
            'content.required' => 'The content field is required.',
            'publication_date.required' => 'The publication date field is required.'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->publication_date = $request->publication_date;
        $post->save();
        $post->categories()->attach($request->categories);
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->publication_date = $request->publication_date;
        $post->save();
        $post->categories()->attach($request->categories);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
