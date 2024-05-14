@extends('layouts.layout')

@section('title', 'Orders')

@section('mainContent')
<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="w-full flex-grow p-6 space-y-8 ">

        <div class="space-y-5 sm:space-y-0 sm:flex sm:justify-between">

            {{-- Searching --}}
            <form action="" method="get">
                @csrf
                <input class="px-3 py-1 bg-slate-100 rounded" name="search" value="{{request('search')}}"  type="search" placeholder="Search..." >

                <button type="submit" class="px-2 py-1 ms-1 bg-slate-200 rounded-md shadow-sm hover:bg-slate-300 duration-200">
                    <i class="fa-solid fa-magnifying-glass fa-flip-horizontal"></i>
                </button>

            </form>

            {{-- filter by status --}}
            <form action="" method="get" class="flex items-center">

                @csrf

                <select name="status" class="px-3 py-1 bg-slate-100 rounded">
                    <option value="">All</option>
                    <option @if ( request('status') == '0') selected @endif value="0">Pending</option>
                    <option @if ( request('status') == '1') selected @endif  value="1">Accepted</option>
                    <option @if ( request('status') == '2') selected @endif  value="2">Rejected</option>
                </select>

                <button type="submit" class="px-2 py-1 ms-1 bg-slate-200 rounded-md shadow-sm hover:bg-slate-300 duration-200">
                    <i class="fa-solid fa-check fa-lg"></i>
                </button>


            </form>

        </div>

        <div class="w-full">

            <div class="bg-white overflow-auto">

                @if (count($orders) != 0)
                    <table class="min-w-full leading-normal">

                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    User Id
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Username
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Oder Code
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    total price
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>


                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orders as $order)
                                <tr>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->id}}
                                        </p>

                                    </td>


                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->user_id}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->user_name}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->order_code}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->total_price}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                        <p class="text-gray-900 whitespace-no-wrap text-center">

                                            <form class="text-center" action="{{route('order#changeStatus')}}" method="post">

                                                    @csrf

                                                    <div class="flex items-center space-x-2">

                                                        <input type="hidden" name="id" value="{{$order->id}}">
                                                        <select name="status" class="px-2 py-1 w-full border-0 bg-transparent outline-none focus:none appearance-none focus:ring-0">

                                                            <option value="0" @if ($order->status == 0) selected @endif>
                                                                Pending
                                                            </option>
                                                            <option value="1" @if ($order->status == 1) selected @endif>
                                                                Accepted
                                                            </option>
                                                            <option value="2" @if ($order->status == 2) selected @endif>
                                                                Rejected
                                                            </option>

                                                        </select>

                                                        <button class="hover:text-green-400" type="submit">
                                                            <i class="fa-solid fa-circle-check fa-lg"></i>
                                                        </button>

                                                    </div>

                                            </form>
                                        </p>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                @else
                    <h4 class="text-center text-red-400 font-medium py-5">Sorry, No order found!</h4>
                @endif

            </div>

            <div class="p-5">
                {{ $orders->appends(request()->query())->links() }}
            </div>

        </div>

    </main>

</div>
@endsection


