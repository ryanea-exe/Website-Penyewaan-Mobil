@section('js')
 <script type="text/javascript">
   $(document).on('click', '.pilih_mobil', function (e) {
                document.getElementById("mobil_type").value = $(this).attr('data-mobil_type');
                document.getElementById("mobil_id").value = $(this).attr('data-mobil_id');
                $('#myModal').modal('hide');
            });

            $(document).on('click', '.pilih_customer', function (e) {
                document.getElementById("customer_id").value = $(this).attr('data-customer_id');
                document.getElementById("customer_nama").value = $(this).attr('data-customer_nama');
                $('#myModal2').modal('hide');
            });

            $(document).on('click', '.pilih_pegawai', function (e) {
                document.getElementById("pegawai_id").value = $(this).attr('data-pegawai_id');
                document.getElementById("pegawai_nama").value = $(this).attr('data-pegawai_nama');
                $('#myModal3').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });

        </script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Transaksi Baru</h4>
                    
                        <div class="form-group{{ $errors->has('id_transaksi') ? ' has-error' : '' }}">
                            <label for="id_transaksi" class="col-md-4 control-label">ID Transaksi</label>
                            <div class="col-md-6">
                                <input id="id_transaksi" type="text" class="form-control" name="id_transaksi" value="{{ $kode }}" required readonly="">
                                @if ($errors->has('id_transaksi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_transaksi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tanggal_rental') ? ' has-error' : '' }}">
                            <label for="tanggal_rental" class="col-md-4 control-label">Tanggal Rental</label>
                            <div class="col-md-3">
                                <input id="tgl_rental" type="date" class="form-control" name="tanggal_rental" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required @if(Auth::user()->level == 'user') readonly @endif>
                                @if ($errors->has('tanggal_rental'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_rental') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tanggal_kembali') ? ' has-error' : '' }}">
                            <label for="tanggal_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input id="tanggal_kembali" type="date"  class="form-control" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) }}" required="" @if(Auth::user()->level == 'user') readonly @endif>
                                @if ($errors->has('tanggal_kembali'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_kembali') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobil_id') ? ' has-error' : '' }}">
                            <label for="mobil_id" class="col-md-4 control-label">Mobil</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="mobil_type" type="text" class="form-control" readonly="" required>
                                <input id="mobil_id" type="hidden" name="mobil_id" value="{{ old('mobil_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Mobil</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                @if ($errors->has('mobil_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobil_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
                            <label for="customer_id" class="col-md-4 control-label">Customer</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="customer_nama" type="text" class="form-control" readonly="" required>
                                <input id="customer_id" type="hidden" name="customer_id" value="{{ old('customer_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Customer</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                @if ($errors->has('customer_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}">
                                @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
                            <label for="pegawai_id" class="col-md-4 control-label">Pegawai</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="pegawai_nama" type="text" class="form-control" readonly="" required>
                                <input id="pegawai_id" type="hidden" name="pegawai_id" value="{{ old('pegawai_id') }}" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-secondary" data-toggle="modal" data-target="#myModal3"><b>Cari Pegawai</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                @if ($errors->has('pegawai_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pegawai_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right">Back</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Cari Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Brand</th>
                                    <th>Warna</th>
                                    <th>Tahun Keluaran</th>
                                    <th>Status</th>
                                    <th>Harga Sewa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mobils as $data)
                                <tr class="pilih_mobil" data-mobil_id="<?php echo $data->id; ?>" data-mobil_type="<?php echo $data->type; ?>" >
                                    <td>
                                    @if($data->foto)
                                      <img src="{{url('images/mobil/'. $data->foto)}}" alt="image" style="margin-right: 10px;" />
                                    @else
                                      <img src="{{url('images/mobil/default.png')}}" alt="image" style="margin-right: 10px;" />
                                    @endif
                                      {{$data->type}}
                                    </td>
                                    <td>{{$data->brand->brand}}</td>
                                    <td>{{$data->warna}}</td>
                                    <td>{{$data->tahun_keluaran}}</td>
                                    <td>
                                    @if($data->status == 'Ada')
                                      <label class="badge badge-success">Ada</label>
                                    @else
                                      <label class="badge badge-warning">Tidak Ada</label>
                                    @endif
                                    </td>
                                    <td>{{$data->harga_sewa}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>

<!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <table id="lookup" class="table table-bordered table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>NIK</th>
                          <th>Jenis Kelamin</th>
                          <th>Alamat</th>
                          <th>No HP</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($customers as $data)
                        <tr class="pilih_customer" data-customer_id="<?php echo $data->id; ?>" data-customer_nama="<?php echo $data->nama; ?>" >
                          <td>{{$data->nama}}</td>
                          <td>{{$data->nik}}</td>
                          <td>{{$data->jenis_kelamin}}</td>
                          <td>{{$data->alamat}}</td>
                          <td>{{$data->no_hp}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>  
                  </div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $data)
                                <tr class="pilih_pegawai" data-pegawai_id="<?php echo $data->id; ?>" data-pegawai_nama="<?php echo $data->nama; ?>" >
                                    <td>
                                    @if($data->foto)
                                      <img src="{{url('images/user/'. $data->foto)}}" alt="image" style="margin-right: 10px;" />
                                    @else
                                      <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                                    @endif
                                      {{$data->nama}}
                                    </td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->level}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>

@endsection