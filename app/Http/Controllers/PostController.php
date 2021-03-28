<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return Inertia::render('Posts/index',['posts'=>Post::orderBy('id','desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Posts/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title'=>'required | unique:posts','body'=>'required']);
        Post::create(['title'=>$request->title,'body'=>$request->body]);
        return redirect()->route('Posts.index')->with("successMessage","Post successfully created");  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::whereid($id)->first();
        return Inertia::render('Posts/show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $data = Post::whereid($post)->first();
         return Inertia::render('Posts/edit',['post'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['title'=>'required','body'=>'required']);
         $post = Post::whereid($id)->first();
         $post->title = $request->title;
         $post->body = $request->body;
         $post->save();

         return redirect()->route('Posts.index')->with('successMessage','Post successfully update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post = Post::whereid($id)->first();
         $post->delete();
         return redirect()->route('Posts.index')->with('successMessage','Post successfully deleted');
    }
}
