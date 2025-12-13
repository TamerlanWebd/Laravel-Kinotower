<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $showTrashed = $request->boolean('trashed');
        
        if ($showTrashed) {
            $users = User::onlyTrashed()
                ->with('gender')
                ->orderBy('deleted_at', 'desc')
                ->paginate(15)
                ->withQueryString();
        } else {
            $users = User::with('gender')
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString();
        }

        return view('admin.users.index', compact('users', 'showTrashed'));
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Пользователь успешно удален');
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index', ['trashed' => 1])
            ->with('success', 'Пользователь успешно восстановлен');
    }
}

