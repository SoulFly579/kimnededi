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
    <form action="{{url('/register')}}" method="POST">
        @csrf
        <input type="email" name="email" />
        @error("email"){{$message}}@enderror
        <input name="name" type="text" />
        @error("name"){{$message}}@enderror
        <input name="surname" type="text" />
        @error("surname"){{$message}}@enderror
        <input name="username" type="text" />
        @error("username"){{$message}}@enderror
        <input name="password" type="password"/>
        @error("password"){{$message}}@enderror
        <button type="submit">Giriş yap</button>
    </form>
</body>
</html>
