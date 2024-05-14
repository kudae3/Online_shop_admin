@extends('layouts.layout')

@section('title', 'Edit Profile')

@section('mainContent')
<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="w-full flex-grow py-5 px-10 space-y-8 ">

        <h1 class="text-slate-600 font-semibold text-center text-xl pb-7">Edit Admin Profile</h1>

        <form action="{{route('account#saveBtn')}}" method="post" class="lg:flex justify-center space-y-7 lg:space-y-0 lg:space-x-7" enctype="multipart/form-data">

            @csrf

            <div class="space-y-5">

                @if (Auth::user()->photo)
                    <img class="size-32 md:size-40 rounded-lg shadow-sm" src="{{asset('storage/'.Auth::user()->photo)}}" alt="">
                @else
                    @if (Auth::user()->gender == 'male')
                        <img class="size-32 md:size-40 rounded-lg shadow-sm" src="{{asset('gender/Male.png')}}" alt="">
                    @elseif (Auth::user()->gender == 'female')
                        <img class="size-32 md:size-40 rounded-lg shadow-sm" src="{{asset('gender/Female.png')}}" alt="">
                    @else
                        <img class="size-32 md:size-40 rounded-lg shadow-sm" src="{{asset('gender/Male.png')}}" alt="">
                    @endif
                @endif

                @error('image')
                    <h2 class="text-red-600 font-semibold text-sm"> {{ $message }} </h2>
                @enderror

                <input class="min-w-sm image" type="file" name="image">

            </div>

            <div class="space-y-10">

                <h2 class="text-slate-600 font-semibold"> Name :
                    <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="name" value="{{old('name', Auth::user()->name)}}">
                </h2>
                @error('name')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror

                <h2 class="text-slate-600 font-semibold"> Email :
                    <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="email" value="{{old('email', Auth::user()->email)}}">
                </h2>
                @error('email')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror

                <h2 class="text-slate-600 font-semibold"> Phone :
                    <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="phone" value="{{old('phone', Auth::user()->phone)}}">
                </h2>
                @error('phone')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror

                <h2 class="text-slate-600 font-semibold"> Gender :
                    <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="gender" value="{{old('gender', Auth::user()->gender)}}">
                </h2>

                <h2 class="text-slate-600 font-semibold"> Address  :
                    <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="address" value="{{old('address', Auth::user()->address)}}">
                </h2>

                <input type="hidden" name="id" value="{{Auth::user()->id}}">


                <button class="px-3 py-1 bg-green-500 hover:bg-green-600 duration-200 text-slate-50 rounded-lg " type="submit">
                    Save 👍
                </button>


            </div>

        </form>

    </main>

</div>

@endsection


