@extends('admin.layouts.app')

@section('title', 'Список фильмов')

@section('content')
<div class="neo-card p-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <a href="{{ route('films.create') }}" class="neo-btn-success flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Добавить фильм
        </a>
        
        <form class="flex flex-wrap gap-2 items-center" method="GET" action="{{ route('films.index') }}">
            <select name="country_id" class="neo-input w-auto">
                <option value="">Все страны</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" @selected(request('country_id') == $country->id)>{{ $country->name }}</option>
                @endforeach
            </select>
            
            <select name="category_id" class="neo-input w-auto">
                <option value="">Все жанры</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="neo-btn-primary">Фильтр</button>
            <a href="{{ route('films.index') }}" class="neo-btn bg-white hover:bg-gray-100">Сброс</a>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($films as $film)
            <div class="neo-card flex flex-col h-full overflow-hidden hover:-translate-y-2 transition-transform duration-300">
                <div class="h-64 bg-black border-b-3 border-black relative">
                    @if($film->link_img)
                        <img src="{{ $film->link_img }}" alt="{{ $film->name }}" class="w-full h-full object-cover opacity-90">
                    @else
                        <div class="flex items-center justify-center h-full text-white font-black">НЕТ ПОСТЕРА</div>
                    @endif
                    <div class="absolute top-2 right-2 bg-[var(--color-neo-secondary)] border-3 border-black px-3 py-1.5 font-black text-sm rounded shadow-[3px_3px_0_#000] text-black z-10">
                        {{ $film->age }}+
                    </div>
                </div>
                
                <div class="p-4 flex-1 flex flex-col">
                    <h5 class="text-xl font-black mb-1 leading-tight">{{ $film->name }}</h5>
                    <div class="text-sm font-bold text-gray-600 mb-2">
                        <i class="fas fa-globe mr-1"></i> {{ $film->country?->name ?? 'Не указана' }}
                    </div>
                    
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach($film->categories as $cat)
                            <span class="bg-[var(--color-neo-accent)] border-2 border-black px-2 py-0.5 text-xs font-bold rounded-md">
                                {{ $cat->name }}
                            </span>
                        @endforeach
                    </div>
                    
                    <div class="mt-auto space-y-3">
                        <div class="flex justify-between text-xs font-bold bg-gray-100 p-2 border-2 border-black rounded-lg">
                            <span>{{ $film->year_of_issue }} г.</span>
                            <span>{{ $film->duration }} мин</span>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-2">
                            <a href="{{ route('films.categories.index', $film->id) }}" class="neo-btn bg-blue-300 text-center px-0 py-1 text-sm" title="Жанры">
                                <i class="fas fa-tags"></i>
                            </a>
                            <a href="{{ route('films.edit', $film->id) }}" class="neo-btn bg-[var(--color-neo-yellow)] text-center px-0 py-1 text-sm" title="Редактировать">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" onsubmit="return confirm('Удалить фильм?')" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="neo-btn bg-[var(--color-neo-secondary)] text-white w-full px-0 py-1 text-sm" title="Удалить">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-yellow-100 border-3 border-black p-4 rounded-xl text-center font-bold text-xl">
                    Фильмы не найдены
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $films->links() }}
    </div>
</div>
@endsection