@extends('layouts.app')

@section('content')

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b>{{$data->id_transaksi}}</b></h4>
                    <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->mobil->foto) src="{{ asset('images/mobil/'.$data->mobil->foto) }}" @endif />
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('id_transaksi') ? ' has-error' : '' }}">
                            <label for="id_transaksi" class="col-md-4 control-label">ID Transaksi</label>
                            <div class="col-md-6">
                                <input id="id_transaksi" type="text" class="form-control" name="id_transaksi" value="{{$data->id_transaksi}}" required readonly="">
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tanggal_rental') ? ' has-error' : '' }}">
                            <label for="tanggal_rental" class="col-md-4 control-label">Tanggal Rental</label>
                            <div class="col-md-3">
                                <input id="tanggal_rental" type="date" class="form-control" name="tanggal_rental" value="{{ date('Y-m-d', strtotime($data->tanggal_rental)) }}" readonly="">
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('tanggal_kembali') ? ' has-error' : '' }}">
                            <label for="tanggal_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input id="tanggal_kembali" type="date"  class="form-control" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime($data->tanggal_kembali)) }}" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobil_id" class="col-md-4 control-label">Mobil</label>
                            <div class="col-md-6">
                                <input id="mobil_type" type="text" class="form-control" readonly="" value="{{$data->mobil->type}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customer_id" class="col-md-4 control-label">Perental</label>
                            <div class="col-md-6">
                                <input id="customer_nama" type="text" class="form-control" readonly="" value="{{$data->customer->nama}}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                @if($data->status == 'Rental')
                                  <label class="badge badge-warning">Rental</label>
                                @else
                                  <label class="badge badge-success">Kembali</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $data->keterangan }}" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pegawai_id" class="col-md-4 control-label">Pegawai</label>
                            <div class="col-md-6">
                                <input id="pegawai_nama" type="text" class="form-control" readonly="" value="{{$data->user}}">
                            </div>
                        </div>

                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>


@endsection