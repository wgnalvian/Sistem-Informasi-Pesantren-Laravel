<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserFinance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;

class FinanceController extends Controller
{

    public function index()
    {
        $income = Finance::where(['user_id' => Auth::id()])->sum('amount_income');
        $expenditure = Finance::where(['user_id' => Auth::id()])->sum('amount_expenditure');
        $total = $income - $expenditure;
        $data = Finance::where(['user_id' => Auth::id()])->get();
        $dummy = Finance::all();
        $tahun = [];
        foreach ($dummy as $item) {
            $fraction =  explode("-", $item->finance_date);
            array_push($tahun, (int) $fraction[0]);
        }




        return view('finance-data', ['title' => 'Data Keuangan', 'data' => $data, 'income' => $income, 'expenditure' => $expenditure, 'total' => $total, 'maxTahun' => $tahun ? max($tahun) : 0, 'minTahun' => $tahun ? min($tahun) : 0]);
    }

    public function inputIncome()
    {

        return view('input-pemasukan', ['title' => 'Pemasukan']);
    }

    public function handleInputIncome(Request $request)
    {



        $request->validate([
            'sumber_pemasukan' => "required",
            'deskripsi_pemasukan' => 'required',
            'jumlah_pemasukan' => "required|numeric",
            'tanggal_pemasukan' => 'required|date'
        ]);

        Finance::create([
            'user_id' => Auth::id(),
            'finance_category' => $request->input('pemasukan_kategori'),
            'finance_date' => $request->input('tanggal_pemasukan'),
            'finance_source' => $request->input('sumber_pemasukan'),
            'finance_description' => $request->input('deskripsi_pemasukan'),
            'amount_income' => $request->input('amount_income'),
            'amount_income' => str_replace('.', '', $request->input('jumlah_pemasukan')),
            'amount_expenditure' => '0'
        ]);



        Alert::success('Data Pemasukan Berhasil Disimpan', '');
        return redirect()->back();
    }

    public function inputExpenditure()
    {

        return view('input-pengeluaran', ['title' => 'Pengeluaran']);
    }

    public function handleInputExpenditure(Request $request)
    {


        $request->validate([
            'sumber_pengeluaran' => "required",
            'deskripsi_pengeluaran' => 'required',
            'jumlah_pengeluaran' => "required|numeric",
            'tanggal_pengeluaran' => 'required|date'
        ]);

        Finance::create([
            'user_id' => Auth::id(),
            'finance_category' => $request->input('pengeluaran_kategori'),
            'finance_date' => $request->input('tanggal_pengeluaran'),
            'finance_source' => $request->input('sumber_pengeluaran'),
            'finance_description' => $request->input('deskripsi_pengeluaran'),
            'amount_income' => $request->input('amount_income'),
            'amount_expenditure' => str_replace('.', '', $request->input('jumlah_pengeluaran')),
            'amount_income' => '0'
        ]);



        Alert::success('Data Pengeluaran Berhasil Disimpan', '');
        return redirect()->back();
    }

    public function deleteFinance(Request $request, $id)
    {

        Finance::where(['finance_id' => $id])->delete();

        Alert::success('Data successfully deleted', '');
        return redirect()->back();
    }

    public function updateFinance($id)
    {

        $data = Finance::find($id);

        if ($data->finance_category === 'pemasukan') {

            return view('update-finance-income', ['data' => $data, 'title' => 'Edit Pemasukan']);
        }

        return view('update-finance-expenditure', ['data' => $data, 'title' => 'Edit Pengeluaran']);
    }

    public function handleUpdateIncome(Request $request, $id)
    {


        $request->validate([
            'sumber_pemasukan' => "required",
            'deskripsi_pemasukan' => 'required',
            'jumlah_pemasukan' => "required|numeric",
            'tanggal_pemasukan' => 'required|date'
        ]);

        DB::table('finance')->where('finance_id', $id)->update([
            'user_id' => Auth::id(),
            'finance_category' => $request->input('pemasukan_kategori'),
            'finance_date' => $request->input('tanggal_pemasukan'),
            'finance_source' => $request->input('sumber_pemasukan'),
            'finance_description' => $request->input('deskripsi_pemasukan'),
            'amount_income' => $request->input('amount_income'),
            'amount_income' => str_replace('.', '', $request->input('jumlah_pemasukan')),
            'amount_expenditure' => '0'
        ]);

        Alert::success('Data Pemasukan Berhasil Diupdate', '');
        return redirect()->back();
    }

    public function handleUpdateExpenditure(Request $request, $id)
    {

        $request->validate([
            'sumber_pengeluaran' => "required",
            'deskripsi_pengeluaran' => 'required',
            'jumlah_pengeluaran' => "required|numeric",
            'tanggal_pengeluaran' => 'required|date'
        ]);

        DB::table('finance')->where('finance_id', $id)->update([
            'user_id' => Auth::id(),
            'finance_category' => $request->input('pengeluaran_kategori'),
            'finance_date' => $request->input('tanggal_pengeluaran'),
            'finance_source' => $request->input('sumber_pengeluaran'),
            'finance_description' => $request->input('deskripsi_pengeluaran'),
            'amount_income' => $request->input('amount_income'),
            'amount_expenditure' => str_replace('.', '', $request->input('jumlah_pengeluaran')),
            'amount_income' => '0'
        ]);

        Alert::success('Data Pengeluaran Berhasil Diupdate', '');
        return redirect()->back();
    }

