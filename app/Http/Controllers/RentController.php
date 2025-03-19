<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentRequest;
use App\Models\Book;
use App\Models\Rent;
use App\Notifications\ReturnBookNotification;
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

    public function returnBook(Rent $rent, $notificationId = null)
    {
        if (isset($notificationId)) {
            $notification = Auth::user()->notifications()->find($notificationId);

            if ($notification) {
                $notification->delete();
            } else {
                return response('notification not found', 404);
            }
        }

        if(!isset($rent->id))
        {
            return response('book not found', 404);
        }

        $rent->delete();
        return redirect()->route('books.index');
    }
}
