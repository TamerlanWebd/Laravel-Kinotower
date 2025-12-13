@extends('admin.layouts.app')

@section('title', 'Жанры фильма')

@section('content')
<div class="neo-card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-black">Жанры для: <span class="text-[var(--color-neo-primary)]">{{ $film->name }}</span></h3>
        <a href="{{ route('films.index') }}" class="neo-btn bg-white hover:bg-gray-100">Назад к фильмам</a>
    </div>

    <div class="bg-[var(--color-neo-accent)] border-3 border-black rounded-xl p-6 mb-8 shadow-[var(--shadow-hard)]">
        <h5 class="font-black text-lg mb-4">Добавить новый жанр</h5>
        <form action="{{ route('films.categories.store', $film->id) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
            @csrf
            <div class="flex-1 w-full">
                <select name="category_id" id="category_id" class="neo-input bg-white" required>
                    <option value="">-- Выберите жанр --</option>
                    @foreach($allCategories as $category)
                        @unless($film->categories->contains($category->id))
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endunless
                    @endforeach
                </select>
            </div>
            <button type="submit" class="neo-btn-success w-full md:w-auto">Прикрепить</button>
        </form>
        @error('category_id') <div class="text-[var(--color-neo-secondary)] font-bold mt-2">{{ $message }}</div> @enderror
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-3 border-black p-4 rounded-lg font-bold mb-6">{{ session('success') }}</div>
    @endif

    <h5 class="font-black text-xl mb-4">Текущие жанры</h5>
    @if($film->categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th class="w-16">#</th>
                        <th>Название жанра</th>
                        <th class="text-center w-40">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($film->categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="bg-[var(--color-neo-yellow)] border-2 border-black px-3 py-1 rounded-lg font-bold">{{ $category->name }}</span></td>
                            <td class="text-center">
                                <form action="{{ route('films.categories.destroy', [$film->id, $category->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="neo-btn bg-[var(--color-neo-secondary)] text-white px-3 py-1 text-sm" onclick="return confirm('Открепить жанр?')">
                                        <i class="fas fa-times mr-1"></i> Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-blue-100 border-3 border-black p-4 rounded-lg font-bold">У этого фильма пока нет прикрепленных жанров.</div>
    @endif
</div>
@endsection