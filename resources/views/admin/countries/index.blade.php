@extends('admin.layouts.app')
@section('title', 'Список стран')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="neo-card p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-black">Страны производства</h3>
            <a href="{{ route('countries.create') }}" class="neo-btn-primary flex items-center gap-2">
                <i class="fas fa-plus"></i> Добавить
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="neo-table">
                <thead>
                    <tr>
                        <th class="w-16">#</th>
                        <th>Название</th>
                        <th class="text-center w-48">Управление</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td class="text-lg font-bold">{{ $country->name }}</td>
                        <td class="text-center space-x-2">
                            <a href="{{ route('countries.edit', $country->id) }}" class="neo-btn bg-[var(--color-neo-yellow)] px-3 py-1 text-sm"><i class="fas fa-pen"></i></a>
                            <form class="d-inline" action="{{ route('countries.destroy', $country->id) }}" method="POST"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="neo-btn bg-[var(--color-neo-secondary)] text-white px-3 py-1 text-sm" onclick="return confirm('Удалить страну?')"><i class="fas fa-trash"></i></button>
                            </form>   
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection