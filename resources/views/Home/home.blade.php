<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
@if(Session::get("LoggedUser"))
    <h1>Hoşgeldiniz {{ Session::get("LoggedUser") }}</h1>
@else
<h1>Hoşgeldin müsafir</h1>
@endif
</body>
</html>
