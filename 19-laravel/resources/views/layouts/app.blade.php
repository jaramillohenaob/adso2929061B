<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
</head>
@auth
    @php
    if (Auth::user()->role == 'Admin') {
        $colors = '#009a,#000c,#0000';
    } else {
        $colors = '#090a,#000c,#0000';
    }
    @endphp
@else
    @php $colors = '#000c,#0000'; @endphp
@endauth

<body class="bg-[linear-gradient(to_top,{{$colors}}),url('{{ asset('images/bg-welcome.png') }}')] bg-center bg-no-repeat bg-cover bg-fixed bg-black text-white pt-14 min-h-dvh flex flex-col gap-2 justify-center items-center">
    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        @yield('js')
    </script>
</body>
</html>