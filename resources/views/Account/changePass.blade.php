@extends('layouts.layout')

@section('title', 'change Password')

@section('mainContent')
<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="py-5 px-10 space-y-8">

        <h1 class="text-slate-600 font-semibold text-xl pb-7">Change Password</h1>

        <form action="{{route('account#confirmPassBtn')}}" method="post" class="space-y-16">

            @csrf

                <div>
                    <h2 class="text-slate-600 font-semibold"> Current password :
                        <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="currentPassword">
                    </h2>

                    @error('currentPassword')
                        <h2 class="text-red-600 font-semibold text-sm pt-3"> {{ $message }} </h2>
                    @enderror

                    @if (session('PassError'))
                        <h2 class="text-red-600 font-semibold text-sm pt-3">{{session('PassError')}}</h2>
                    @endif

                </div>

                <div>
                    <h2 class="text-slate-600 font-semibold"> New password :
                        <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="newPassword">
                    </h2>
                    @error('newPassword')
                        <h2 class="text-red-600 font-semibold text-sm pt-3"> {{ $message }} </h2>
                    @enderror

                </div>

                <div>
                    <h2 class="text-slate-600 font-semibold"> Confirm new password :
                        <input class="bg-transparent outline-none focus:none appearance-none focus:ring-0 border-0 border-b-[1px] focus:border-green-400 duration-300 py-0" type="text" name="confirmPassword">
                    </h2>
                    @error('confirmPassword')
                        <h2 class="text-red-600 font-semibold text-sm pt-3"> {{ $message }} </h2>
                    @enderror
                </div>

                <button class="px-3 py-1 bg-green-500 hover:bg-green-600 duration-200 text-slate-50 rounded-lg " type="submit">
                    Confirm 👍
                </button>

        </form>

    </main>

</div>

@endsection


