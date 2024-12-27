<?

use App\Http\Controllers\RoomClassController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/room-class/list', [RoomClassController::class, 'index'])->name('room.class.index');
    Route::post('/room-class/data-list', [RoomClassController::class, 'getData'])->name('room.class.data.list');
});
