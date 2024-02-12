<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use ErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comments::where('posts_id', $request->posts_id)->get();
        $totalCount = $comments->count();
        $response = response()->json($comments);
        $finalResponse = SystemController::addHeadersAPI($response, $totalCount);
        return $finalResponse;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $comment = new Comments();
            $comment->post_id = 123467;
            $comment->comment = $request->comment;
            $comment->visible = true;
            $comment->reported = false;
            $comment->save();

            return response()->json($comment, 200);
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
            $comment = Comments::where('id', $id)->first();
            return response()->json($comment, 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (ErrorException $th) {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $comment = Comments::where('id', $id)->first();
            $comment->delete();
            return response()->json($comment, 204);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        }
    }
}
