@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b>{{$data->type}}</b> </h4>
                      <form class="forms-sample">

                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->foto) src="{{ asset('images/mobil/'.$data->foto) }}" @endif />
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>
                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ $data->type }}" readonly="">
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
                            <label for="brand_id" class="col-md-4 control-label">Brand</label>
                            <div class="col-md-6">
                                <input id="brand_id" type="text" class="form-control" name="brand_id" value="{{ $data->brand->brand }}" readonly>
                                @if ($errors->has('brand_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('brand_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('warna') ? ' has-error' : '' }}">
                            <label for="warna" class="col-md-4 control-label">Warna</label>
                            <div class="col-md-6">
                                <input id="warna" type="text" class="form-control" name="warna" value="{{ $data->warna }}" readonly>
                                @if ($errors->has('warna'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('warna') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nomor_polisi') ? ' has-error' : '' }}">
                            <label for="nomor_polisi" class="col-md-4 control-label">Nomor polisi</label>
                            <div class="col-md-6">
                                <input id="nomor_polisi" type="text" class="form-control" name="nomor_polisi" value="{{ $data->nomor_polisi }}" readonly>
                                @if ($errors->has('nomor_polisi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nomor_polisi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tahun_keluaran') ? ' has-error' : '' }}">
                            <label for="tahun_keluaran" class="col-md-4 control-label">Tahun Keluaran</label>
                            <div class="col-md-6">
                                <input id="tahun_keluaran" type="number" maxlength="4" class="form-control" name="tahun_keluaran" value="{{ $data->tahun_keluaran }}" readonly>
                                @if ($errors->has('tahun_keluaran'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tahun_keluaran') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control" name="status" value="{{ $data->status }}" readonly>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('harga_sewa') ? ' has-error' : '' }}">
                            <label for="harga_sewa" class="col-md-4 control-label">Harga Sewa</label>
                            <div class="col-md-6">
                                <input id="harga_sewa" type="number" class="form-control" name="harga_sewa" value="{{ $data->harga_sewa }}" readonly="">
                                @if ($errors->has('harga_sewa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harga_sewa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <a href="{{route('mobil.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
@endsection