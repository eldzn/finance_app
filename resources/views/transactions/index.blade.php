@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="animate-fade-in">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        📊 Мои транзакции
                    </h1>
                    <p class="text-gray-600 mt-2">Управляйте вашими доходами и расходами</p>
                </div>
                <a href="{{ route('transactions.create') }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center gap-2">
                    <span class="text-lg">+</span>
                    Новая транзакция
                </a>
            </div>

            @if($transactions->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Общий доход</p>
                                <p class="text-2xl font-bold text-green-600">
                                    +{{ number_format($transactions->where('type', 'income')->sum('amount'), 2) }} ₽
                                </p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <span class="text-green-600 text-xl">↑</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Общий расход</p>
                                <p class="text-2xl font-bold text-red-600">
                                    -{{ number_format($transactions->where('type', 'expense')->sum('amount'), 2) }} ₽
                                </p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <span class="text-red-600 text-xl">↓</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Баланс</p>
                                <p class="text-2xl font-bold text-blue-600">
                                    {{ number_format($transactions->where('type', 'income')->sum('amount') - $transactions->where('type', 'expense')->sum('amount'), 2) }} ₽
                                </p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <span class="text-blue-600 text-xl">💰</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50/80 backdrop-blur-sm">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Дата
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Категория
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Описание
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Сумма
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200/50">
                            @foreach($transactions as $transaction)
                                <tr class="hover:bg-gray-50/50 transition-all duration-200 group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                                            <span class="text-sm font-medium text-gray-900">
                                            {{ $transaction->date }}
                                        </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $transaction->category->type === 'income' ?
                                           'bg-green-100 text-green-800 ring-1 ring-green-600/20' :
                                           'bg-red-100 text-red-800 ring-1 ring-red-600/20' }}">
                                        {{ $transaction->category->name }}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <p class="text-sm text-gray-600 truncate group-hover:text-gray-900 transition-colors">
                                            {{ $transaction->description ?? '—' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center text-sm font-semibold
                                        {{ $transaction->type === 'income' ?
                                           'text-green-600 bg-green-50 px-2 py-1 rounded-lg' :
                                           'text-red-600 bg-red-50 px-2 py-1 rounded-lg' }}">
                                        {{ $transaction->type === 'income' ? '↑ +' : '↓ -' }}
                                        {{ number_format($transaction->amount, 2) }} ₽
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('transactions.edit', $transaction) }}"
                                               class="text-blue-600 hover:text-blue-800 transition-colors duration-200 p-2 rounded-lg hover:bg-blue-50"
                                               title="Редактировать">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 transition-colors duration-200 p-2 rounded-lg hover:bg-red-50"
                                                        title="Удалить"
                                                        onclick="return confirm('Удалить транзакцию?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8">
                    {{ $transactions->links() }}
                </div>

            @else
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center max-w-2xl mx-auto">
                    <div class="text-gray-300 mb-6">
                        <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Транзакций пока нет</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Начните отслеживать ваши финансы, добавив первую транзакцию
                    </p>
                    <a href="{{ route('transactions.create') }}"
                       class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl inline-flex items-center gap-2">
                        <span>➕</span>
                        Создать первую транзакцию
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
