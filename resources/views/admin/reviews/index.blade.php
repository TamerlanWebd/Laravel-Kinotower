@extends('admin.layouts.app')

@section('title', 'Отзывы к фильмам')

@section('content')
<div class="neo-card p-6">
    <h3 class="text-xl font-black mb-6">Модерация отзывов</h3>

    <div class="bg-blue-50 border-3 border-black rounded-xl p-4 mb-6">
        <form method="GET" action="{{ route('reviews.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label for="film_id" class="block font-bold mb-1">Фильтр по фильму</label>
                <select name="film_id" id="film_id" class="neo-input bg-white" onchange="this.form.submit()">
                    <option value="">Все отзывы</option>
                    @foreach($films as $film)
                        <option value="{{ $film->id }}" @selected($filmId == $film->id)>
                            {{ $film->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('reviews.index') }}" class="neo-btn bg-white hover:bg-gray-100">Сбросить</a>
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
                    <th>Автор</th>
                    <th>Текст отзыва</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th class="text-center w-40">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration + ($reviews->currentPage() - 1) * $reviews->perPage() }}</td>
                        <td class="font-bold text-[var(--color-neo-primary)]">{{ $review->film->name }}</td>
                        <td class="font-bold">
                            @if($review->user)
                                {{ $review->user->fio }}
                            @else
                                <span class="text-gray-400 italic">Пользователь удален</span>
                            @endif
                        </td>
                        <td>
                            <div class="bg-gray-50 border-2 border-black rounded p-2 italic text-sm max-w-xs truncate">
                                "{{ $review->message }}"
                            </div>
                        </td>
                        <td>
                            @if($review->is_approved)
                                <span class="bg-green-200 border-2 border-black px-2 py-1 rounded text-xs font-bold">Опубликован</span>
                            @else
                                <span class="bg-yellow-200 border-2 border-black px-2 py-1 rounded text-xs font-bold">Ждет проверки</span>
                            @endif
                        </td>
                        <td>{{ $review->created_at->format('d.m.Y') }}</td>
                        <td class="text-center space-x-1">
                            @if(!$review->is_approved)
                                <form action="{{ route('reviews.approve', $review->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="neo-btn-success px-2 py-1 text-sm" title="Одобрить">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="neo-btn bg-[var(--color-neo-secondary)] text-white px-2 py-1 text-sm" onclick="return confirm('Удалить отзыв?')" title="Удалить">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center font-bold py-4">Отзывов не найдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $reviews->links() }}
    </div>
</div>
@endsection