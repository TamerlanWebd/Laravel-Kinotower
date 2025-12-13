@extends('admin.layouts.app')

@section('title', 'Список жанров')

@section('content')
<div class="neo-card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-black">Все жанры</h3>
        <a href="{{ route('categories.create') }}" class="neo-btn-primary flex items-center gap-2">
            <i class="fas fa-plus"></i> Добавить
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="neo-table">
            <thead>
                <tr>
                    <th class="w-16">#</th>
                    <th>Название</th>
                    <th>Родитель</th>
                    <th class="text-center w-48">Управление</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-lg">{{ $category->name }}</td>
                        <td>
                            @if($category->parent)
                                <span class="bg-[var(--color-neo-accent)] border-2 border-black px-2 py-1 rounded font-bold text-sm">
                                    {{ $category->parent->name }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="text-center space-x-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="neo-btn bg-[var(--color-neo-yellow)] px-3 py-1 text-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form class="d-inline" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="neo-btn bg-[var(--color-neo-secondary)] text-white px-3 py-1 text-sm" onclick="return confirm('Удалить жанр?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>   
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection