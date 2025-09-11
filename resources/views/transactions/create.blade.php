@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="animate-fade-in">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    🎯 Добавить транзакцию
                </h1>
                <p class="text-gray-600 mt-2">Заполните информацию о новой транзакции</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Type Field -->
                    <div class="space-y-2">
                        <label for="type" class="block text-sm font-semibold text-gray-700">
                            💰 Тип операции *
                        </label>
                        <select name="type" id="type" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200
                                   bg-gray-50 hover:bg-white focus:bg-white">
                            <option value="">-- Выберите тип --</option>
                            <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>📈 Доход</option>
                            <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>📉 Расход</option>
                        </select>
                        @error('type')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Category Field -->
                    <div class="space-y-2">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700">
                            🏷️ Категория *
                        </label>
                        <select name="category_id" id="category_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200
                                   bg-gray-50 hover:bg-white focus:bg-white">
                            <option value="">-- Выберите категорию --</option>
                            @if(old('type'))
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Amount Field -->
                    <div class="space-y-2">
                        <label for="amount" class="block text-sm font-semibold text-gray-700">
                            💵 Сумма (₽) *
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">₽</span>
                            <input type="number" step="0.01" name="amount" id="amount" required value="{{ old('amount') }}"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200
                                      bg-gray-50 hover:bg-white focus:bg-white"
                                   placeholder="0.00">
                        </div>
                        @error('amount')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Date Field -->
                    <div class="space-y-2">
                        <label for="date" class="block text-sm font-semibold text-gray-700">
                            📅 Дата *
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">📆</span>
                            <input type="date" name="date" id="date" required value="{{ old('date', now()->format('Y-m-d')) }}"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200
                                      bg-gray-50 hover:bg-white focus:bg-white">
                        </div>
                        @error('date')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700">
                            📝 Описание
                        </label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200
                                     bg-gray-50 hover:bg-white focus:bg-white resize-none"
                                  placeholder="Необязательное описание транзакции">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between pt-4">
                        <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200
                                   transform hover:scale-105 shadow-md hover:shadow-lg flex items-center gap-2">
                            <span>➕</span> Добавить транзакцию
                        </button>
                        <a href="{{ route('transactions.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200
                              transform hover:scale-105 flex items-center gap-2">
                            <span>↩️</span> Отмена
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
