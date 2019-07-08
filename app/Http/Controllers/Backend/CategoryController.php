<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function showindex()
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
        $data['categories'] = Category::select('id', 'name', 'slug', 'status')->paginate(3);
        return view('backend.category.index', $data);
    }

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
        return view('backend.category.create', $data);
    }

    public function store(Request $request)
    {
        // validation
        $rules = [
            'name' => 'required|unique:categories,name',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // database insert
        Category::create([
            'name' => trim($request->input('name')),
            'slug' => str_slug(trim($request->input('name'))),
            'status' => $request->input('status'),
        ]);

        // redirect
        session()->flash('type', 'success');
        session()->flash('message', 'Category added');

        return redirect()->back();
    }

    public function show($id)
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
        $data['category'] = Category::select('id', 'name', 'slug', 'status', 'created_at')->find($id);

//        something problem relation
//        $data['category'] = Category::with('posts')->select('id', 'name', 'slug', 'status', 'created_at')->find($id);
        return view('backend.category.show', $data);
    }

    public function edit($id)
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
        $data['category'] = Category::select('id', 'name', 'slug', 'status', 'created_at')->find($id);
        return view('backend.category.edit', $data);
    }

    public function update($id, Request $request)
    {
        // validation
        $rules = [
            'name' => 'required|unique:categories,name,' . $id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // database update
        $category = Category::find($id);
        $category->update([
            'name' => trim($request->input('name')),
            'slug' => str_slug(trim($request->input('name'))),
            'status' => $request->input('status'),
        ]);

        // redirect
        session()->flash('type', 'success');
        session()->flash('message', 'Category updated');

        return redirect()->back();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        //redirect
        session()->flash('type', 'success');
        session()->flash('message', 'Category deleted');

        return redirect()->route('categories.index');
    }

}
