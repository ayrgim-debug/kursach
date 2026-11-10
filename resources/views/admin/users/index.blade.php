@extends('layouts.app')

@section('title', 'Пользователи')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
@endpush

@section('content')
    <div class="hero">
        <h2>👥 Пользователи</h2>
        <p>Управление аккаунтами: просмотр и блокировка.</p>
    </div>

    @include('admin._nav')

    @if(session('success'))
        <div class="sp-alert" style="background: var(--green-light); color: var(--green-dark); border-color: rgba(47, 82, 51, 0.4);">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="sp-alert">
            {{ session('error') }}
        </div>
    @endif

    <form class="ad-filters" method="GET" action="{{ route('admin.users.index') }}">
        <input type="text" name="q" value="{{ $search }}" placeholder="Поиск: имя или email">
        <button type="submit" class="sp-btn">🔍 Найти</button>
        @if($search !== '')
            <a href="{{ route('admin.users.index') }}" class="sp-btn sp-btn-secondary">Сбросить</a>
        @endif
    </form>

    <div class="ad-table-wrap">
        <table class="ad-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Дата регистрации</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->created_at->format('d.m.Y') }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div class="avatar" style="width: 24px; height: 24px; font-size: 12px; background: var(--gradient-main); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    {{ $user->name[0] ?? '?' }}
                                </div>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->isAdmin())
                                <span class="st-badge st-new">Админ</span>
                            @else
                                <span class="st-badge st-closed">Пользователь</span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_banned)
                                <span class="st-badge st-in_progress" style="background: var(--red-light); color: var(--red); border-color: rgba(179, 59, 44, 0.4);">Забанен</span>
                            @else
                                <span class="st-badge st-resolved">Активен</span>
                            @endif
                        </td>
                        <td class="ad-actions">
                            @if(!$user->isAdmin())
                                <form method="POST" action="{{ route('admin.users.ban', $user) }}">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->is_banned)
                                        <button type="submit" class="sp-btn sp-btn-small sp-btn-secondary">✅ Разбанить</button>
                                    @else
                                        <button type="submit" class="sp-btn sp-btn-small sp-btn-danger" onclick="return confirm('Забанить пользователя {{ $user->name }}?')">🚫 Забанить</button>
                                    @endif
                                </form>
                            @else
                                <span class="sp-meta">Недоступно</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty-habits">🐷 Пользователи не найдены.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
@endsection