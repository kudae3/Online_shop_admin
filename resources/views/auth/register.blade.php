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


    <div class="mx-10 my-7 lg:my-5 flex justify-center items-center">

        <div class=" sm:w-1/2 lg:w-[410px] bg-slate-100 rounded-lg shadow-md p-10 space-y-12 md:space-y-20">

            <h2 class="font-caveat font-bold text-2xl md:text-5xl text-center text-slate-500" >Welcome to Shauzk!</h2>

            <form method="POST" action=" {{route('register')}} "  class="space-y-7">

                @csrf

                <div>
                    <label class="font-medium text-slate-600 block" for="">Username</label>
                    <input class=" font-semibold text-slate-500 rounded-xl border-orange-300 duration-300 bg-slate-100 w-full"  type="text" name="name" id="" >
                    @error('name')
                        <span class="text-red-600 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                <div>
                    <label class="font-medium text-slate-600 block" for="">Email</label>
                    <input class=" font-semibold text-slate-500 rounded-xl border-orange-300 duration-300 bg-slate-100 w-full"  type="email" name="email" id="" >
                    @error('email')
                        <span class="text-red-600 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                <div>
                    <label class="font-medium text-slate-600 block" for="">Phone</label>
                    <input class=" font-semibold text-slate-500 rounded-xl border-orange-300 duration-300 bg-slate-100 w-full"  type="text" name="phone" id="" >
                    @error('phone')
                        <span class="text-red-600 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                <div>
                    <label class="font-medium text-slate-600 block" for="">Password</label>
                    <input class=" font-semibold text-slate-500 rounded-xl border-orange-300 duration-300 bg-slate-100 w-full"  type="password" name="password" id="" >
                    @error('password')
                        <span class="text-red-600 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                <div>
                    <label class="font-medium text-slate-600 block" for="">Re-type Password</label>
                    <input class=" font-semibold text-slate-500 rounded-xl border-orange-300 duration-300 bg-slate-100 w-full"  type="password" name="confirm_password" id="" >
                    @error('confirm_password')
                        <span class="text-red-600 text-sm"> {{ $message }} </span>
                    @enderror
                </div>

                <button type="submit" class="px-3 py-2 text-slate-50 font-semibold bg-orange-400 rounded-md hover:scale-x-110 hover:bg-orange-500 duration-700">Signup</button>

            </form>


            <p class="font-medium text-slate-500 text-sm">Already have an account?
                <a href="{{route('loginPage')}}" class="hover:text-orange-600 duration-300">Login</a>
            </p>

        </div>

    </div>

</body>

</html>
