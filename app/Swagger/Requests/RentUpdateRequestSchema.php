<?php

namespace App\Swagger\Requests;
/**
 * @OA\Schema (required={"book_id", "due_date"})
 */
class RentUpdateRequestSchema
{
    /**
     * @OA\Property (example=1)
     */
    public int $book_id;

    /**
     * @OA\Property (example="2024-11-30")
     */
    public string $due_date;
}
