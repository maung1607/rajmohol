<?

use App\Http\Controllers\Backend\BookingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    /*Room Class*/
    Route::get('/booking/list', [BookingController::class, 'index'])->name('booking.index');
});
