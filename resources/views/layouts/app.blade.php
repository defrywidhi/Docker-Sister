<!doctype html>

<html>
    <head>
    <script src="https://cdn.tailwindcss.com"></script>

   @include('includes.head')

</head>

<body class="flex flex-col min-h-screen">

<div class="container">

   <header class="row">

       @include('includes.header')

   </header>

   <div id="main" class="min-h-screen">

           @yield('content')

   </div>

   <footer class="row">

       @include('includes.footer')

   </footer>

</div>

</body>

</html>