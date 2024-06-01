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
    <a href="{{ route('mobil.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Mobil</a>
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
                  <h4 class="card-title pull-left">Data Mobil</h4>
                  <a href="{{url('format_mobil')}}" class="btn btn-xs btn-info pull-right">Format Mobil</a>
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>
                            Type
                          </th>
                          <th>
                            Brand
                          </th>
                          <th>
                            Warna
                          </th>
                          <th>
                            Nomor Polisi
                          </th>
                          <th>
                            Tahun Keluaran
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Harga Sewa
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
                          @if($data->foto)
                            <img src="{{url('images/mobil', $data->foto)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/mobil/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif
                            <a href="{{route('mobil.show', $data->id)}}">
                            {{$data->type}}
                          </td>
                          <td>
                            {{$data->brand->brand}}
                          </td>
                          <td>
                            {{$data->warna}}
                          </td>
                          <td>
                            {{$data->nomor_polisi}}
                          </td>
                          <td>
                            {{$data->tahun_keluaran}}
                          </td>
                          <td>
                          @if($data->status == 'Ada')
                            <label class="badge badge-success">Ada</label>
                          @else
                            <label class="badge badge-warning">Tidak Ada</label>
                          @endif
                          </td>
                          <td>
                            {{$data->harga_sewa}}
                          </td>
                          <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{route('mobil.edit', $data->id)}}"> Edit </a>
                            <form action="{{ route('mobil.destroy', $data->id) }}" class="pull-left"  method="post">
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