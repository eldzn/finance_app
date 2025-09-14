@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="animate-fade-in">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        📁 Мои категории
                    </h1>
                    <p class="text-gray-600 mt-2">Управляйте категориями доходов и расходов</p>
                </div>
                <a href="{{ route('categories.create') }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center gap-2">
                    <span class="text-lg">+</span>
                    Новая категория
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm"
                     role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm"
                     role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if($categories->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50/80 backdrop-blur-sm">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Название
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Тип
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Кол-во транзакций
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Действия
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200/50">
                            @foreach($categories as $category)
                                <tr class="hover:bg-gray-50/50 transition-all duration-200 group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full
                                                {{ $category->type === 'income' ? 'bg-green-400' : 'bg-red-400' }}"></div>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $category->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            {{ $category->type === 'income' ?
                                               'bg-green-100 text-green-800 ring-1 ring-green-600/20' :
                                               'bg-red-100 text-red-800 ring-1 ring-red-600/20' }}">
                                            {{ $category->type === 'income' ? 'Доход' : 'Расход' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                            {{ $category->transactions_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="flex items-center gap-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('categories.edit', $category) }}"
                                               class="text-blue-600 hover:text-blue-800 transition-colors duration-200 p-2 rounded-lg hover:bg-blue-50"
                                               title="Редактировать">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 transition-colors duration-200 p-2 rounded-lg hover:bg-red-50"
                                                        title="Удалить"
                                                        onclick="return confirm('Удалить категорию «{{ $category->name }}»?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
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

            @else
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center max-w-2xl mx-auto">
                    <div class="text-gray-300 mb-6">
                        <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M6 6h.008v.008H6V6z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Категорий пока нет</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Создайте категории для удобной сортировки ваших доходов и расходов
                    </p>
                    <a href="{{ route('categories.create') }}"
                       class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl inline-flex items-center gap-2">
                        <span>➕</span>
                        Создать первую категорию
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
