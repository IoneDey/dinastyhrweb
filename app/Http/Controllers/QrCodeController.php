<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrCodeController extends Controller {
    public function processQrCode(Request $request) {
        $qrCodeData = $request->input('qrCodeData');

        // Lakukan apa pun yang ingin Anda lakukan dengan $qrCodeData di sini
        // Contoh: Simpan ke database, dll.

        return response()->json(['message' => 'Data QR Code berhasil diproses'], 200);
    }
}
