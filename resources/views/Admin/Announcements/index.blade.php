@extends('Admin.layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$announcements->count()}} Yazar Bulunudu.</strong>
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
                        <th>Duyuru Adı</th>
                        <th>Kim Yayınladı</th>
                        <th>Duyuru Tarihi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($announcements as $announcement)
                        <tr>
                            <td>{{$announcement->title}}</td>
                            <td>{{$announcement->getFrom->name." ".$announcement->getFrom->surname}}</td>
                            <td>{{$announcement->created_at->diffForHumans()}}</td>
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
