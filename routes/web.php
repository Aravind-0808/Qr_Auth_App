<?php

use App\Http\Controllers\generateQRCode;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifyStudent;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    // Get the authenticated user
    $user = auth()->user();

    // Generate QR code with user details
    $qrData = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ];
    $qrCode = QrCode::size(200)->generate(json_encode($qrData));

    // Pass the $user and $qrCode to the dashboard view
    
    return view('dashboard', compact('user', 'qrCode'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/generate-qr', [generateQRCode::class, 'generateQRCode'])
    ->middleware(['auth'])
    ->name('generate.qr');

    Route::post('/verify', [VerifyStudent::class, 'verifyStudent']);
    Route::get('/verify-student', [VerifyStudent::class, 'show'])->middleware(['auth', 'verified'])->name('verify.student');


require __DIR__.'/auth.php';
