<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;
use App\Models\Item;
use App\Models\Contract;

// Default route
Route::get('/', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

//Shows all owned items
Route::get('/own-items', [ItemController::class, 'ownerItems'])->middleware(['auth', 'verified'])->name('ownItems');

//Shows all borrowed items
Route::get('/borrowed-items', [ItemController::class, 'borrowedItems'])->middleware(['auth', 'verified'])->name('borrowedItems');

// //Shows all pending requests
Route::get('/pending-requests', [ItemController::class, 'pendingRequests'])->middleware(['auth', 'verified'])->name('pendingRequests');


// Items routes
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

//Shows singular item
Route::get('/items/{item}', function (Item $item){

    return view('show', [
        'item' => $item
    ]);

})->name('items.show');

//Shows singular requested item
Route::get('/pending-requests/{item}', function (Item $item, Contract $contract){

    $contract = Contract::where('item_id', $item->id)->first();

    return view('showRequest', [
        'item' => $item,
        'contract' => $contract
    ]);

})->name('items.requested');

//Shows singular owned item
Route::get('/own-items/{item}', function (Item $item){

    return view('showOwn', [
        'item' => $item
    ]);

})->name('items.own');

//Shows singular borrowed item
Route::get('/borrowed-items/{item}', function (Item $item) {
    $contract = Contract::where('item_id', $item->id)->first();
    return view('showBorrowed', [
        'item' => $item,
        'contract' => $contract
    ]);
})->name('items.borrowed');

// Contracts routes
Route::get('/items/{item}/borrow', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/items/{item}/borrow', [ContractController::class, 'store'])->name('contracts.store');
Route::post('/contracts/{contract}/accept', [ContractController::class, 'accept'])->name('contracts.accept');
Route::post('/contracts/{contract}/reject', [ContractController::class, 'reject'])->name('contracts.reject');
Route::post('/contracts/{contract}/return', [ContractController::class, 'return'])->name('contracts.return');

// Reviews routes
Route::get('/users/{user}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/users/{user}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/users/{user}/reviews', [ReviewController::class, 'show'])->name('reviews.show');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::fallback(function(){
    return 'Page not found';
});

