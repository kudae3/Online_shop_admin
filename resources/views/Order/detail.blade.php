@extends('layouts.layout')

@section('title', 'order detail')

@section('mainContent')
<div class="w-full px-14 py-5 h-screen overflow-x-hidden border-t">


            <div class="bg-white overflow-auto">

                    <table class="min-w-full leading-normal">

                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Product id
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Product name
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Price per item
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Total amount
                                </th>
                                <th
                                    class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Order date
                                </th>


                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orders as $order)
                                <tr>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->product_id}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->product_name}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            $ {{$order->price}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->quantity}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            $ {{$order->total_price}}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap text-center">
                                            {{$order->created_at->format('d F Y')}}
                                        </p>
                                    </td>



                                </tr>
                            @endforeach

                        </tbody>

                    </table>

            </div>

</div>
@endsection
