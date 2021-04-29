@extends('Admin.layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$authors->count()}} Yazar Bulunudu.</strong>
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
                        <th>Yazar Adı ve Soyadı</th>
                        <th>Yazar'ın makale sayısı</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{$author->name." ".$author->surname  }}</td>
                            <td>{{$author->getPost->count()}}</td>
                            <td>
                                <form method="POST" action="{{url("/admin/authors/status")}}">
                                    @csrf
                                    <input type="hidden" value="{{$author->id}}" name="authorId" />
                                    <input type="hidden" value="{{$author->staus}}" name="status" />
                                    <button title="Sil" type="submit" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></button>
                                </form>
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
@endsection
@section('js')
@endsection
