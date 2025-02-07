<!DOCTYPE html>
<html>
<head>
    <title>Laravel + React</title>
    <!-- Include Vite assets -->
    @vite(['resources/js/app.jsx'])
</head>
<body>
    <div id="react-app"></div>
    <div class="container">
        <h1>Laravel Blade Content</h1>
        <!-- React component will be mounted here -->
        <div id="react-root"></div>
    </div>
</body>
</html>
