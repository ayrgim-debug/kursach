<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    // Список всех пользователей
    public function index(Request $request): View
    {
        $query = User::latest();

        // Поиск по имени или email
        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $like = '%' . $search . '%';
            $query->where(function ($w) use ($like) {
                $w->where('name', 'like', $like)
                  ->orWhere('email', 'like', $like);
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    // Бан / Разбан пользователя
    public function toggleBan(User $user): RedirectResponse
    {
        // Защита: нельзя забанить самого себя или другого админа
        if ($user->isAdmin()) {
            return back()->with('error', 'Нельзя заблокировать администратора.');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        $status = $user->is_banned ? 'заблокирован' : 'разблокирован';
        
        return back()->with('success', "Пользователь {$user->name} успешно {$status}.");
    }
}