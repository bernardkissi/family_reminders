<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden flex items-center justify-center text-gray-700 bg-gray-200">
  <div class="antialiased font-sans bg-grey-lighter flex flex-col min-h-screen w-full" id="app">
    <router-view></router-view>
  </div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
