<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use ErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
        $totalCount = $categories->count();
        $response = response()->json($categories);
        $finalResponse = SystemController::addHeadersAPI($response, $totalCount);
        return $finalResponse;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $category = new Categories();
            $category->title = $request->title;
            $category->save();

            return response()->json($category, 200);
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
        $category = Categories::where('id', $id)->first();
        return response()->json($category, 200);
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
            $category = Categories::where('id', $id)->first();
            $category->title = $request->title;
            $category->save();

            return response()->json($category, 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::where('id', $id)->first();
        $category->delete();
        return response()->json([], 204);
    }
}
