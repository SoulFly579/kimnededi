@extends('Admin.layouts.master')
@section('title','Site Ayarları')
@section('css')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{url('author/articles/create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Site Başlığı</label>
                        <input type="text" name="title" value="{{$settings->title}}" >
                    </div>
                    <div class="col-md-6">
                        a
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Makaleyi Oluştur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
@endsection
