<?php

namespace App\Http\Controllers;

use App\Models\User;
use ErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();
        $totalCount = $users->count();
        $response = response()->json($users);
        $finalResponse = SystemController::addHeadersAPI($response, $totalCount);
        return $finalResponse;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return response()->json($user);
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
            $user = User::where('id', $id)->first();
            return response()->json($user, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::where('id', $id)->first();
            $user->delete();
            return response()->json([], 204);
        } catch (ErrorException $th) {
            return response()->json($th->getMessage(), 200);
        } catch (QueryException $th) {
            return response()->json($th->getMessage(), 200);
        }
    }
}
