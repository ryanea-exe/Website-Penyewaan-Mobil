<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
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
        $datas = Customer::get();
        return view('customer.index', compact('datas'));
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

        return view('customer.create');
    }

    public function format()
    {
        $data = [['nik' => null, 'nama' => null, 'jenis_kelamin' => null, 'alamat' => null, 'no_hp' => null]];
            $fileName = 'format-customer';

        $export = Excel::create($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
            $excel->sheet('customer', function($sheet) use($data) {
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
            'nama' => 'required|string|max:100'
        ]);

        if($request->file('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto_ktp')->move("images/customer", $fileName);
            $foto_ktp = $fileName;
        } else {
            $foto_ktp = NULL;
        }

        Customer::create([
                'foto_ktp' => $foto_ktp,
                'nik' => $request->get('nik'),
                'nama' => $request->get('nama'),
                'jenis_kelamin' => $request->get('jenis_kelamin'),
                'alamat' => $request->get('alamat'),
                'no_hp' => $request->get('no_hp')
            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Customer::findOrFail($id);
        return view('customer.show', compact('data'));
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

        $data = Customer::findOrFail($id);
        return view('customer.edit', compact('data'));
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
        if($request->file('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('foto_ktp')->move("images/customer", $fileName);
            $foto_ktp = $fileName;
        } else {
            $foto_ktp = NULL;
        }

        Customer::find($id)->update([
                'foto_ktp' => $foto_ktp,
                'nik' => $request->get('nik'),
                'nama' => $request->get('nama'),
                'jenis_kelamin' => $request->get('jenis_kelamin'),
                'alamat' => $request->get('alamat'),
                'no_hp' => $request->get('no_hp')
                ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('customer.index');
    }
}
