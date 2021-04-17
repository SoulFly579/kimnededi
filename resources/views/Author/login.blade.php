<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if(Session::get("fail"))
    <p>{{ Session::get("fail") }}</p>
@endif
<form action="{{url('/author/login')}}" method="POST">
    @csrf
    <input type="email" name="email" />
    @error("email"){{$message}}@enderror
    <input type="password" name="password" />
    @error("password"){{$message}}@enderror
    <button type="submit">Giriş yap</button>
</form>
</body>
</html>
