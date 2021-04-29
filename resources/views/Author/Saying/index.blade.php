@extends('Author.layouts.master')
@section('title','Tüm Sözler')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Söz Oluştur</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('author/sayings/create')}}">
                        @csrf
                        <div class="form-group">
                            @if(Session::get("success"))
                                <div class="alert alert-success">{{Session::get("success")}}</div>
                            @endif
                            @if(Session::get("fail"))
                                <div class="alert alert-danger">{{Session::get("fail")}}</div>
                            @endif
                            <label> Söz İçeriği</label><br>
                                @error("sayings")<p style="color:red">{{$message}}</p>@enderror
                            <input type="text" class="form-control" name="sayings" required ><br>
                            <label> Söz Söyleyen</label><br>
                                @error("speaker")<p style="color:red">{{$message}}</p>@enderror
                            <input type="text" class="form-control" name="speaker"  id="speakers" required>
                            <label>Description Alanı</label><br>
                                @error("description")<p style="color:red">{{$message}}</p>@enderror
                            <textarea class="form-control" name="description" required></textarea>
                            <label>Keywords Alanı</label><br>
                                @error("keywords")<p style="color:red">{{$message}}</p>@enderror
                                <textarea class="form-control" name="keywords" required></textarea>
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
                                <th>Söz ID</th>
                                <th>Söz İçeriği</th>
                                <th>Söyleyen Adı</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sayings as $sayings)
                                <tr>
                                    <td>{{$sayings->id}}</td>
                                    <td>{{$sayings->sentence}}</td>
                                    <td>{{$sayings->getSpeaker->name}}</td>
                                    <td>
                                        <a sayings-id="{{$sayings->id}}" sayings-sentence="{{$sayings->sentence}}" sayings-name="{{$sayings->getSpeaker->name}}" class="btn btn-sm btn-danger remove-click" title="Kategoriyi Sil"><i class="fa fa-times"></i></a>
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
                            <form action="{{url("author/sayings/delete")}}" method="post">
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
            <script>
                $(function() {
                    $('.remove-click').click(function () {
                        id = $(this)[0].getAttribute('sayings-id');
                        sentence = $(this)[0].getAttribute('sayings-sentence');

                        $('#sil').show();
                        $('#delete_id').val(id);
                        $('#articleAlert').html('');
                        $('#articleAlert').html('<strong> ' + sentence + '</strong>' + ' sözünü silmek istiyor musunuz ?');

                        $('#DeleteModal').modal();

                    });
                    let search = $("#speakers").val();
                    $('#speakers').typeahead({
                        source:  function (query, process) {
                            return $.ajax({
                                type:"GET",
                                url: "{{url("/author/speakers/get")}}",
                                data:{search:search},
                                success: function (data) {
                                    return process(data);
                                }
                            });
                        }
                    });
                })
            </script>
@endsection

