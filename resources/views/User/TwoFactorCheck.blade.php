<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('/two_factor_verify') }}" method="POST">
        @csrf
        <input type="text" name="code" />
        <button type="submit">Gönder</button>
    </form>
</body>
</html>