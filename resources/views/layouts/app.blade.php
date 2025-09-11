<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
<div class="min-h-screen">
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="animate-fade-in">
        @yield('content')
    </main>
</div>

<script>
    // Динамическая загрузка категорий при изменении типа
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const categorySelect = document.getElementById('category_id');

        if (typeSelect && categorySelect) {
            typeSelect.addEventListener('change', function() {
                const type = this.value;
                if (type) {
                    fetch(`/categories/by-type/${type}`)
                        .then(response => response.json())
                        .then(categories => {
                            categorySelect.innerHTML = '<option value="">-- Выберите категорию --</option>';
                            categories.forEach(category => {
                                categorySelect.innerHTML += `<option value="${category.id}">${category.name}</option>`;
                            });
                        });
                } else {
                    categorySelect.innerHTML = '<option value="">-- Выберите категорию --</option>';
                }
            });
        }
    });
</script>
</body>
</html>
