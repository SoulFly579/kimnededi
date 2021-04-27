@extends('Admin.layouts.master')
@section('title','Duyuru Oluştur')
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
            <form action="{{url('admin/announcements/create')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Duyuru Başlığı</label>
                    <input type="text" name="title" class="form-control" placeholder="Duyuru Başlığını Giriniz." required>
                </div>
                <div class="form-group">
                    <label>Duyuru İçeriği</label>
                    <textarea id="editor" name="content" class="form-control" placeholder="Duyuru İçeriğini Giriniz." required></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" id="submit" type="submit">Duyuruyu Yayınla</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );

        $("#submit").onclick(()=>{
            console.log("bu işlem biraz sürebilir");
        })

    </script>
@endsection
