<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reconocimiento;
use App\Models\TipoReconocimiento;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{

    public function datosReconocimiento(){
        $data = Reconocimiento::select('tiporeconocimiento.nombretipo', DB::raw('COUNT(*) as total'))
        ->leftjoin('tiporeconocimiento','tiporeconocimiento.id','=','reconocimiento.tipoReconocimientoId')
        ->groupBy('nombretipo')
        ->get();

        return response()->json($data);
    }


    public function getUserRegistrationsByMonth() {
        $data = User::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        return response()->json($data);
    }

}
