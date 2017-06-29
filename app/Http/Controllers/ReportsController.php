<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;

class ReportsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $lava = new Lavacharts; // See note below for Laravel

        $p_apps_query = DB::select("
                SELECT plots.plot_number, COUNT(user_id) AS 'idadi'
                FROM applications 
                INNER JOIN plots ON (plots.id = applications.plot_id)
                GROUP BY plots.plot_number
                ORDER BY 'idadi' LIMIT 20");

        $p_apps  = $lava
            ->DataTable()
            ->addStringColumn('Plot Number')
            ->addNumberColumn('Application Frequency');

        foreach ($p_apps_query as $item) {
            $p_apps->addRow([$item->plot_number, $item->idadi]);
        }

        $lava->BarChart('Plots', $p_apps);



        $pieChartOptions = [
            'title'  => 'Distribution of Land usages',
            'height'=> 250,
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.2],
                ['offset' => 0.2],
                ['offset' => 0.2]
            ]
        ];

        /***-------------------------------------------------------------------------------------------*/
        $status_query = DB::select("SELECT statusinfo.name AS 'status', COUNT(plots.id) AS 'idadi'
                FROM plots 
                INNER JOIN statusinfo ON (plots.status_id = statusinfo.id)
                GROUP BY statusinfo.name");

        //status, idadi
        $statusChart  = $lava
            ->DataTable()
            ->addStringColumn('Status')
            ->addNumberColumn('Percent');

        foreach ($status_query as $item) {
            $statusChart->addRow([$item->status, $item->idadi]);
        }

        $lava->PieChart('StatusPie', $statusChart, $pieChartOptions);


        /***-------------------------------------------------------------------------------------------*/
        //$lava = new Lavacharts; // See note below for Laravel
        $usageQuery = DB::select("SELECT land_usage.name AS 'usage', COUNT(plots.id) AS 'idadi'
                FROM plots 
                INNER JOIN land_usage ON (plots.usage_id = land_usage.id)
                GROUP BY land_usage.name");

        //status, idadi
        $usageChart  = $lava
            ->DataTable()
            ->addStringColumn('Usage')
            ->addNumberColumn('Percent');

        foreach ($usageQuery as $item) {
            $usageChart->addRow([$item->usage, $item->idadi]);
        }

        $lava->PieChart('UsagePie', $usageChart, $pieChartOptions);

        //dd(0);

        return view('reports')->with('lava', $lava);
    }



}
