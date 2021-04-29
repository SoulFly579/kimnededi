@extends('Admin.layouts.master')
@section('title','Premium Ekleme/Görüntüleme Ekranı')
@section('content')
    <h2>Paket Ekle</h2>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if(Session::get("error"))
                <div class="alert alert-danger">{{Session::get("error")}}</div>
            @endif
            @if(Session::get("success"))
                <div class="alert alert-success">{{Session::get("success")}}</div>
            @endif
            <form action="{{url('admin/premiums/create')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Premium İsmi</label><br>
                    @error("name")<p style="color:red">{{$message}}</p>@enderror
                    <input type="text" name="name" class="form-control" required />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Paket Geçerlilik Süresi</label><br>
                            @error("validityTime")<p style="color:red">{{$message}}</p>@enderror
                            <select name="validityTime" class="form-control" required>
                                <option value="">Paket Tarihi Seçiniz</option>
                                @for($i = 1; $i<31; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Paket Geçerlilik Türü</label><br>
                            @error("validityType")<p style="color:red">{{$message}}</p>@enderror
                            <select name="validityType" class="form-control" required>
                                <option value="">Geçerlilik Türü Seçiniz</option>
                                <option value="month">Ay</option>
                                <option value="day">Gün</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Paket Özellikleri</label><br>
                    @error("content")<p style="color:red">{{$message}}</p>@enderror
                    <div class="alert alert-warning" role="alert">
                        Lütfen özellikleri liste şeklinde ve alt alta olacak şekilde yazınız.
                    </div>
                    <textarea name="content" id="editor" cols="30" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    <label>Paket Fiyatı</label><br>
                    @error("price")<p style="color:red">{{$message}}</p>@enderror
                    <div class="alert alert-warning" role="alert">
                        Lütfen fiyatı sadece sayı olarak yazınız. Örn: 15.
                    </div>
                    <input class="form-control" required name="price" type="number">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Paketi Oluştur</button>
                </div>
            </form>
        </div>
    </div>
    <h2>Paket Türleri</h2>
    @if($premiumTypes->count()>0)
        @foreach($premiumTypes as $premiumTypes)
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">{{$premiumTypes->name}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{$premiumTypes->price}} TL<small class="text-muted"> / @if($premiumTypes->type == "day")  {{$premiumTypes->the_period_of_validity}} günlük @elseif($premiumTypes->type == "month") @if($premiumTypes->the_period_of_validity == "1") aylık @else {{$premiumTypes->the_period_of_validity}}  aylık @endif @endif</small></h1>
                    <div class="list-unstyled mt-3 mb-4">
                        {!! $premiumTypes->features !!}
                    </div>
                    <form action="{{url("admin/premiums/status")}}" method="POST">
                        @csrf
                        <input type="hidden" name="change_id" value="{{$premiumTypes->id}}">
                        <input type="hidden" name="change_status" value="{{$premiumTypes->status}}">
                        <button type="submit" class="btn btn-lg btn-block btn-outline-@if($premiumTypes->status == "0")warning @elseif($premiumTypes->status == "1")success @endif">Paket durumunu değiştir (@if($premiumTypes->status == "0") Pasif @else Aktf @endif )</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
    <div class="alert alert-danger">Hiç paket bulunamadı.Lütfen Ekleyiniz.</div>
    @endif

@endsection
@section("js")
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
@endsection

