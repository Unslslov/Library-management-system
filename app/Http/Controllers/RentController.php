<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Book;
use App\Models\Rent;
use App\Notifications\ReturnBookNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class RentController extends Controller
{
    public function index()
    {
        $rents = Rent::all();
        return view('rent.index', compact('rents'));
    }

    public function show(Rent $rent)
    {
        return view('rent.show', compact('rent'));
    }

    public function create(Book $book)
    {
        return view('rent.create', compact('book'));
    }

    public function store(StoreRentRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['rent_date'] = now();

        Rent::create($data);
        return redirect()->route('books.index');
    }

    public function edit(Rent $rent)
    {
        $book = Book::find($rent->book_id);

        return view('rent.edit', compact('rent', 'book'));
    }

    public function update(UpdateRentRequest $request, Rent $rent)
    {
        $data = $request->validated();

        $rent->update($data);

        return redirect()->route('rents.index');
    }

    public function returnBook(Rent $rent)
    {
        if(!isset($rent->id))
        {
            return response('book not found', 404);
        }

        $rent->return_date = now();

        $rent->save();

        return redirect()->route('books.index');
    }

    public function redirectToRentBook(Rent $rent, $notificationId)
    {
        if (isset($notificationId)) {
            $notification = Auth::user()->notifications()->find($notificationId);

            if ($notification) {
                $notification->delete();
            } else {
                return response('notification not found', 404);
            }
        }

        return redirect()->route('rents.edit', compact('rent'));
    }
}
