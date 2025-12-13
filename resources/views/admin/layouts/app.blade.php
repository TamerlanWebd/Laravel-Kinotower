<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KinoTower - Админ панель</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-neo-primary: #4ECDC4;
            --color-neo-secondary: #FFE66D;
            --color-neo-dark: #2C3E50;
            --shadow-hard: 4px 4px 0 #000;
        }
        .neo-btn-danger {
            background: #ff6b6b;
            color: white;
            border: 3px solid black;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: var(--shadow-hard);
            transition: all 0.2s;
        }
        .neo-btn-danger:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 #000;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin: 20px 0;
        }
        .pagination > li {
            list-style: none;
        }
        .pagination > li > a,
        .pagination > li > span {
            display: inline-block;
            padding: 8px 12px;
            border: 2px solid black;
            background: white;
            color: var(--color-neo-dark);
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            box-shadow: 2px 2px 0 #000;
            transition: all 0.2s;
        }
        .pagination > li > a:hover {
            background: var(--color-neo-primary);
            transform: translate(1px, 1px);
            box-shadow: 1px 1px 0 #000;
        }
        .pagination > .active > span,
        .pagination > .active > a {
            background: var(--color-neo-primary);
            color: black;
            border-color: black;
            box-shadow: 2px 2px 0 #000;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > a {
            background: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
            opacity: 0.6;
        }
        .pagination > .disabled > span:hover,
        .pagination > .disabled > a:hover {
            transform: none;
            box-shadow: 2px 2px 0 #000;
        }
        
        select.neo-input,
        .neo-input {
            width: 100%;
            padding: 10px 12px;
            border: 3px solid black;
            border-radius: 4px;
            background: white;
            color: var(--color-neo-dark);
            font-weight: bold;
            font-size: 14px;
            box-shadow: 2px 2px 0 #000;
            transition: all 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23000' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            padding-right: 36px;
            cursor: pointer;
        }
        select.neo-input:hover,
        .neo-input:hover {
            background-color: #f9fafb;
            transform: translate(1px, 1px);
            box-shadow: 1px 1px 0 #000;
        }
        select.neo-input:focus,
        .neo-input:focus {
            outline: none;
            background-color: var(--color-neo-primary);
            transform: translate(1px, 1px);
            box-shadow: 1px 1px 0 #000;
        }
        select.neo-input option {
            padding: 8px;
            font-weight: bold;
        }
        
        .neo-btn,
        .neo-btn-primary,
        .neo-btn-success,
        button.neo-btn,
        a.neo-btn {
            display: inline-block;
            padding: 10px 20px;
            border: 3px solid black;
            border-radius: 4px;
            background: white;
            color: var(--color-neo-dark);
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 3px 3px 0 #000;
            transition: all 0.2s;
            text-align: center;
        }
        .neo-btn-primary {
            background: var(--color-neo-primary);
            color: black;
        }
        .neo-btn-success {
            background: #4ade80;
            color: black;
        }
        .neo-btn:hover,
        .neo-btn-primary:hover,
        .neo-btn-success:hover,
        button.neo-btn:hover,
        a.neo-btn:hover {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0 #000;
        }
        .neo-btn:active,
        .neo-btn-primary:active,
        .neo-btn-success:active,
        button.neo-btn:active,
        a.neo-btn:active {
            transform: translate(3px, 3px);
            box-shadow: 0 0 0 #000;
        }
        
        .neo-btn.bg-blue-300 {
            background: #93c5fd !important;
            color: black;
        }
        .neo-btn.bg-\[var\(--color-neo-yellow\)\] {
            background: var(--color-neo-secondary) !important;
            color: black;
        }
        .neo-btn.bg-\[var\(--color-neo-secondary\)\] {
            background: var(--color-neo-secondary) !important;
            color: black;
        }
        .neo-btn.bg-white {
            background: white !important;
            color: var(--color-neo-dark);
        }
        .neo-btn.bg-white:hover {
            background: #f3f4f6 !important;
        }
        
        .neo-card {
            background: white;
            border: 4px solid black;
            border-radius: 8px;
            box-shadow: var(--shadow-hard);
            padding: 24px;
        }
        
        .neo-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 3px solid black;
            border-radius: 8px;
            overflow: hidden;
        }
        .neo-table thead {
            background: var(--color-neo-dark);
            color: white;
        }
        .neo-table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border-bottom: 3px solid black;
        }
        .neo-table td {
            padding: 12px;
            border-bottom: 2px solid #e5e7eb;
        }
        .neo-table tbody tr:last-child td {
            border-bottom: none;
        }
        .neo-table tbody tr:hover {
            background: #f9fafb;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin-films.css') }}">
</head>
<body class="bg-[#f4f6f9] font-sans text-[var(--color-neo-dark)]">

<div class="min-h-screen flex flex-col md:flex-row">
    
    <aside class="w-full md:w-64 bg-[var(--color-neo-dark)] text-white border-r-4 border-black flex-shrink-0">
        <div class="h-16 flex items-center justify-center bg-[var(--color-neo-secondary)] border-b-4 border-black">
            <a href="{{ route('admin.index') }}" class="text-2xl font-black uppercase tracking-wider text-white drop-shadow-md">
                KinoTower
            </a>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-3 rounded-lg border-2 border-transparent hover:bg-[var(--color-neo-primary)] hover:text-black hover:border-white hover:shadow-[3px_3px_0_#fff] transition-all font-bold">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span>Главная</span>
            </a>
            <a href="{{ route('films.index') }}" class="flex items-center px-4 py-3 rounded-lg border-2 border-transparent hover:bg-[var(--color-neo-primary)] hover:text-black hover:border-white hover:shadow-[3px_3px_0_#fff] transition-all font-bold">
                <i class="fas fa-film w-6"></i>
                <span>Фильмы</span>
            </a>
            <a href="{{ route('countries.index') }}" class="flex items-center px-4 py-3 rounded-lg border-2 border-transparent hover:bg-[var(--color-neo-primary)] hover:text-black hover:border-white hover:shadow-[3px_3px_0_#fff] transition-all font-bold">
                <i class="fas fa-globe w-6"></i>
                <span>Страны</span>
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 rounded-lg border-2 border-transparent hover:bg-[var(--color-neo-primary)] hover:text-black hover:border-white hover:shadow-[3px_3px_0_#fff] transition-all font-bold">
                <i class="fas fa-list w-6"></i>
                <span>Жанры</span>
            </a>
            <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 rounded-lg border-2 border-transparent hover:bg-[var(--color-neo-primary)] hover:text-black hover:border-white hover:shadow-[3px_3px_0_#fff] transition-all font-bold">
                <i class="fas fa-users w-6"></i>
                <span>Пользователи</span>
            </a>
            <a href="{{ route('reviews.index') }}" class="flex items-center px-4 py-3 rounded-lg border-2 border-transparent hover:bg-[var(--color-neo-primary)] hover:text-black hover:border-white hover:shadow-[3px_3px_0_#fff] transition-all font-bold">
                <i class="fas fa-comments w-6"></i>
                <span>Отзывы</span>
            </a>
            <a href="{{ route('ratings.index') }}" class="flex items-center px-4 py-3 rounded-lg border-2 border-transparent hover:bg-[var(--color-neo-primary)] hover:text-black hover:border-white hover:shadow-[3px_3px_0_#fff] transition-all font-bold">
                <i class="fas fa-star w-6"></i>
                <span>Оценки</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 bg-[#fffdf0] bg-[radial-gradient(#4ECDC4_1px,transparent_1px)] [background-size:20px_20px]">
        <header class="h-16 bg-white border-b-4 border-black flex items-center justify-between px-6 shadow-sm">
            <h1 class="text-xl font-black uppercase">@yield('title', 'Панель управления')</h1>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="neo-btn-danger text-sm px-4 py-1">
                    <i class="fas fa-sign-out-alt mr-2"></i> Выход
                </button>
            </form>
        </header>

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>

        <footer class="bg-white border-t-4 border-black p-4 text-center font-bold text-sm">
            <strong>KinoTower &copy; 2025</strong> - Unusual Cartoon Style
        </footer>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>