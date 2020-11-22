<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Posts;
use App\Category;
use App\Tags;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Posts::paginate(10);
        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $category = Category::all();
        return view('admin.post.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id'  => 'required',
            'picture' => 'required'
        ]);

        $picture = $request->picture;
        $new_picture = time() . $picture->getClientOriginalName();

        $post = Posts::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'picture' => 'upload/posts/' . $new_picture,
            'slug' => Str::slug($request->title)
        ]);
        $post->tags()->attach($request->tags);
        $picture->move('upload/posts/', $new_picture);
        return redirect()->route('post.index')->with('success', 'Post was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tags::all();
        $category = Category::all();
        $post = Posts::findorfail($id);
        return view('admin.post.edit', compact('post', 'tags', 'category'));
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id'  => 'required',
        ]);
        
        $post = Posts::findorfail($id);

        if($request->has('picture')) {
            $picture = $request->picture;
            $new_picture = time() . $picture->getClientOriginalName();
            $picture->move('upload/posts/', $new_picture);
            $post_data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'picture' => 'upload/posts/' . $new_picture,
                'slug' => Str::slug($request->title)
            ];
        }
        else {
            $post_data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->title)
            ];
        }

        $post->tags()->sync($request->tags);
        $post->update($post_data);
        
        return redirect()->route('post.index')->with('success', 'Post was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findorfail($id);
        $post->delete();

        return redirect()->back()->with('success', 'The post has been moved to trashed successfully!');
    }

    public function show_deleted() 
    {
        $deletedPost = Posts::onlyTrashed()->paginate(10);
        return view('admin.post.trash', compact('deletedPost'));
    }

    public function restore($id) 
    {
       $post = Posts::withTrashed()->where('id', $id)->first();
       $post->restore();  

       return redirect()->back()->with('success', 'The post has been restored successfully!');    
    }

    public function kill($id)
    {
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        return redirect()->back()->with('success', 'The post has been deleted permanently!');    

    }
}
