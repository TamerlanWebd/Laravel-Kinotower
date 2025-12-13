@extends('admin.layouts.app')

@section('title', $showTrashed ? 'Корзина пользователей' : 'Список пользователей')

@section('content')
<div class="neo-card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-black">{{ $showTrashed ? 'Удаленные' : 'Активные' }} пользователи</h3>
        <div class="space-x-2">
            <a href="{{ route('users.index') }}" class="neo-btn {{ !$showTrashed ? 'bg-[var(--color-neo-primary)]' : 'bg-white' }} text-sm">
                Активные
            </a>
            <a href="{{ route('users.index', ['trashed' => 1]) }}" class="neo-btn {{ $showTrashed ? 'bg-[var(--color-neo-secondary)] text-white' : 'bg-white' }} text-sm">
                Удаленные
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-3 border-black p-4 rounded-lg font-bold mb-6">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="neo-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>ДР</th>
                    <th>Пол</th>
                    <th>Дата {{ $showTrashed ? 'удаления' : 'регистрации' }}</th>
                    <th class="text-center">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td class="font-bold">{{ $user->fio }}</td>
                        <td class="underline decoration-2 decoration-[var(--color-neo-primary)]">{{ $user->email }}</td>
                        <td>{{ $user->birthday ? $user->birthday->format('d.m.Y') : '-' }}</td>
                        <td>
                            @if($user->gender)
                                <span class="bg-blue-100 border-2 border-black px-2 py-0.5 rounded text-xs font-bold">{{ $user->gender->name }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($showTrashed)
                                {{ $user->deleted_at ? $user->deleted_at->format('d.m.Y H:i') : '-' }}
                            @else
                                {{ $user->created_at->format('d.m.Y') }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($showTrashed)
                                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="neo-btn-success px-3 py-1 text-sm" title="Восстановить">
                                        <i class="fas fa-trash-restore"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="neo-btn bg-[var(--color-neo-secondary)] text-white px-3 py-1 text-sm" onclick="return confirm('Удалить пользователя?')" title="Удалить">
                                        <i class="fas fa-user-times"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center font-bold py-4">
                            {{ $showTrashed ? 'Корзина пуста' : 'Пользователей нет' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection