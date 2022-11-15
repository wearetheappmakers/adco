<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockChild;
use App\Category;
use DataTables;
use Auth;


class InventoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            if(Auth::user()->role == 1){
            $query = StockChild::with('stocks','stocks.products','stocks.categorys','stocks.users')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
            $query = StockChild::where('user_id',Auth::user()->id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 3){
            $query = StockChild::where('user_id',Auth::user()->branch_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->orderBy('id','DESC')->latest();
            } 
            return Datatables::of($query)

            ->editColumn('used',function($row){
                if($row->used == 1)
                return 'Yes';
                else
                    return 'No';
            })


            ->rawColumns(['category','used'])
            ->make(true);
        }
        return view('inventory.index');
    }
}
