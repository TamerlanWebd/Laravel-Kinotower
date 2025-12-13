@extends('admin.layouts.app')

@section('title', isset($category) ? 'Редактировать жанр' : 'Новый жанр')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="neo-card p-8">
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" class="space-y-6">
            @csrf
            @isset($category)
                @method('PATCH')
            @endisset
            
            <div>
                <label class="block font-black text-lg mb-2" for="name">Название жанра</label>
                <input class="neo-input" name="name" id="name" type="text" placeholder="Например: Комедия"
                       value="{{ isset($category) ? old('name', $category->name) : old('name') }}">
                @error('name') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-black text-lg mb-2" for="parent_id">Родительский жанр</label>
                <select name="parent_id" id="parent_id" class="neo-input">
                    <option value="">Без родителя</option>
                    @foreach($categories as $itemCategory)
                        @unless(isset($category) && $category->id === $itemCategory->id)
                            <option @selected(isset($category) && $category->parent_id === $itemCategory->id) value="{{ $itemCategory->id }}">
                                {{ $itemCategory->name }}
                            </option>
                        @endunless
                    @endforeach
                </select>
                @error('parent_id') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('categories.index') }}" class="neo-btn bg-white hover:bg-gray-100">Отмена</a>
                <button class="neo-btn-success" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</div>
@endsection