<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="text-center my-4">
    <h1 class="lead">Taxiade Todo Assessment</h1>

    <main class="my-4 d-flex justify-content-between mx-auto" style="width:30%">
        <a type="button" class="btn btn-primary" href="{{route('login.get')}}">Node.js Authentication</a>
        <a type="button" class="btn btn-warning" href="{{route('sqllogin.get')}}">Laravel Authentication</a>
    </main>
</body>
</html>
