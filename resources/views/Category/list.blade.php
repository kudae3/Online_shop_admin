@extends('layouts.layout')

@section('title', 'Category')

@section('mainContent')
<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="w-full flex-grow p-6">

        <div class="flex justify-between py-7">


            {{-- Searching --}}
            <form action="" method="get">
                <input class="w-full px-3 py-1 bg-slate-100 rounded" name="search" value="{{request('search')}}"  type="search" placeholder="Search..." >
            </form>

            {{-- Create Category --}}
            <div>
                <a href="{{route('category#create')}}">
                    <button class="bg-blue-400 px-3 py-2 rounded-lg text-white hover:bg-blue-500 duration-200 ">New Category</button>
                </a>
            </div>

        </div>

        <div class="w-full">

            <div class="bg-white overflow-auto">

                @if (count($categories) != 0)
                    <table class="min-w-full leading-normal">

                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Title
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Created at
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$category->id}}
                                        </p>

                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$category->name}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$category->description}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$category->created_at->format('d F Y')}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            <div class="flex space-x-3 cursor-pointer">
                                                <a href="http://">
                                                    <i class="fa-solid fa-pencil hover:text-blue-600 duration-300"></i>
                                                </a>
                                                <a href="http://">
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
                    <h4 class="text-center text-red-400 font-medium py-5">Sorry, No Category for your search!</h4>
                @endif

            </div>

            <div class="p-5">
                {{ $categories->appends(request()->query())->links() }}
            </div>

        </div>

    </main>

</div>
@endsection


