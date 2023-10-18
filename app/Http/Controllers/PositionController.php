<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function getposition($unitkerja_id) {
        $data = Position::where('unitkerja_id', $unitkerja_id)->get();

        return response()->json($data);
    }
}
