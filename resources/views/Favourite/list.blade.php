@extends('layouts.layout')

@section('title', 'Category')

@section('mainContent')
<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="w-full flex-grow p-6">

        <div class="py-7">

            {{-- Searching --}}
            <form action="" method="get">
                @csrf
                <input class="px-3 py-1 bg-slate-100 rounded" name="search" value="{{request('search')}}"  type="search" placeholder="Search..." >

                <button type="submit" class="px-2 py-1 ms-1 bg-slate-200 rounded-md shadow-sm hover:bg-slate-300 duration-200">
                    <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                </button>

            </form>

        </div>

        <div class="w-full">

            <div class="bg-white overflow-auto">

                @if (count($favs) != 0)
                    <table class="min-w-full leading-normal">

                        <thead>
                            <tr>

                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    User id
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Username
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Product name (id)
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Created at
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($favs as $fav)
                                <tr>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$fav->user_id}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$fav->user_name}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a href="{{route('product#detail', $fav->product_id)}}">
                                            <p class="text-blue-600 whitespace-no-wrap text-center">
                                                {{$fav->product_name}} ({{$fav->product_id}})
                                            </p>
                                        </a>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$fav->created_at->format('d F Y')}}
                                        </p>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <h4 class="text-center text-red-400 font-medium py-5">Sorry, No favourite product found!</h4>
                @endif

            </div>

            <div class="p-5">
                {{ $favs->appends(request()->query())->links() }}
            </div>

        </div>

    </main>

</div>
@endsection


