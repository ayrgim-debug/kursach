<?php

namespace App\Http\Controllers;

use App\Http\Requests\DreamRequest;
use App\Services\StatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request; // ДОБАВЛЕНО
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index(): View
    {
        $user = auth()->user();
        $stats = $this->statisticsService->getUserStatistics($user);

        return view('dashboard.profile', compact('stats'));
    }

    // НОВЫЙ МЕТОД ДЛЯ ОБНОВЛЕНИЯ ПРОФИЛЯ
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // до 2 МБ
        ]);

        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            // Удаляем старую аватарку, если она есть
            if ($user->avatar && file_exists(public_path('uploads/avatars/' . $user->avatar))) {
                unlink(public_path('uploads/avatars/' . $user->avatar));
            }

            // Сохраняем новую
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/avatars'), $filename);
            
            $user->avatar = $filename;
        }

        $user->save();

        return back()->with('success', 'Профиль успешно обновлен! 🎉');
    }

    public function updateDream(DreamRequest $request): JsonResponse
    {
        $user = auth()->user();

        $user->update([
            'dream_name' => $request->dream_name,
            'dream_price' => $request->dream_price,
        ]);

        $this->statisticsService->checkAchievements($user);

        return response()->json([
            'success' => true,
            'dream_name' => $user->dream_name,
            'dream_price' => $user->dream_price,
            'has_dream' => $user->hasDream(),
        ]);
    }

    public function getDream(): JsonResponse
    {
        $user = auth()->user();
        $totalSavings = $user->histories()->sum('total');
        $progress = 0;

        if ($user->hasDream() && $user->dream_price > 0) {
            $progress = min(($totalSavings / $user->dream_price) * 100, 100);
        }

        return response()->json([
            'dream_name' => $user->dream_name,
            'dream_price' => $user->dream_price,
            'total_savings' => $totalSavings,
            'progress' => round($progress, 1),
            'has_dream' => $user->hasDream(),
        ]);
    }
}