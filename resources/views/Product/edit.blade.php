@extends('layouts.layout')

@section('title', 'Edit Product')

@section('mainContent')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="w-full h-screen overflow-x-hidden border-t">

    <main class="p-10 md:max-w-lg lg:max-w-xl mx-auto">

        <div class="py-3">
            <h2 class="text-slate-600 font-semibold text-lg">Edit {{$product->name}} </h2>
        </div>

        <form action="{{route('product#updateBtn', $product->id)}}" method="post" class="space-y-7" enctype="multipart/form-data">

            @csrf

            {{-- Show Image --}}
            <div class="space-y-3">
                <img id="showImage" class="size-28 shadow-sm rounded-md" src="{{asset('storage/'.$product->photo)}}" alt="">
            </div>

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
                <input class="outline-none w-full font-medium text-slate-700 rounded-lg" type="text" name="name" id="name" value="{{old('name', $product->name)}}" >
                @error('name')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            {{-- Category --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold" for="category">Choose Category</label>

                <select class="outline-none w-full font-medium text-slate-700 rounded-lg" name="category" id="category">
                    @foreach ($categories as $category)
                        <option
                            @if ($category->id == $product->category_id) selected @endif value={{$category->id}}>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Price --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold" for="price">Price</label>
                <input class="outline-none w-full font-medium text-slate-700 rounded-lg" type="text" name="price" id="price" value="{{old('price', $product->price)}}">
                @error('price')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>

            {{-- Description --}}
            <div class="space-y-3">
                <label class="text-slate-600 font-semibold" for="description">Description</label>
                <textarea class="outline-none w-full font-medium text-slate-700 rounded-lg" name="description" id="description" rows="7" >{{old('description', $product->description)}}</textarea>
                @error('description')
                    <span class="text-red-600 font-semibold text-sm"> {{ $message }} </span>
                @enderror
            </div>


            <div class="text-end">
                <button class="text-slate-50 bg-blue-600 px-3 py-2 rounded-md shadow-md hover:scale-x-105 hover:bg-blue-700 duration-300" type="submit">Update</button>
            </div>

        </form>

    </main>

</div>

<script>
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>

@endsection


