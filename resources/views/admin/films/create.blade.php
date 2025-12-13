@extends('admin.layouts.app')

@section('title', isset($film) ? 'Редактирование фильма' : 'Новый фильм')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black">{{ isset($film) ? 'Редактирование: ' . $film->name : 'Добавление фильма' }}</h1>
        <a href="{{ route('films.index') }}" class="neo-btn bg-white hover:bg-gray-100">
            &larr; Назад
        </a>
    </div>

    <form action="{{ isset($film) ? route('films.update', $film->id) : route('films.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @isset($film)
            @method('PATCH')
        @endisset

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="neo-card overflow-hidden">
                    <div class="bg-[var(--color-neo-yellow)] border-b-3 border-black p-3 font-black uppercase">
                        Основная информация
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block font-bold mb-1">Название фильма</label>
                            <input type="text" name="name" class="neo-input" placeholder="Название фильма" value="{{ old('name', $film->name ?? '') }}">
                            @error('name') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="block font-bold mb-1">Сюжет и описание</label>
                            <textarea name="description" class="neo-input h-32" placeholder="О чем фильм?">{{ old('description', $film->description ?? '') }}</textarea>
                            @error('description') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-1">Ссылка на Кинопоиск</label>
                                <input type="url" name="link_kinopoisk" class="neo-input" placeholder="https://..." value="{{ old('link_kinopoisk', $film->link_kinopoisk ?? '') }}">
                                @error('link_kinopoisk') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="block font-bold mb-1">Ссылка на трейлер</label>
                                <input type="url" name="link_video" class="neo-input" placeholder="https://..." value="{{ old('link_video', $film->link_video ?? '') }}">
                                @error('link_video') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="neo-card overflow-hidden">
                    <div class="bg-[var(--color-neo-accent)] border-b-3 border-black p-3 font-black uppercase">
                        Жанры
                    </div>
                    <div class="p-6">
                        @php
                            $selectedCategories = old('categories', isset($film) ? $film->categories->pluck('id')->toArray() : []);
                        @endphp
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($categories as $category)
                                <label class="flex items-center space-x-2 cursor-pointer p-2 border-2 border-transparent hover:bg-gray-100 rounded-lg transition-colors">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="w-5 h-5 border-3 border-black rounded text-[var(--color-neo-primary)] focus:ring-0"
                                        @checked(in_array($category->id, $selectedCategories))>
                                    <span class="font-bold">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('categories') <div class="text-[var(--color-neo-secondary)] font-bold mt-2">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="neo-card overflow-hidden">
                    <div class="bg-[var(--color-neo-primary)] border-b-3 border-black p-3 font-black uppercase">
                        Постер
                    </div>
                    <div class="p-6 text-center">
                        <div class="mb-4 border-3 border-black rounded-lg overflow-hidden bg-black">
                            <img id="poster-preview"
                                 src="{{ isset($film) && $film->link_img ? $film->link_img : 'https://via.placeholder.com/300x450?text=NO+IMAGE' }}"
                                 class="w-full max-h-[350px] object-cover opacity-90">
                        </div>
                        <input type="file" name="poster" id="poster-input" class="neo-input text-sm" accept="image/*">
                        @error('poster') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="neo-card overflow-hidden">
                    <div class="bg-gray-200 border-b-3 border-black p-3 font-black uppercase">
                        Характеристики
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block font-bold mb-1">Страна</label>
                            <select name="country_id" class="neo-input">
                                <option value="">Выберите...</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id', $film->country_id ?? '') == $country->id)>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id') <div class="text-[var(--color-neo-secondary)] font-bold mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-1">Год</label>
                                <input type="number" name="year_of_issue" class="neo-input" value="{{ old('year_of_issue', $film->year_of_issue ?? date('Y')) }}">
                            </div>
                            <div>
                                <label class="block font-bold mb-1">Возраст</label>
                                <select name="age" class="neo-input">
                                    @foreach([0, 6, 12, 16, 18] as $ageVal)
                                        <option value="{{ $ageVal }}" @selected(old('age', $film->age ?? '') == $ageVal)>{{ $ageVal }}+</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold mb-1">Длительность (мин)</label>
                            <input type="number" name="duration" class="neo-input" value="{{ old('duration', $film->duration ?? '') }}">
                        </div>

                        <hr class="border-t-2 border-dashed border-black my-4">

                        <button type="submit" class="neo-btn-primary w-full text-lg py-3">
                            <i class="fas fa-save mr-2"></i> {{ isset($film) ? 'Сохранить' : 'Создать' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('poster-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('poster-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection