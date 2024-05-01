@extends('layouts.layout')

@section('title', 'Product')

@section('mainContent')
    <div class="w-full h-screen overflow-x-hidden border-t">

        <main class="w-full flex-grow p-6">

            <div class="space-y-5 lg:space-y-8 py-7">

                {{-- filter and add product --}}
                <div class="flex justify-between items-center space-x-3">

                    {{-- Search by Category --}}
                    <form action="{{ route('product#filter') }}" method="get" class="flex justify-center items-center">

                        @csrf

                        <select name="category_id" class="px-3 py-1 w-full bg-slate-100 rounded">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class="px-2 py-1 ms-1 bg-slate-200 rounded-md shadow-sm hover:bg-slate-300 duration-200"><i
                                class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i></button>


                    </form>

                    {{-- Create Product --}}
                    <div>
                        <a href="#">
                            <button class="bg-blue-400 px-3 py-2 rounded-lg text-white hover:bg-blue-500 duration-200 ">New
                                Category</button>
                        </a>
                    </div>

                </div>

                {{-- Searching --}}
                <form action="{{ route('product#search') }}" method="get" class="">

                    @csrf

                    <input class="px-3 py-1 bg-slate-100 rounded" name="search" value="{{ request('search') }}"
                        type="search" placeholder="Search...">

                </form>

            </div>

            <div class="w-full">

                <div class="bg-white overflow-auto">

                    @if (count($products) != 0)
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>

                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        ID
                                    </th>

                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Product
                                    </th>

                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Category name
                                    </th>

                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Description
                                    </th>

                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        View
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($products as $product)
                                    <tr>

                                        {{-- ID --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $product->id }}</p>
                                        </td>

                                        {{-- Product --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full" src="{{ $product->photo }}"
                                                        alt="" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $product->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Category Name --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $product->category_name }}</p>
                                        </td>

                                        {{-- Description --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ Str::words($product->description, 5, ' ...') }}
                                            </p>
                                        </td>

                                        {{-- Price --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden
                                                    class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">${{ $product->price }}</span>
                                            </span>
                                        </td>

                                        {{-- View --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $product->price }}</p>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                            <div class="flex space-x-3 cursor-pointer">
                                                <a href="#">
                                                    <i class="fa-solid fa-pencil hover:text-blue-600 duration-300"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa-solid fa-trash hover:text-red-600 duration-300"></i>
                                                </a>
                                            </div>
                                            </p>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    @else
                        <h4 class="text-center text-red-400 font-medium py-5">Sorry, No Product for your search!</h4>
                    @endif

                </div>

                <div class="p-5">
                    {{ $products->appends(request()->query())->links() }}
                </div>

            </div>

        </main>

    </div>
@endsection
