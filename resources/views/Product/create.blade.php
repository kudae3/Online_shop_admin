@extends('layouts.layout')

@section('title', 'Create Product')

@section('mainContent')

<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="p-10 md:max-w-lg lg:max-w-xl mx-auto">

        <div class="py-3">
            <h2 class="text-slate-600 font-semibold text-lg">Create New Product</h2>
        </div>

        <form action="{{route('product#createBtn')}}" method="post" class="space-y-7" enctype="multipart/form-data">

            @csrf

            {{-- Image --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold outline-none" for="image">Image</label>
                <input class="outline-none w-full font-medium text-slate-700" type="file" name="image" id="image">
                @error('image')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            {{-- name --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold" for="name">Product Name</label>
                <input class="outline-none w-full font-medium text-slate-700 rounded-lg" type="text" name="name" id="name" value="{{old('name')}}" >
                @error('name')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            {{-- Category --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold" for="category">Choose Category</label>

                <select class="outline-none w-full font-medium text-slate-700 rounded-lg" name="category" id="category">
                    @foreach ($categories as $category)
                        <option value={{$category->id}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            {{-- Price --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold" for="price">Price</label>
                <input class="outline-none w-full font-medium text-slate-700 rounded-lg" type="text" name="price" id="price" value="{{old('price')}}">
                @error('price')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            {{-- Description --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold" for="description">Description</label>
                <textarea class="outline-none w-full font-medium text-slate-700 rounded-lg" name="description" id="description" rows="7" >{{old('description')}}</textarea>
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


