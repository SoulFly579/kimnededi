@extends('Admin.layouts.master')
@section('title','Yazar Oluştur')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if(Session::get("fail"))
                <div class="alert alert-danger">{{Session::get("error")}}</div>
            @endif
            @if(Session::get("success"))
                <div class="alert alert-success">{{Session::get("success")}}</div>
            @endif
            <form action="{{url('admin/authors/create')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Yazar Adı</label>
                    <input type="text" name="name" class="form-control" placeholder="Yazarın Adını Giriniz." required>
                </div>
                <div class="form-group">
                    <label>Yazar Soyadı</label>
                    <input type="text" name="surname" class="form-control" placeholder="Yazarın Soyadını Giriniz." required>
                </div>
                <div class="form-group">
                    <label>Yazar Kullanıcı Adı</label>
                    <input type="text" name="username" class="form-control" placeholder="Yazarın Kullanıcı Adını Giriniz." required>
                </div>
                <div class="form-group">
                    <label>Yazar E-posta</label>
                    <input type="text" name="email" class="form-control" placeholder="Yazarın Email Adresini Giriniz." required>
                </div>
                <div class="form-group">
                    <label>Yazar Yaşadığı Yer</label>
                    <input type="text" name="location" class="form-control" placeholder="Yazarın Yaşadığı Yeri Giriniz." required>
                </div>
                <div class="form-group">
                    <label>Yazar Adres</label>
                    <textarea type="text" name="address" class="form-control" placeholder="Yazarın Adresini Giriniz." required></textarea>
                </div>
                <div class="form-group">
                    <label>Yazar Telefon Numarası</label>
                    <input type="tel" class="form-control" name="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" placeholder="Lütfen 5435152218 Formatıda Yazınız."/>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Yazarı Kayıt Et</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
@endsection
