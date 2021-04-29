@extends('Author.layouts.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$activity->count()}} Giriş Bulunudu.</strong>
            </h6>
        </div>
        <div class="card-body">
            @if(Session::get("fail"))
                <div class="alert alert-danger">{{Session::get("fail")}}</div>
            @endif
            @if(Session::get("success"))
                <div class="alert alert-success">{{Session::get("success")}}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>IP Adres</th>
                        <th>Platform</th>
                        <th>Device</th>
                        <th>Zaman</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activity as $activity)
                        <tr>
                            <td>{{$activity->id}}</td>
                            <td>{{$activity->ip_address}}</td>
                            <td>{{$activity->platform}} </td>
                            <td>{{$activity->device}}</td>
                            <td>{{$activity->created_at}}</td>
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
