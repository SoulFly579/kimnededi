@extends('Author.layouts.master')
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
                        <td>{{$article->hit}}</td>
                        <td>{{$article->PercentageRatioCalculation($article->like,$article->dislike)}}</td>
                        <td>{{$article->getComment->count()}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td><input type="checkbox" article-id="{{$article->id}}" @if($article->status==1) checked @endif class="switch" data-offstyle="danger" data-onstyle="success" data-toggle="toggle" data-on="Aktif" data-off="Pasif"></td>
                        <td>
                            <a target="_blank" href="{{url('/'.$article->getCategory->slug.'/'.$article->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{url('author/articles/edit/'.$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a articles-id="{{$article->id}}" articles-title="{{$article->title}}" title="Sil" class="btn btn-sm btn-danger remove-click"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="alert alert-danger" id="articleAlert">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <form action="{{url("author/articles/delete")}}" method="post">
                            @csrf
                            <input type="hidden" id="delete_id" name="delete_id" >
                            <button type="submit" class="btn btn-primary" id="sil">Sil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <script>
            $('.remove-click').click(function () {
                        id = $(this)[0].getAttribute('articles-id')
                        title = $(this)[0].getAttribute('articles-title');
                        $('#sil').show();
                        $('#delete_id').val(id);
                        $('#articleAlert').html('');
                        $('#articleAlert').html('<strong> ' + title + '</strong>' + ' adlı makaleyi silmek istiyor musunuz ?');
                        $('#DeleteModal').modal();

                    });
                    $('.switch').change(function() {
                        id = $(this)[0].getAttribute('article-id');
                        statu = $(this).prop('checked');
                        $.get("{{url('author/articles/edit/status')}}",{id:id,statu:statu});
                    })
    </script>
@endsection
