<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $data = [];
        $data['current_time'] = date('Y M D, H:i:s');
        $data['sites_title'] = 'LLC Blog';
        $data['links'] = [
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'google' => 'https://google.com',
            'youtube' => 'https://youtube.com',
            'linkedIn' => 'https://linkedIn.com',
        ];
        $data['posts'] = Post::with('category', 'user')->select('id', 'title', 'user_id', 'category_id',
            'status')->paginate(10);
        return view('backend.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['current_time'] = date('Y M D, H:i:s');
        $data['sites_title'] = 'LLC Blog';
        $data['links'] = [
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'google' => 'https://google.com',
            'youtube' => 'https://youtube.com',
            'linkedIn' => 'https://linkedIn.com',
        ];
        $data['categories'] = Category::select('name', 'id')->get();
        return view('backend.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // database insert
        Post::create([
            'title' => trim($request->input('title')),
            'content' => trim($request->input('content')),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'thumbnail_path' => 'default.png',
            'user_id' =>auth()->user->id
        ]);


        // redirect
        session()->flash('type', 'success');
        session()->flash('message', 'Posts added');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
