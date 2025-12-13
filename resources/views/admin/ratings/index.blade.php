@extends('admin.layouts.app')

@section('title', 'Оценки фильмов')

@section('content')
<div class="neo-card p-6">
    <h3 class="text-xl font-black mb-6">Рейтинг пользователей</h3>

    <div class="bg-yellow-50 border-3 border-black rounded-xl p-4 mb-6">
        <form method="GET" action="{{ route('ratings.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label for="film_id" class="block font-bold mb-1">Фильтр по фильму</label>
                <select name="film_id" id="film_id" class="neo-input bg-white" onchange="this.form.submit()">
                    <option value="">Показать все оценки</option>
                    @foreach($films as $film)
                        <option value="{{ $film->id }}" @selected($filmId == $film->id)>
                            {{ $film->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('ratings.index') }}" class="neo-btn bg-white hover:bg-gray-100">Сбросить</a>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-3 border-black p-4 rounded-lg font-bold mb-6">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="neo-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Фильм</th>
                    <th>Пользователь</th>
                    <th class="text-center">Балл</th>
                    <th>Дата</th>
                    <th class="text-center">Управление</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ratings as $rating)
                    <tr>
                        <td>{{ $loop->iteration + ($ratings->currentPage() - 1) * $ratings->perPage() }}</td>
                        <td class="font-bold">{{ $rating->film->name }}</td>
                        <td>
                            @if($rating->user)
                                <div class="font-bold">{{ $rating->user->fio }}</div>
                                <div class="text-sm text-gray-600">{{ $rating->user->email }}</div>
                            @else
                                <div class="text-gray-400 italic">Пользователь удален</div>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="w-10 h-10 bg-[var(--color-neo-primary)] border-2 border-black rounded-full flex items-center justify-center font-black mx-auto">
                                {{ $rating->ball }}
                            </div>
                        </td>
                        <td>{{ $rating->created_at->format('d.m.Y H:i') }}</td>
                        <td class="text-center">
                            <form action="{{ route('ratings.destroy', $rating->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="neo-btn bg-[var(--color-neo-secondary)] text-white px-3 py-1 text-sm" onclick="return confirm('Удалить оценку?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center font-bold py-4">Оценок пока нет</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $ratings->links() }}
    </div>
</div>
@endsection