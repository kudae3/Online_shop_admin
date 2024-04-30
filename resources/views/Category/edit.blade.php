@extends('layouts.layout')

@section('title', 'Edit Category')

@section('mainContent')

<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="p-10 md:max-w-lg lg:max-w-xl mx-auto">

        <div class="py-3">
            <h2 class="text-slate-600 font-semibold text-lg">Edit Category</h2>
        </div>

        <form action="{{route('category#updateBtn', $category->id)}}" method="post" class="space-y-5">

            @csrf

            <div class="space-y-3">
                <label class="text-slate-600 font-medium" for="name"> Edit Category Name</label>
                <input class="outline-none w-full font-medium text-slate-700 rounded-lg" type="text" name="name" id="name" value="{{old('name',$category->name)}}" >
                @error('name')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            <div class="space-y-3">
                <label class="text-slate-600 font-medium" for="description">Edit Description</label>
                <textarea class="outline-none w-full font-medium text-slate-700 rounded-lg" name="description" id="description" rows="7">{{old('description', $category->description)}}</textarea>
                @error('description')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            <div class="text-end">
                <button class="text-slate-50 bg-blue-600 px-3 py-2 rounded-md shadow-md hover:scale-x-105 hover:bg-blue-700 duration-300" type="submit">Save</button>
            </div>

        </form>

    </main>

</div>

@endsection


