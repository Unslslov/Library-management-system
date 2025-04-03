<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     title="Rent",
 *     description="Rent model",
 *     @OA\Xml(
 *         name="Rent"
 *     ),
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         description="Rent ID",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="book_id",
 *         title="Book ID",
 *         description="Book ID",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         title="User ID",
 *         description="User ID",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="rent_date",
 *         title="Rent Date",
 *         description="Rent Date",
 *         example="2024-07-04 14:23:00",
 *         format="date-time",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="due_date",
 *         title="Due Date",
 *         description="Due Date",
 *         example="2024-07-18 14:23:00",
 *         format="date-time",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="return_date",
 *         title="Return Date",
 *         description="Return Date",
 *         example="2024-07-11 14:23:00",
 *         format="date-time",
 *         type="string",
 *         nullable=true
 *     )
 * )
 */

class Rent extends Model
{
    use SoftDeletes;

    protected $table = 'rents';
    protected $fillable = ['book_id', 'user_id', 'rent_date', 'due_date' , 'return_date'];


    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
