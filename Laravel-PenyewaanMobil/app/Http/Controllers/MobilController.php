<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brand;
use App\Mobil;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class MobilController extends Controller
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
        $datas = Mobil::get();
        return view('mobil.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $brands = Brand::get();
        $datas = Mobil::get();
        return view('mobil.create', compact('brands', 'datas'));
    }

    public function format()
    {
        $data = [['type' => null, 'brand_id' => null, 'warna' => null, 'nomor_polisi' => null, 'tahun_keluaran' => null, 'status' => null, 'harga_sewa' => null]];
            $fileName = 'format-mobil';

        $export = Excel::create($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
            $excel->sheet('mobil', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        });

        return $export->download('xlsx');
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
            'type' => 'required|string|max:50',
            'nomor_polisi' => 'required|string'
        ]);

        if($request->file('foto')) {
            $file = $request->file('foto');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto')->move("images/mobil", $fileName);
            $foto = $fileName;
        } else {
            $foto = NULL;
        }

        Mobil::create([
                'foto' => $foto,
                'type' => $request->get('type'),
                'brand_id' => $request->get('brand_id'),
                'warna' => $request->get('warna'),
                'nomor_polisi' => $request->get('nomor_polisi'),
                'tahun_keluaran' => $request->get('tahun_keluaran'),
                'status' => $request->get('status'),
                'harga_sewa' => $request->get('harga_sewa')
            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('mobil.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Mobil::findOrFail($id);
        return view('mobil.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(Auth::user()->level == 'user') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        $data = Mobil::findOrFail($id);
        $brands = Brand::get();
        return view('mobil.edit', compact('data', 'brands'));
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
        if($request->file('foto')) {
            $file = $request->file('foto');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto')->move("images/mobil", $fileName);
            $foto = $fileName;
        } else {
            $foto = NULL;
        }

        Mobil::find($id)->update([
                'foto' => $foto,
                'type' => $request->get('type'),
                'brand_id' => $request->get('brand_id'),
                'nomor_polisi' => $request->get('nomor_polisi'),
                'tahun_keluaran' => $request->get('tahun_keluaran'),
                'status' => $request->get('status'),
                'harga_sewa' => $request->get('harga_sewa')
                ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('mobil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mobil::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('mobil.index');
    }
}
