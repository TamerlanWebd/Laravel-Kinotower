@extends('admin.layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="neo-card bg-[#4dabf7] overflow-hidden relative group">
        <div class="p-6 relative z-10">
            <h3 class="text-4xl font-black text-white drop-shadow-[2px_2px_0_#000]">{{ \App\Models\Film::count() }}</h3>
            <p class="text-lg font-bold text-white">Фильмы</p>
        </div>
        <div class="absolute right-2 top-2 text-white/20 text-6xl group-hover:scale-110 transition-transform">
            <i class="fas fa-film"></i>
        </div>
        <a href="{{ route('films.index') }}" class="block bg-black/20 text-white text-center py-2 font-bold hover:bg-black/40 transition-colors">
            Подробнее <i class="fas fa-arrow-circle-right ml-1"></i>
        </a>
    </div>

    <div class="neo-card bg-[#69db7c] overflow-hidden relative group">
        <div class="p-6 relative z-10">
            <h3 class="text-4xl font-black text-white drop-shadow-[2px_2px_0_#000]">{{ \App\Models\User::count() }}</h3>
            <p class="text-lg font-bold text-white">Пользователи</p>
        </div>
        <div class="absolute right-2 top-2 text-white/20 text-6xl group-hover:scale-110 transition-transform">
            <i class="fas fa-users"></i>
        </div>
        <a href="{{ route('users.index') }}" class="block bg-black/20 text-white text-center py-2 font-bold hover:bg-black/40 transition-colors">
            Подробнее <i class="fas fa-arrow-circle-right ml-1"></i>
        </a>
    </div>

    <div class="neo-card bg-[#ffd43b] overflow-hidden relative group">
        <div class="p-6 relative z-10">
            <h3 class="text-4xl font-black text-white drop-shadow-[2px_2px_0_#000]">{{ \App\Models\Review::count() }}</h3>
            <p class="text-lg font-bold text-white">Отзывы</p>
        </div>
        <div class="absolute right-2 top-2 text-white/20 text-6xl group-hover:scale-110 transition-transform">
            <i class="fas fa-comments"></i>
        </div>
        <a href="{{ route('reviews.index') }}" class="block bg-black/20 text-white text-center py-2 font-bold hover:bg-black/40 transition-colors">
            Подробнее <i class="fas fa-arrow-circle-right ml-1"></i>
        </a>
    </div>

    <div class="neo-card bg-[#ff8787] overflow-hidden relative group">
        <div class="p-6 relative z-10">
            <h3 class="text-4xl font-black text-white drop-shadow-[2px_2px_0_#000]">{{ \App\Models\Category::count() }}</h3>
            <p class="text-lg font-bold text-white">Категории</p>
        </div>
        <div class="absolute right-2 top-2 text-white/20 text-6xl group-hover:scale-110 transition-transform">
            <i class="fas fa-list"></i>
        </div>
        <a href="{{ route('categories.index') }}" class="block bg-black/20 text-white text-center py-2 font-bold hover:bg-black/40 transition-colors">
            Подробнее <i class="fas fa-arrow-circle-right ml-1"></i>
        </a>
    </div>
</div>

<div class="neo-card p-6">
    <h3 class="text-2xl font-black mb-4">Добро пожаловать в мультяшную админку!</h3>
    <p class="text-lg">Здесь вы можете управлять контентом сайта весело и ярко.</p>
</div>
@endsection