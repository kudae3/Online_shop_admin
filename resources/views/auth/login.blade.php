<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/183280f8d9.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Comfortaa:wght@300..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>


    <div class="m-10 flex justify-center items-center">

        <div class=" sm:w-1/2 lg:w-[400px] bg-slate-100 rounded-lg shadow-md p-10 space-y-12 md:space-y-20">

            <h2 class="font-caveat font-bold text-2xl md:text-5xl text-center text-slate-500" >Login to Shauzk!</h2>

            <form action="{{route('login')}}" method="POST" class="space-y-7">

                @csrf

                <div class="space-y-3">
                    <label class="font-medium text-slate-600 block" for="">Email</label>
                    <input class=" font-semibold text-slate-600 rounded-xl border-orange-300 duration-300 bg-slate-100 w-full"  type="email" name="email" id="" >
                    @error('email')
                        <span class="text-red-600 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="space-y-3">
                    <label class="font-medium text-slate-600 block" for="">Password</label>
                    <input class=" font-semibold text-slate-600 rounded-xl border-orange-300 duration-300 bg-slate-100 w-full"  type="password" name="password" id="" >
                    @error('password')
                        <span class="text-red-600 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                <button type="submit" class="px-3 py-2 text-slate-50 font-semibold bg-orange-400 rounded-md hover:scale-x-110 hover:bg-orange-500 duration-700">Login</button>

            </form>

            <p class="font-medium text-slate-500 text-sm">New user?
                <a href="{{route('registerPage')}}" class="hover:text-orange-600 duration-300">Register an account</a>
            </p>

        </div>

    </div>

</body>

</html>
