@extends('Author.layouts.master')
@section('title','Tüm Söyleyenler')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Söyleyen Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('author/speakers/create')}}">
                        @csrf
                        <div class="form-group">
                            @if(Session::get("success"))
                                <div class="alert alert-success">{{Session::get("success")}}</div>
                            @endif
                            @if(Session::get("fail"))
                                <div class="alert alert-danger">{{Session::get("fail")}}</div>
                            @endif
                            <label> Söyleyen Adı </label><br>
                                @error("name")<p style="color:red">{{$message}}</p>@enderror
                            <input type="text" class="form-control" name="name" required><br>
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
                                <th>Söyleyen ID</th>
                                <th>Söyleyenin Adı</th>
                                <th>Söyleyene Ait Sözler</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($speakers as $speakers)
                                <tr>
                                    <td>{{$speakers->id}}</td>
                                    <td>{{$speakers->name}}</td>
                                    <td>{{$speakers->getSaying->count()}}</td><td>
                                        <a speakers-id="{{$speakers->id}}" speakers-name="{{$speakers->name}}" class="btn btn-sm btn-danger remove-click" title="Söyleyen Sil"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal -->
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
                            <form action="{{url("author/speakers/delete")}}" method="post">
                                @csrf
                                <input type="hidden" id="delete_id" name="delete_id">
                                <button type="submit" class="btn btn-primary" id="sil">Sil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection
        @section('css')
        @endsection
        @section('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
            <script>
                $(function() {
                    $('.remove-click').click(function () {
                        id = $(this)[0].getAttribute('speakers-id');
                        name = $(this)[0].getAttribute('speakers-name');

                        if(id==1){
                            $('#articleAlert').html('<strong> '+name+'</strong>'+' adlı kategori silinemez.');
                            $('#sil').hide();
                            $('#DeleteModal').modal();
                            return;
                        }
                        $('#sil').show();
                        $('#delete_id').val(id);
                        $('#articleAlert').html('');
                        $('#articleAlert').html('<strong> ' + name + '</strong>' + ' adlı söyleyeni silmek istiyor musunuz ?');

                        $('#DeleteModal').modal();

                    });

                })
            </script>
@endsection

