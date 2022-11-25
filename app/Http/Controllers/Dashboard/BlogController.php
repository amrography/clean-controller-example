<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index', [
            'blogs' => Blog::all(['id', 'title', 'image']),
        ]);
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Blog::class);

        $data = $request->all();
        $validator = Validator::make($data, [
            'slug' => 'required|string|unique:blogs',
            'title' => 'required|string',
            'image' => 'required|image',
            'body' => 'required|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // user can't have more than 5 blogs
        if ($request->user()->blogs()->count() > 5) {
            return redirect()
                ->back()
                ->with('error', 'You\'ve reached max blogs number');
        }

        $data['image'] = Storage::disk('public')
            ->putFile('blogs', $data['image']);

        $request->user()
            ->blogs()
            ->create([
                'slug' => $data['slug'],
                'title' => $data['title'],
                'body' => $data['body'],
                'image' => $data['image'],
            ]);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog created successfully');
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
        //
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
        //
    }

    public function destroy(Blog $blog)
    {
        Storage::disk('public')
            ->delete($blog->image);

        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog deleted successfully');
    }
}
