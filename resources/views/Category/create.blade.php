@extends('layouts.layout')

@section('title', 'Category')

@section('mainContent')

<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="p-10 md:max-w-lg lg:max-w-xl mx-auto">

        <div class="py-3">
            <h2 class="text-slate-600 font-semibold text-lg">Create New Category</h2>
        </div>

        <form action="{{route('category#create')}}" method="post" class="space-y-5">

            @csrf

            <div class="space-y-3">
                <label class="text-slate-600 font-medium" for="name">Category Name</label>
                <input class="outline-none w-full font-medium text-slate-700 rounded-lg" type="text" name="name" id="name">
                @error('name')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            <div class="space-y-3">
                <label class="text-slate-600 font-medium" for="description">Description</label>
                <textarea class="outline-none w-full font-medium text-slate-700 rounded-lg" name="description" id="description" rows="7"></textarea>
                @error('description')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            <div class="text-end">
                <button class="text-slate-50 bg-blue-600 px-3 py-2 rounded-md shadow-md hover:scale-x-105 hover:bg-blue-700 duration-300" type="submit">Create</button>
            </div>

        </form>

    </main>

</div>

@endsection


