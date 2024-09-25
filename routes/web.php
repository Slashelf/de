    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes(); 

Route::middleware('auth')->group(function () {
    Route::get('/home', [DocumentController::class, 'index'])->name('home');
    Route::get('/archivos', [DocumentController::class, 'index'])->name('archivos');    
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});





