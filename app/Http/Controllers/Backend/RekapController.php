<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Model\PurchaseH;
use App\Model\PenjualanH;
use App\Model\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;

class RekapController extends Controller
{
    //
    public function index_penerimaan()
    {
        //
        $list_unit = DB::select("
                        select 
                        id_unit as value, 
                        nama_unit as text
                        from unit");
        return view('backend.rekapan.penerimaan_index', compact('list_unit'));
    }

    public function penerimaan_view($id_unit, $bulan){
        
        $bulan_select = $bulan;
        $unit_select = $id_unit;
        
        $data_minuman  = DB::select("SELECT sum(penerimaan) as total FROM rekapan WHERE 
                            id_kategori = 1 AND 
                            id_unit = $id_unit AND
                            bulan = $bulan");

        $data_alat_tulis  = DB::select("SELECT sum(penerimaan) as total FROM rekapan WHERE 
                            id_kategori = 2 AND 
                            id_unit = $id_unit AND
                            bulan = $bulan");

        $data_seragam  = DB::select("SELECT sum(penerimaan) as total FROM rekapan WHERE 
                            id_kategori = 3 AND 
                            id_unit = $id_unit AND
                            bulan = $bulan");
        
        $data_umkm = DB::select("SELECT sum(bagi_hasil) as total FROM keep_h WHERE 
                            id_unit = $id_unit AND
                            substr(created_at, 6, 2 ) = $bulan");

        $sql_minuman = "SELECT sum(penerimaan) as total FROM rekapan WHERE id_kategori = 1 AND id_unit = $id_unit AND bulan = $bulan";
        $tot_minuman = DB::table(DB::raw("($sql_minuman) as x"))->select(['total'])->pluck('total')[0];
        $sql_peralatan= "SELECT sum(penerimaan) as total FROM rekapan WHERE id_kategori = 2 AND id_unit = $id_unit AND bulan = $bulan";
        $tot_peralatan = DB::table(DB::raw("($sql_peralatan) as x"))->select(['total'])->pluck('total')[0];
        $sql_seragam = "SELECT sum(penerimaan) as total FROM rekapan WHERE id_kategori = 3 AND id_unit = $id_unit AND bulan = $bulan";
        $tot_seragam = DB::table(DB::raw("($sql_seragam) as x"))->select(['total'])->pluck('total')[0];
        $sql_umkm= "SELECT sum(bagi_hasil) as total FROM keep_h WHERE id_unit = $id_unit AND substr(created_at, 6, 2 ) = $bulan";
        $tot_umkm = DB::table(DB::raw("($sql_umkm) as x"))->select(['total'])->pluck('total')[0]; 

        $grand_total = 0;
        if (isset($tot_minuman) || isset($tot_seragam) || isset($tot_seragam) || isset($tot_umkm) ){
            $grand_total = $tot_minuman  + $tot_seragam + $tot_seragam + $tot_umkm ;
        } 
        
        return view('backend.rekapan.penerimaan_view', compact(['data_minuman','data_alat_tulis','data_seragam','data_umkm','grand_total']));
    }

    public function index_pengeluaran()
    {
        //
        $list_unit = DB::select("
                        select 
                        id_unit as value, 
                        nama_unit as text
                        from unit");
        return view('backend.rekapan.pengeluaran_index', compact('list_unit'));
    }

    public function pengeluaran_view($id_unit, $bulan){
        
        $bulan_select = $bulan;
        $unit_select = $id_unit;
       /*  $data  = DB::select("SELECT
                    b.id,
                    b.kode,
                    b.nama,
                    sum(p.jumlah) as jumlah,
                    p.harga,
                    ( sum(p.jumlah) * p.harga ) AS total 
                FROM
                    penjualan_d AS p
                    LEFT JOIN penjualan_h AS h ON p.id_penjualan = h.id
                    LEFT JOIN barang AS b ON b.id = p.id_barang
                    LEFT JOIN kategori_barang AS k ON k.id_kategori = b.id_kategori 
                WHERE
                    b.id_kategori = $id_kategori
                    AND h.id_unit = $id_unit 
                    AND h.active != 0 
                    AND substr( p.created_at, 6, 2 ) = $bulan_select
                GROUP BY b.id,b.kode,b.nama,p.harga"); */
        $data_test = "dsadasdsa";
        return view('backend.rekapan.pengeluaran_view', compact('data_test'));
    }

    public function sinkron_data(){
        // kosongkan tabel rekapan
        // inset into dengan select
		//$data = new Rekapan();
        $data = "INSERT INTO rekapan ( id, kode, nama, id_kategori, jumlah, penjualan, modal, penerimaan, bulan, id_unit ) SELECT
                    b.id,
                    b.kode,
                    b.nama,
                    b.id_kategori,
                    sum( p.jumlah ) AS jumlah,
                    sum( p.jumlah ) * p.harga AS penjualan,
                    sum( p.jumlah ) * b.harga_beli AS modal,
                    ( sum( p.jumlah ) * p.harga ) - ( sum( p.jumlah ) * b.harga_beli ) AS penerimaan,
                    substr( p.created_at, 6, 2 ) AS bulan,
                    h.id_unit 
                FROM
                    penjualan_d AS p
                    LEFT JOIN penjualan_h AS h ON p.id_penjualan = h.id
                    LEFT JOIN barang AS b ON b.id = p.id_barang
                    LEFT JOIN kategori_barang AS k ON k.id_kategori = b.id_kategori 
                WHERE
                    h.active != 0 
                GROUP BY
                    b.id,
                    b.kode,
                    b.nama";
       
        if($data->save()){
            return Redirect::to('/backend/rekap-penerimaan')->with('success', "Data sinkron successfully")->with('mode', 'success');
        }
    }

}
