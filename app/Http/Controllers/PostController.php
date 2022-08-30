<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $posts = Post::all();
        return Inertia::render("Posts/Index",['posts'=>$posts]);

        // return Inertia::render('Posts/Index',[
        //     "posts" => Post::all()->map(function($post){
        //         return [
        //             'id' => $post->id,
        //             'title' => $post->title,
        //             'category' => $post->category,
        //             'description' => $post->description,
        //             'image' => asset('storage'.$post->image)
        //         ];
        //     })
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Validator::make($request->all(), [
        //     'title' => ['required'],
        //     'image' => ['required'],
        //     'category' => ['required'],
        //     'description' => ['required'],
        // ])->validate();

        // $input = $request->all();

        // if ($image = $request->file('image')) {
        //     $destinationPath = 'images/';
        //     $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $postImage);
        //     $input['image'] = "$postImage";
        // }

        // Post::create($input);
        // return redirect()->route('posts.index');

        //dd($request->all());
        // $request->validate([
        //     'title' => 'required',
        //     'image' => 'required',
        //     'description' => 'required',
        //     'category' => 'required',
        // ]);

        // $newImageName = time() . '-' . $request->name . '-' .
        // $request->image->extension();
        // // $path = $request->image->move(public_path('images'), $newImageName);

        // dd($newImageName);

        // //$path = $request->file('image')->store('public/images');
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $path;
        // $post->save();
     
        // return redirect()->route('posts.index')
        //                 ->with('success','Post has been created successfully.');



        // if (!$request->has('image')) {
        //     return response()->json(['message' => 'Missing file'], 422);
        // }

        // $pic = $request->file('image');
        // $filename = $pic->getClientOriginalName();
        // $filename = time(). $filename;
        // $path = 'images';
        // $id = $request->id;
        // $pic->move($path,$filename);

        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->category = $request->category;
        // $post->image = $filename;
        // $post->save();
        // return redirect(route('posts.index'));

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/images'),$image_name);
        
            $image_path = "/images/" . $image_name;
        }


        //$image = $request->file('image')->store('images','public');
        Post::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            //'image' => $image
            'image' => $image_path
        ]);
        return  redirect(route('posts.index'));


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
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit',[
            'post'=>$post
        ]);
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
        // Validator::make($request->all(),[
        //     'title' => ['required'],
        //     //'image' => ['required'],
        //     'category' => ['required'],
        //     'description' => ['required']
        // ])->validate();

        // $input = $request->all();

        // if ($image = $request->file('image')) {
        //     $destinationPath = 'images/';
        //     $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $postImage);
        //     $input['image'] = "$postImage";
        // } else {
        //     unset($input['image']);
        // }

        // Post::find($id)->update($input);
        // return redirect()->route('posts.index');

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);
        
        $post = Post::find($id);
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $post->image = $path;
        }
        $post->title = $request->title;
        $post->category = $request->category;
        $post->description = $request->description;
        $post->save();
    
        return redirect()->route('posts.index')
                        ->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('posts.index');
    }
}
