@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Добавить транзакцию</h1>

        <form action="{{ route('transactions.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Тип операции</label>
                <select name="type" id="type" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        onchange="this.form.submit()">
                    <option value="">-- Выберите тип --</option>
                    <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Доход</option>
                    <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Расход</option>
                </select>
                @error('type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Категория</label>
                <select name="category_id" id="category_id" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Выберите категорию --</option>
                    @if(old('type'))
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('category_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Сумма (₽)</label>
                <input type="number" step="0.01" name="amount" id="amount" required
                       value="{{ old('amount') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="0.00">
                @error('amount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Дата</label>
                <input type="date" name="date" id="date" required
                       value="{{ old('date', now()->format('Y-m-d')) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Описание</label>
                <textarea name="description" id="description" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          placeholder="Необязательное описание">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Добавить
                </button>
                <a href="{{ route('transactions.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Отмена
                </a>
            </div>
        </form>
    </div>
@endsection
