<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Port;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */
    public function users()
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function updateUserRole(Request $request, $id)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User role updated successfully',
            'data' => $user
        ]);
    }

    public function deleteUser($id)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->id === Auth::id()) {
            return response()->json(['message' => 'Cannot delete currently logged in account'], 400);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Port Management
    |--------------------------------------------------------------------------
    */
    public function storePort(Request $request)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $validated = $request->validate([
            'name' => 'required|string',
            'country' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $port = Port::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Port created successfully',
            'data' => $port
        ]);
    }

    public function updatePort(Request $request, $id)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $port = Port::find($id);
        if (!$port) {
            return response()->json(['message' => 'Port not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'country' => 'sometimes|string',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
        ]);

        $port->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Port updated successfully',
            'data' => $port
        ]);
    }

    public function deletePort($id)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $port = Port::find($id);
        if (!$port) {
            return response()->json(['message' => 'Port not found'], 404);
        }

        $port->delete();

        return response()->json([
            'success' => true,
            'message' => 'Port deleted successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Article Management
    |--------------------------------------------------------------------------
    */
    public function articles()
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $articles = Article::with('user')->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    public function storeArticle(Request $request)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id() ?? 1;

        $article = Article::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Article created successfully',
            'data' => $article
        ]);
    }

    public function updateArticle(Request $request, $id)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string',
            'content' => 'sometimes|string',
        ]);

        $article->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => $article
        ]);
    }

    public function deleteArticle($id)
    {
        if (!$this->checkAdmin()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized. Admin role required.'], 403);
        }
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully'
        ]);
    }
}
