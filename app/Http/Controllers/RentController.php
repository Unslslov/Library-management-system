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

    public function create(Book $book)
    {
        return view('rent.create', compact('book'));
    }

    /**
     * @OA\Post(
     *     path="/api/rents",
     *     summary="Store a newly created rental in storage",
     *     tags={"Rentals"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RentStoreRequestSchema")
     *     ),
     *     @OA\Response(
     *           response=201,
     *           description="Rental stored successfully",
     *           @OA\JsonContent(
     *               @OA\Property(
     *                   property="data",
     *                    type="object",
     *                    @OA\Property(
     *                        property="rent",
     *                        ref="#/components/schemas/RentResourceSchema"
     *                    )
     *               )
     *           )
     *       ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

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

    /**
     * @OA\Patch(
     *     path="/api/rents/{rent}",
     *     summary="Update the specified rental in storage",
     *     tags={"Rentals"},
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         description="ID of rental to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RentUpdateRequestSchema")
     *     ),
     *     @OA\Response(
     *            response=202,
     *            description="Rental update successfully",
     *            @OA\JsonContent(
     *                @OA\Property(
     *                    property="data",
     *                    type="object",
     *                    @OA\Property(
     *                        property="rent",
     *                        ref="#/components/schemas/RentResourceSchema"
     *                    )
     *                )
     *            )
     *        ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Rental not found"
     *     )
     * )
     */

    public function update(UpdateRentRequest $request, Rent $rent)
    {
        $data = $request->validated();

        $rent->update($data);

        return redirect()->route('rents.index');
    }

    /**
     * @OA\Patch(
     *     path="/api/rents/{rent}/return",
     *     summary="Return a rented book",
     *     tags={"Rents"},
     *     @OA\Parameter(
     *         name="rent",
     *         in="path",
     *         description="ID of the rent to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book returned successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Book returned successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Rent not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Rent not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Server error")
     *         )
     *     )
     * )
     */

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


    public function deleteNotificationAndRedirectToRentEdit(Rent $rent, $notificationId)
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
