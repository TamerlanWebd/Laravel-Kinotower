<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход в админ панель</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-neo-primary: #4ECDC4;
            --color-neo-secondary: #FFE66D;
            --color-neo-dark: #2C3E50;
            --shadow-hard: 4px 4px 0 #000;
        }
        .neo-body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .neo-card {
            background: white;
            border: 4px solid black;
            border-radius: 8px;
            box-shadow: var(--shadow-hard);
        }
        .neo-input {
            width: 100%;
            padding: 12px;
            border: 3px solid black;
            border-radius: 4px;
            font-weight: bold;
            background: white;
        }
        .neo-btn-primary {
            background: var(--color-neo-primary);
            color: black;
            border: 3px solid black;
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: var(--shadow-hard);
            transition: all 0.2s;
        }
        .neo-btn-primary:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 #000;
        }
    </style>
</head>
<body class="neo-body flex items-center justify-center">

<div class="w-full max-w-md p-4">
    <div class="text-center mb-6">
        <h1 class="text-5xl font-black text-black drop-shadow-[3px_3px_0_#fff]">KinoTower</h1>
        <span class="bg-black text-white px-2 py-1 text-sm font-bold uppercase">Admin Panel</span>
    </div>

    <div class="neo-card p-8">
        <p class="text-xl font-bold mb-6 text-center">Войдите в систему</p>

        @if ($errors->any())
            <div class="bg-[var(--color-neo-secondary)] text-white border-3 border-black p-3 rounded-lg mb-4 font-bold shadow-[var(--shadow-hard)]">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-black"></i>
                </div>
                <input type="email" name="email" class="neo-input pl-10" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-black"></i>
                </div>
                <input type="password" name="password" class="neo-input pl-10" placeholder="Пароль" required>
            </div>

            <button type="submit" class="neo-btn-primary w-full text-lg">
                Поехали!
            </button>
        </form>
    </div>
</div>

</body>
</html>