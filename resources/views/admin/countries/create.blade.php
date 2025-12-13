@extends('admin.layouts.app')

@section('title', isset($country) ? 'Редактировать страну' : 'Создать страну')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="neo-card p-8">
        <form action=" {{ isset($country) ? route('countries.update', $country->id) : route('countries.store') }}" method="POST" class="space-y-6">
            @csrf
            @isset($country)
                @method('PATCH')
            @endisset
            <div>
                <label for="name" class="block font-black text-lg mb-2">Название страны</label>
                <input type="text" name="name" id="name" class="neo-input"
                value="{{ isset($country) ? old('name', $country->name) : old('name') }}" required placeholder="Например: Франция">

                @error('name')
                    <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('countries.index') }}" class="neo-btn bg-white hover:bg-gray-100">Назад</a>
                <button type="submit" class="neo-btn-success">Сохранить</button>
            </div>
        </form>
    </div>
</div>
@endsection