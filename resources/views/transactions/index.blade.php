@extends('layouts.app') //Наследование основного layout (базовая структура страницы, макет) из breeze
@section('content')
    //Добавление содержимого в секцию content
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Мои транзакции</h1>
            <a href="{{ route('transactions.create') }} "
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Новая транзакция
            </a>
        </div>

        @if($transactions->count() > 0)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Дата
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Категория
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Описание
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Сумма
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Действия
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $transaction->date->format('d.m.Y') }} {{-- Исправлено --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 text-xs rounded-full
                {{ $transaction->category->type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $transaction->category->name }} {{-- Исправлено --}}
            </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->description ?? '—' }} {{-- Исправлено --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap
            {{ $transaction->type === 'income' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ $transaction->type === 'income' ? '+' : '-' }}
                                {{ number_format($transaction->amount, 2) }} ₽
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('transactions.edit', $transaction) }}" {{-- Исправлено --}}
                                class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Редакт.
                                </a>
                                <form action="{{ route('transactions.destroy', $transaction) }}" {{-- Исправлено --}}
                                method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Удалить транзакцию?')">
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>

        @else
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <p class="text-gray-500 mb-4">У вас пока нет транзакций</p>
                <a href="{{ route('transactions.create') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Создать первую транзакцию
                </a>
            </div>
        @endif
    </div>
@endsection
