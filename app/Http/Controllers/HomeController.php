<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Str;
use Session;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tableTbody = [];
        $tempData = [];
        $tableThead    = [];
        $orders = Order::where("number", "LIKE", "%".auth()->id())->get()->groupBy('status');

        // grouping data by date
        foreach ($orders as $status => $collection) {
            $tempData[$status] = $orders[$status]->groupBy(function ($d) {
                return Carbon::parse($d['date'])->format("Y-m-d");
            });
        }

        // count grouped data by date for each date
        foreach ($tempData as $status => $collection) {
            foreach ($collection as $date => $rows) {
                $tableThead[] = $date;
                $tableTbody[$status][$date] = count($rows);
            }
        }

        return view("home", [
            "tableThead" => array_unique($tableThead),
            "tableTbody" => ($tableTbody),
        ]);
    }

    public function generateOrders()
    {
        try {
            DB::beginTransaction();
            Order::truncate();
            for ($i=0; $i < 20; $i++) {
                Order::create([
                    "name"   => Str::random("10"),
                    "status" => Order::STATUS_TYPES[rand(0, 4)],
                    "date"   => Carbon::today()->subDays(rand(0, 4))->format("Y-m-d"),
                ]);
            }
            Session::flash("status", "order created");
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash("status", $e->getMessage());
        }
        return redirect()->route("home");
    }
}
