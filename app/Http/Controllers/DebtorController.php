<?php

namespace App\Http\Controllers;

use App\Models\Debtors;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Maatwebsite\Excel\Facades\Excel;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('greenshoe.debtors.list');
    }

    public function listData(){

        $debtors = Debtors::with('detail')->get();
        return Datatables::of($debtors)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchView()
    {
        return view('greenshoe.debtors.search');
    }

    public function searchPost(Request $request){
        $keyword =  (integer) $request->input('keyword');

        $debtor = Debtors::with('detail')
                    ->where('mobile_number', '=', $keyword)
                    ->orwhere('national_id', '=', $keyword)
                    ->get();

        return view('greenshoe.debtors.search', ['debtors' => $debtor, 'keyword' => $keyword]);
    }

    public function export(Request $request){

        $debtors = Debtors::with('detail')->get();
        $type  = ($request->input('exportFormart') == 1 ? 'xls' : 'csv');
        Excel::create('debtors', function($excel) use ($debtors)
        {
            $excel->sheet('debtors', function($sheet) use ($debtors)
            {
                $companies = [];
                foreach ($debtors as $lead) {
                    $company = [];
                    $company['# id']= $lead->id;
                    $company['Mobile Number']= $lead->mobile_number;
                    $company['ID number']= $lead->national_id;
                    $company['Loan Amount']= $lead->detail->loan_amount;
                    $company['loan issue date']= $lead->detail->loan_issue_date;
                    $companies[] = $company;
                }
                $sheet->fromArray($companies);
            });
        })->download($type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
