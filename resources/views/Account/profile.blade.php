@extends('layouts.layout')

@section('title', 'Profile')

@section('mainContent')
<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="w-full flex-grow py-5 px-10 space-y-8 ">

        <h1 class="text-slate-600 font-semibold text-center text-xl pb-7">Admin Profile</h1>

        <div class="md:flex justify-center space-y-7 md:space-y-0 md:space-x-7 ">

            <div>
                @if (Auth::user()->photo)
                    <img class="size-32 md:size-40 rounded-lg shadow-sm" src="{{asset('storage/'.Auth::user()->photo)}}" alt="">
                @else
                    @if (Auth::user()->gender == 'female')
                        <img class="size-32 md:size-40 rounded-lg shadow-sm" src="{{asset('gender/Female.jpeg')}}">
                    @else
                        <img class="size-32 md:size-40 rounded-lg shadow-sm" src="{{asset('gender/Male.png')}}">
                    @endif
                @endif
            </div>

            <div class="space-y-7">
                <h2 class="text-slate-600 font-semibold"> Name : {{Auth::user()->name}}</h2>

                <h2 class="text-slate-600 font-semibold"> Email : {{Auth::user()->email}}</h2>

                <h2 class="text-slate-600 font-semibold"> Phone no.  : {{Auth::user()->phone}}</h2>

                @if (Auth::user()->gender)
                    <h2 class="text-slate-600 font-semibold"> Gender : {{Auth::user()->gender}}</h2>
                @else
                    <h2 class="text-slate-600 font-semibold"> Gender : null </h2>
                @endif

                @if (Auth::user()->address)
                    <h2 class="text-slate-600 font-semibold"> Address : {{Auth::user()->address}}</h2>
                @else
                    <h2 class="text-slate-600 font-semibold"> Address : null </h2>
                @endif

                <form action="{{route('account#editBtn')}}" method="get">
                    @csrf
                    <button class="px-2 py-1 bg-green-500 hover:bg-green-600 duration-200 text-slate-50 rounded-lg " type="submit">
                        Edit Profile
                    </button>
                </form>

                <form action="{{route('account#changePassword')}}" method="get">
                    @csrf
                    <button class="px-2 py-1 bg-blue-500 hover:bg-blue-600 duration-200 text-slate-50 rounded-lg " type="submit">
                        Change Password
                    </button>
                </form>


            </div>
        </div>

    </main>

</div>
@endsection


