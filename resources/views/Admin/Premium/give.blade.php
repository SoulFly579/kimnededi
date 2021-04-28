@extends('Admin.layouts.master')
@section('title','Premium Ver')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Prmeium Ver</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('admin/premiums/give')}}">
                        @csrf
                        <div class="form-group">
                            @if(Session::get("success"))
                                <div class="alert alert-success">{{Session::get("success")}}</div>
                            @endif
                            @if(Session::get("error"))
                                <div class="alert alert-danger">{{Session::get("error")}}</div>
                            @endif
                            <label>Premium Türü</label>
                            <select class="form-control" name="premium_id">
                                @foreach($premiumsType as $premiumsTypes)
                                    <option value="{{$premiumsTypes->id}}">{{$premiumsTypes->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="search" class="form-control" name="user"/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block ">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Kullanıcı ID</th>
                                <th>Kullanıcı Adı</th>
                                <th>Kullanıcı Email</th>
                                <th>Kullanıcı Premium Bitiş Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $users)
                                <tr>
                                    <td>{{$users->id}}</td>
                                    <td>{{$users->name}}</td>
                                    <td>{{$users->email}}</td>
                                    <td>{{$users->premium_finished_date}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @endsection
        @section('css')
        @endsection
        @section('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
            <script>
                $(function() {
                    let search = $("#search").val();
                    $('#search').typeahead({
                        source:  function (query, process) {
                            return $.ajax({
                                type:"GET",
                                url: "{{url("/admin/premiums/give/get")}}",
                                data:{search:search},
                                success: function (data) {
                                    console.log(data);
                                    return process(data);
                                }
                            });
                        }
                    });
                })
            </script>
@endsection

