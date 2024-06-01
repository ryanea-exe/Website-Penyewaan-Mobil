<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mobil;
use App\Customer;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datas = Transaksi::get();
        return view('transaksi.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        $mobils = Mobil::where('status', '=', 'Ada')->get();
        $customers = Customer::get();
        $users = User::get();
        return view('transaksi.create', compact('mobils', 'kode', 'customers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_transaksi' => 'required|string|max:255'
        ]);

        $transaksi = Transaksi::create([
                'id_transaksi' => $request->get('id_transaksi'),
                'tanggal_rental' => $request->get('tanggal_rental'),
                'tanggal_kembali' => $request->get('tanggal_kembali'),
                'mobil_id' => $request->get('mobil_id'),
                'customer_id' => $request->get('customer_id'),
                'keterangan' => $request->get('keterangan'),
                'status' => 'Rental',
                'pegawai_id' => $request->get('pegawai_id')
            ]);

        $transaksi->mobil->where('id', $transaksi->mobil_id)
                         ->update([
                            'status' => ($transaksi->mobil->status = 'Tidak Ada'),
                            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if((Auth::user()->level == 'user')) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }
        
        $data = Transaksi::findOrFail($id);

        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Transaksi::findOrFail($id);

        if((Auth::user()->level == 'user')) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        return view('mobil.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'Kembali'
                ]);

        $transaksi->mobil->where('id', $transaksi->mobil->id)
                        ->update([
                            'status' => ($transaksi->mobil->status = 'Ada'),
                            ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
