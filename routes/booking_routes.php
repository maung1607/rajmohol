<?

use App\Http\Controllers\Backend\BookingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    /*Room Class*/
    Route::get('/booking/list', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/getData', [BookingController::class, 'getData'])->name('booking.get.data');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
});
