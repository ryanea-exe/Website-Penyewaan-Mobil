@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('customer.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Customer</a>
  </div>
    <div class="col-lg-12">
                  @if (Session::has('message'))
                  <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                  @endif
                  </div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title pull-left">Data Customer</h4>
                  <a href="{{url('format_customer')}}" class="btn btn-xs btn-info pull-right">Format Customer</a>
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>
                            Nama
                          </th>
                          <th>
                            NIK
                          </th>
                          <th>
                            Jenis Kelamin
                          </th>
                          <th>
                            Alamat
                          </th>
                          <th>
                            No HP
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                          @if($data->foto_ktp)
                            <img src="{{url('images/customer', $data->foto_ktp)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/customer/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif
                          <a href="{{route('customer.show', $data->id)}}">
                            {{$data->nama}}
                          </td>
                          <td>
                            {{$data->nik}}
                          </a>
                          </td>
                          <td>
                            {{$data->jenis_kelamin}}
                          </td>
                          <td>
                            {{$data->alamat}}
                          </td>
                          <td>
                            {{$data->no_hp}}
                          </td>
                          <td>
                           <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{route('customer.edit', $data->id)}}"> Edit </a>
                            <form action="{{ route('customer.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                            </button>
                          </form>
                           
                          </div>
                        </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
               {{--  {!! $datas->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection