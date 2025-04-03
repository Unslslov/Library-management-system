<?php

namespace App\Swagger\Resources;
/**
 * @OA\Schema (),
 */
class RentResourceSchema
{
    /**
     * @OA\Property (example=1),
     */
    public int $id;

    /**
     * @OA\Property (example=1),
     */
    public int $user_id;

    /**
     * @OA\Property (example=1),
     */
    public int $book_id;

    /**
     * @OA\Property(example="2024-12-06", format="date")
     */
    public string $rented_at;

    /**
     * @OA\Property(example="2024-12-12", format="date")
     */
    public string $due_date;

    /**
     * @OA\Property(example="2024-12-15", format="date", nullable=true)
     */
    public ?string $return_at;

    /**
     * @OA\Property (example="2024-11-24T14:38:49.000000Z")
     */
    public string $created_at;

    /**
     * @OA\Property (example="2024-11-24T14:38:49.000000Z")
     */
    public string $updated_at;

}
