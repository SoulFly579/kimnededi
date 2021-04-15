<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Aramıza Hoşgeldin {{ $user->name }},
        Senin bir robot olmadığını biliyoruz ama yine de robot musun emin değiliz :)
        Lütfen aşağıdaki butona tıkla...
        <a href="{{ url('/account/verification/'.$user->email_verified_token) }}">Bana Tıkla</a>
</body>
</html>