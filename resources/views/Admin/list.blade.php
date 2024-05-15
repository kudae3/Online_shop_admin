@extends('layouts.layout')

@section('title', 'Admins')

@section('mainContent')
<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="w-full flex-grow p-6 space-y-8 ">

        <div>

            {{-- Searching --}}
            <form action="" method="get">

                <input class="px-3 py-1 bg-slate-100 rounded" name="search" value="{{request('search')}}"  type="search" placeholder="Search..." >

                <button type="submit" class="px-2 py-1 ms-1 bg-slate-200 rounded-md shadow-sm hover:bg-slate-300 duration-200">
                    <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                </button>

            </form>

        </div>

        <div class="w-full">

            <div class="bg-white overflow-auto">

                @if (count($admins) != 0)
                    <table class="min-w-full leading-normal">

                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Ph no.
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Address
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Switch to user
                                </th>


                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($admins as $admin)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$admin->id}}
                                        </p>

                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">

                                            <div class="flex-shrink-0 w-10 h-10">
                                                @if ($admin->photo)
                                                    <img class="w-full h-full rounded-full" src="{{ asset('storage/'.$admin->photo) }}">
                                                @else
                                                    @if ($admin->gender == 'female')
                                                        <img class="w-full h-full rounded-full" src="{{ asset('gender/Female.jpeg') }}">
                                                    @else
                                                        <img class="w-full h-full rounded-full" src="{{ asset('gender/Male.png') }}">
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$admin->name}}
                                                </p>
                                            </div>

                                        </div>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$admin->email}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$admin->phone}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{$admin->address}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if (Auth::user()->id !== $admin->id)
                                            <p class="text-gray-900 whitespace-no-wrap ">
                                                <form class="text-center" action="{{route('admin#switchUser')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value={{$admin->id}}>
                                                    <button class="hover:text-green-400" type="submit">
                                                        <i class="fa-solid fa-repeat fa-lg"></i>
                                                    </button>
                                                </form>
                                            </p>
                                        @else

                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <h4 class="text-center text-red-400 font-medium py-5">Sorry, No admin found!</h4>
                @endif

            </div>

            <div class="p-5">
                {{ $admins->appends(request()->query())->links() }}
            </div>

        </div>

    </main>

</div>
@endsection


