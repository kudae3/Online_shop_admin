@extends('layouts.layout')

@section('title', 'View Detail')

@section('mainContent')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="p-10 sm:px-0 md:max-w-lg lg:max-w-xl mx-auto space-y-5">

        <div>
            <h2 class="text-slate-600 font-semibold text-3xl pb-5 ">{{$product->name}} </h2>
        </div>

        <div class="sm:flex space-y-5 sm:space-y-0 sm:space-x-5">

            <div class="space-y-5">

                {{-- image --}}
                <div>
                    <img class="rounded-lg shadow-md sm:size-60 " src="{{asset('storage/'.$product->photo)}}" alt="">
                </div>

                {{-- price and view --}}
                <div class="flex items-center space-x-3">
                    <h2 class="bg-green-600 text-slate-50 font-semibold px-3 py-2 rounded-lg shadow-lg">$ {{$product->price}}</h2>
                    <h2 class="bg-teal-600 text-slate-50 font-semibold px-3 py-2 rounded-lg shadow-lg space-x-2">
                        @if ($product->view == null)
                            0 views
                        @else
                            {{$product->view}} views
                        @endif
                    </h2>
                </div>

            </div>

            <div class="space-y-5">
                {{-- category --}}
                <div>
                    <h2 class="text-slate-700 font-3xl font-semibold">Category - {{$product->category_name}}</h2>
                </div>

                {{-- description --}}
                <div>
                    <p class="text-slate-600">{{$product->description}}</p>
                </div>
            </div>

        </div>

    </main>

</div>


@endsection


