<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <title>Population - USA</title>
    @vite('resources/css/app.js')
    <meta name="theme-color" content="#111111" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#eeeeee" media="(prefers-color-scheme: dark)">
</head>
<body class="py-4">
<div class="container">
    <div class="text-center">
        <h1 class="fw-bold">Population USA</h1>
    </div>
    <div class="row mt-4">
        <div class="col-4">
            <x-table/>
            <x-refresh/>
        </div>
        <div class="col-8">
            <x-chart/>
        </div>
    </div>
</div>
</body>
@vite('resources/js/app.js')
</html>
