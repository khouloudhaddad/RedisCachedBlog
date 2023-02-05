<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {

        $cachedBlog = Redis::get('blog_' . $id);


        if(isset($cachedBlog)) {
            $blog = json_decode($cachedBlog, FALSE);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $blog,
            ]);
        }else {
            $blog = Blog::find($id);
            Redis::set('blog_' . $id, $blog);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $blog,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $update = Blog::findOrFail($id)->update($request->all());

        if($update) {

            // Delete blog_$id from Redis
            Redis::del('blog_' . $id);

            $blog = Blog::find($id);
            // Set a new key with the blog id
            Redis::set('blog_' . $id, $blog);

            return response()->json([
                'status_code' => 201,
                'message' => 'User updated',
                'data' => $blog,
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Blog::findOrFail($id)->delete();
        Redis::del('blog_' . $id);

        return response()->json([
            'status_code' => 201,
            'message' => 'Blog deleted'
        ]);
    }
}
