<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasController extends Controller {
    //

    public function makan() {
        $qrCodeScanned = "";


        return view(
            'fasilitas.makan',
            ['qrCodeScanned' => $qrCodeScanned]
        );
    }
}
