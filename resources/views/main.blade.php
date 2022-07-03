<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Population - USA</title>
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