    public function handleFinanceSearch(Request $request)
    {   
      
       
        $dummy = Finance::where(['user_id' => Auth::id()])->get();
       
        

        $dataTahun = [];
        $data = [];
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $income = 0;
        $expenditure = 0;
        if ($request->tahun && $request->bulan) {

            foreach ($dummy as $item) {

                $fraction = explode('-', $item->finance_date);
                array_push($dataTahun, (int) $fraction[0]);
                if ($request->tahun === $fraction[0] && $request->bulan === $fraction[1]) {
                    $income += (int) $item->amount_income;
                    $expenditure += (int) $item->amount_expenditure;
                    array_push($data, $item);   
                   
                        
                       
                    
                }
            }
        } else if ($request->bulan) {

            foreach ($dummy as $item) {

                $fraction =  explode("-", $item->finance_date);
                array_push($dataTahun, (int) $fraction[0]);
                if ($request->bulan === $fraction[1]) {
                    $income += (int) $item->amount_income;
                    $expenditure += (int) $item->amount_expenditure;
                    array_push($data, $item);
                }
            }
        } else if ($request->tahun) {

            foreach ($dummy as $item) {

                $fraction =  explode("-", $item->finance_date);
                array_push($dataTahun, (int) $fraction[0]);
                if ($request->tahun === $fraction[0]) {
                    $income += (int) $item->amount_income;
                    $expenditure += (int) $item->amount_expenditure;
                    array_push($data, $item);
                }
            }
        } else {
            return redirect()->to('/finance-data');
        }


        $total = $income - $expenditure;
        
        return view('finance-data-search', ['title' => 'Data Keuangan', 'data' => $data, 'income' => $income, 'expenditure' => $expenditure, 'total' => $total, 'tahun' => $tahun, 'bulan' => $bulan, 'minTahun' => count($dataTahun) === 0 ? 0 : min($dataTahun), 'maxTahun' => count($dataTahun) === 0 ? 0 : max($dataTahun)]);
    }

    public function handleFinancePdf(Request $request)
    {
        $profile = Profile::find(Auth::id());
       
        if ($request->tahun && $request->bulan) {
            $dummy = Finance::all();
            $data = [];
            $income = 0;
            $expenditure = 0;
            $total = 0;
            foreach ($dummy as $item) {

                $fraction = explode('-', $item->finance_date);
                if ($request->tahun === $fraction[0] && $request->bulan === $fraction[1]) {
                    $income += (int) $item->amount_income;
                    $expenditure += (int) $item->amount_expenditure;
                    array_push($data, $item);
                }
            }
            $total = $income - $expenditure;
            $pdf = PDF::loadView('finance-print', ['data' =>  $data, 'income' => $income, 'expenditure' => $expenditure, 'total' => $total, 'school_name' => $profile->school_name, 'school_address' => $profile->school_address, 'school_image' => $profile->school_image]);

            return $pdf->download('data-keuangan');
        } else if ($request->bulan) {
            $dummy = Finance::all();
            $data = [];
            $income = 0;
            $expenditure = 0;
            $total = 0;
            foreach ($dummy as $item) {

                $fraction =  explode("-", $item->finance_date);
                if ($request->bulan === $fraction[1]) {
                    $income += (int) $item->amount_income;
                    $expenditure += (int) $item->amount_expenditure;
                    array_push($data, $item);
                }
            }
            $total = $income - $expenditure;
            $pdf = PDF::loadView('finance-print', ['data' =>  $data, 'income' => $income, 'expenditure' => $expenditure, 'total' => $total,'school_name' => $profile->school_name, 'school_address' => $profile->school_address, 'school_image' => $profile->school_image]);

            return $pdf->download('data-keuangan');
        } else if ($request->tahun) {
            $dummy = Finance::all();
            $data = [];
            $income = 0;
            $expenditure = 0;
            $total = 0;
            foreach ($dummy as $item) {

                $fraction =  explode("-", $item->finance_date);
                if ($request->tahun === $fraction[0]) {
                    $income += (int) $item->amount_income;
                    $expenditure += (int) $item->amount_expenditure;
                    array_push($data, $item);
                }
            }
            $total = $income - $expenditure;
            $pdf = PDF::loadView('finance-print', ['data' =>  $data, 'income' => $income, 'expenditure' => $expenditure, 'total' => $total,'school_name' => $profile->school_name, 'school_address' => $profile->school_address, 'school_image' => $profile->school_image]);

            return $pdf->download('data-keuangan');
        }else {

            $income = Finance::where(['user_id' => Auth::id()])->sum('amount_income');
            $expenditure = Finance::where(['user_id' => Auth::id()])->sum('amount_expenditure');
            $total = (int) $income - (int) $expenditure;
            $data = Finance::where(['user_id' => Auth::id()])->get();

            $pdf = PDF::loadView('finance-print', ['data' =>  $data, 'income' => $income, 'expenditure' => $expenditure, 'total' => $total,'school_name' => $profile->school_name, 'school_address' => $profile->school_address, 'school_image' => $profile->school_image]);

            return $pdf->download('data-keuangan');
        }
    }
}
