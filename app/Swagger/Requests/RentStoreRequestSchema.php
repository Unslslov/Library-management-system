<?php

namespace App\Swagger\Requests;
/**
 * @OA\Schema (required={"book_id", "due_date"})
 */
class RentStoreRequestSchema
{
    /**
     * @OA\Property (example=1)
     */
    public int $book_id;

    /**
     * @OA\Property(example="2024-12-12", format="date")
     */
    public string $due_date;
}
