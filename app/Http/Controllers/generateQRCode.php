<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class generateQRCode extends Controller
{
    public function generateQRCode(Request $request)
    {
        $user = auth()->user(); // Get the logged-in user

        if (!$user) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        // Prepare user data for QR code
        $qrData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        // Generate QR code
        $qrCode = QrCode::size(200)->generate(json_encode($qrData));

        return view('student.qr-code', compact('qrCode', 'user'));
    }
}
