@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <div class="animate-fade-in">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Создание категории
                </h1>
                <p class="text-gray-600 mt-2">Добавьте новую категорию для транзакций</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Название категории
                                *</label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                   placeholder="Например: Зарплата, Продукты, Транспорт"
                                   required>
                            @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Тип категории *</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="type" value="income" class="sr-only peer"
                                           {{ old('type', 'expense') === 'income' ? 'checked' : '' }} required>
                                    <div
                                        class="w-full p-4 border border-gray-300 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:ring-2 peer-checked:ring-green-200 transition-all duration-200">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-green-600 text-lg">↑</span>
                                            <span class="font-medium">Доход</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="type" value="expense" class="sr-only peer"
                                           {{ old('type', 'expense') === 'expense' ? 'checked' : '' }} required>
                                    <div
                                        class="w-full p-4 border border-gray-300 rounded-xl peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:ring-2 peer-checked:ring-red-200 transition-all duration-200">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-red-600 text-lg">↓</span>
                                            <span class="font-medium">Расход</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('categories.index') }}"
                           class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors duration-200">
                            Отмена
                        </a>
                        <button type="submit"
                                class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2.5 px-5 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg">
                            Создать категорию
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
