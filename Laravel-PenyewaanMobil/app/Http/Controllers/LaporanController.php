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
use Excel;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
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

    public function mobil()
    {
        return view('laporan.mobil');
    }

    public function mobilPdf()
    {
        $datas = Mobil::all();
        $pdf = PDF::loadView('laporan.mobil_pdf', compact('datas'));
        return $pdf->download('laporan_mobil_'.date('Y-m-d_H-i-s').'.pdf');
    }

    public function mobilExcel(Request $request)
    {
        $nama = 'laporan_mobil_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Laporan Data Mobil', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:H1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('LAPORAN DATA MOBIL'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        $datas = Mobil::all();

       // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "TYPE", "BRAND", "WARNA", "NOMOR POLISI", "TAHUN KELUARAN", "STATUS", "HARGA SEWA");
         $i=1;

        foreach ($datas as $data) {

           // $sheet->appendrow($data);
          $datasheet[$i] = array($i,
                        $data['type'],
                        $data->brand->brand,
                        $data['warna'],
                        $data['nomor_polisi'],
                        $data['tahun_keluaran'],
                        $data['status'],
                        $data['harga_sewa']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

})->export('xls');
}

public function transaksi()
    {
        return view('laporan.transaksi');
    }

    public function transaksiPdf(Request $request)
    {
        $q = Transaksi::query();

        if($request->get('status')) 
        {
             if($request->get('status') == 'Rental') {
                $q->where('status', 'Rental');
            } else {
                $q->where('status', 'Kembali');
            }
        }

        $datas = $q->get();

       // return view('laporan.transaksi_pdf', compact('datas'));
       $pdf = PDF::loadView('laporan.transaksi_pdf', compact('datas'));
       return $pdf->download('laporan_transaksi_'.date('Y-m-d_H-i-s').'.pdf');
    }

public function transaksiExcel(Request $request)
    {
        $nama = 'laporan_transaksi_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Laporan Data Transaksi', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:H1');

       // $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('LAPORAN DATA TRANSAKSI'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Calibri');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

        $q = Transaksi::query();

        if($request->get('status')) 
        {
             if($request->get('status') == 'Rental') {
                $q->where('status', 'Rental');
            } else {
                $q->where('status', 'Kembali');
            }
        }

        $datas = $q->get();

        // $sheet->appendRow(array_keys($datas[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "ID TRANSAKSI", "CUSTOMER", "MOBIL", "TANGGAL RENTAL", "TANGGAL KEMBALI", "STATUS", "KETERANGAN");
         $i=1;

        foreach ($datas as $data) {

            // $sheet->appendrow($data);
            $datasheet[$i] = array($i,
                        $data['id_transaksi'],
                        $data->customer->nama,
                        $data->mobil->type,
                        date('d/m/y', strtotime($data['tanggal_rental'])),
                        date('d/m/y', strtotime($data['tanggal_kembali'])),
                        $data['status'],
                        $data['keterangan']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

})->export('xls');
}
}
