<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\Response;
use App\Livewire\MovieListPage;
use App\Livewire\MovieDetailPage;
use App\Livewire\SeatSelectionPage;
use App\Livewire\BookingSuccessPage;
use App\Livewire\BookingHistoryPage;
use App\Livewire\PaymentPage;
use App\Livewire\TicketPage;
use App\Livewire\ValidateTicketPage;
use App\Http\Controllers\TicketPdfController;

Route::get('/ticket/{booking}/pdf',[TicketPdfController::class, 'download'])->name('ticket.pdf');

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/msk', function () {
    return view('welcome');
});


Route::get('/', MovieListPage::class)->name('home');
Route::get('/movies/{movie:slug}',MovieDetailPage::class)->name('movies.show');
Route::get('/booking/{schedule}',SeatSelectionPage::class)->name('booking.seats');
Route::get('/booking-success/{booking}',BookingSuccessPage::class)->name('booking.success');
Route::get('/my-bookings',BookingHistoryPage::class)->name('bookings.index');
Route::get('/payment/{booking}',PaymentPage::class)->name('payment.show');
Route::get('/ticket/{booking}',TicketPage::class)->name('ticket.show');
Route::get('/ticket/validate/{token}',ValidateTicketPage::class)->name('ticket.validate');