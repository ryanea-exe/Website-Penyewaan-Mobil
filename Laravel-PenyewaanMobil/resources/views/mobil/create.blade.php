@section('js')

<script type="text/javascript">
$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
            $(document).on('click', '.pilih_brand', function (e) {
                document.getElementById("brand_brand").value = $(this).attr('data-brand_brand');
                document.getElementById("brand_id").value = $(this).attr('data-brand_id');
                $('#myModal').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
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

<form method="POST" action="{{ route('mobil.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Mobil Baru</h4>
                      
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>
                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}" required>
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
                                <div class="input-group">
                                <input id="brand_brand" type="text" class="form-control" readonly="" required>
                                <input id="brand_id" type="hidden" name="brand_id" value="{{ old('brand_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Brand</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
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
                                <input id="warna" type="text" class="form-control" name="warna" value="{{ old('warna') }}" required>
                                @if ($errors->has('warna'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('warna') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nomor_polisi') ? ' has-error' : '' }}">
                            <label for="nomor_polisi" class="col-md-4 control-label">Nomor Polisi</label>
                            <div class="col-md-6">
                                <input id="nomor_polisi" type="text" class="form-control" name="nomor_polisi" value="{{ old('nomor_polisi') }}" required>
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
                                <input id="tahun_keluaran" type="number" maxlength="4" class="form-control" name="tahun_keluaran" value="{{ old('tahun_keluaran') }}" required>
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
                            <select class="form-control" name="status" required="">
                                <option value="">- Pilih Status -</option>
                                <option value="Ada">Ada</option>
                                <option value="Tidak Ada">Tidak Ada</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('harga_sewa') ? ' has-error' : '' }}">
                            <label for="harga_sewa" class="col-md-4 control-label">Harga Sewa</label>
                            <div class="col-md-12">
                                <input id="harga_sewa" type="number" class="form-control" name="harga_sewa" value="{{ old('harga_sewa') }}" >
                                @if ($errors->has('harga_sewa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harga_sewa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto" class="col-md-4 control-label">Foto</label>
                            <div class="col-md-6">
                                <img width="200" height="200" />
                                <input id="foto" type="file" class="uploads form-control" style="margin-top: 20px;" name="foto">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="{{route('mobil.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Brand</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $data)
                                <tr class="pilih_brand" data-brand_id="<?php echo $data->id; ?>" data-brand_brand="<?php echo $data->brand; ?>" >
                                    <td>@if($data->logo)
                            <img src="{{url('images/brand/'. $data->logo)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/brand/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif
                          {{$data->brand}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>

@endsection