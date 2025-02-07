<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','ther is no thing title')</title>
</head>
<body>

    @include('layout.navbar')
    @include('layout.sidebar')
    @yIeld('content')
    @section('sidebar')
    this is from 
    @show
</body>
</html>