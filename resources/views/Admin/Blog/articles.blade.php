@extends('Admin.layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} Makale Bulunudu.</strong>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::get("error"))
                <div class="alert alert-danger">{{Session::get("error")}}</div>
            @endif
            @if(Session::get("success"))
                <div class="alert alert-success">{{Session::get("success")}}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Yazar</th>
                        <th>Hit</th>
                        <th>Beğeni Oranı</th>
                        <th>Yorum Sayısı</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{$article->title}}</td>
                            <td>{{$article->getCategory->name}}</td>
                            <td>{{$article->getAuthor->name}} {{$article->getAuthor->surname}} </td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->PercentageRatioCalculation($article->like,$article->dislike)}}</td>
                            <td>{{$article->getComment->count()}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td>@if($article->status==1) Aktif @else Pasif @endif</td>
                            <td>
                                <a target="_blank" href="{{url('/'.$article->getCategory->slug.'/'.$article->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
@endsection
