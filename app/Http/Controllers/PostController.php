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
        try {
            $post = new Posts();
            $post->user_id = $request->userId;
            $post->category_id = $request->categoryId;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return response()->json($post, 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (QueryException $th) {
            return response()->json($th->getMessage(), 200);
        }
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
        try {
            $posts = Posts::where('id', $id)->first();
            return response()->json($posts, 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (QueryException $th) {
            return response()->json($th->getMessage(), 200);
        }
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
        try {
            $post = Posts::where('id', $id)->first();
            $post->category_id = $post->category_id;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return response()->json($post, 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (QueryException $th) {
            return response()->json($th->getMessage(), 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Posts::where('id', $id)->first();
            $post->delete();
            return response()->json($post, 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (QueryException $th) {
            return response()->json($th->getMessage(), 200);
        }
    }
}
