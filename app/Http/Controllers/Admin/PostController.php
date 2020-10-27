<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->role=='Admin'){
            $posts = Post::paginate(5);
        } elseif (Auth::user()->role->role=='Editor') {
            $posts = Post::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(5);
        }
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
             'title'=>'required|min:5|max:100',
             'body'=>'required|min:5|max:500',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title'],'-');
        if(!empty($data['img'])){
            $data['img']=Storage::disk('public')->put( 'Images', $data['img'],);
        }
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->save();
        if(array_key_exists('tags',$data)){
            $newPost->tags()->sync($data['tags']);
        } else {
            $newPost->tags()->detach();
        }
        return redirect()->route('posts.index')->with('status','Hai inserito correttamente il post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();

        return view('admin.posts.edit',compact('post','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'],'-');
        if(array_key_exists('tags',$data)){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();

        }
        if(!empty($data['img'])){
            if (!empty($post->img)) {
                Storage::disk('public')->delete($post['img']);
            }
            $data['img'] = Storage::disk('public')->put('Images',$data['img']);
        }
        $data['updated_at'] = Carbon::now('Europe/Rome');
        $post->update($data);
        return redirect()->route('posts.index')->with('status','Hai modificato correttamente il post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status','Hai cancellato correttamente il post');
    }
}
