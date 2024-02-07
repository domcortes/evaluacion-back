<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use ErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all();
        $totalCount = $posts->count();
        $response = response()->json($posts);
        $finalResponse = SystemController::addHeadersAPI($response, $totalCount);
        return $finalResponse;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $post = new Posts();
        $post->user_id = $request->userId;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Posts::where('id', $id)->first();
        $post->delete();
        return response()->json([], 204);
    }
}
