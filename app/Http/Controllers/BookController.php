<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('book.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('book.create', compact( 'authors'));
    }

    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Store a newly created book in storage",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookStoreRequestSchema")
     *     ),
     *     @OA\Response(
     *           response=201,
     *           description="Book stored successfully",
     *           @OA\JsonContent(
     *               @OA\Property(
     *                   property="data",
     *                   type="array",
     *                   @OA\Items(
     *                       type="object",
     *                       @OA\Property(property="id", type="integer", example=1),
     *                       @OA\Property(property="title", type="string", example="The Great Gatsby"),
     *                       @OA\Property(property="author_id", type="integer", example=1),
     *                       @OA\Property(property="published_at", type="string", format="date-time", example="1925-04-10T00:00:00Z")
     *                   )
     *               )
     *           )
     *       ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if (empty($data)) {
            return redirect()->back()->withErrors(['error' => 'Недостаточно данных для создания книги.']);
        }

        Book::create($data);
        return redirect()->route('books.index')->with('success', 'Книга успешно создана.');
    }

    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('book.edit', compact('book', 'authors'));
    }

    /**
     * @OA\Patch(
     *     path="/api/books/{book}",
     *     summary="Update the specified book in storage",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         description="ID of book to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookUpdateRequestSchema")
     *     ),
     *     @OA\Response(
     *            response=202,
     *            description="Book update successfully",
     *            @OA\JsonContent(
     *                @OA\Property(
     *                    property="data",
     *                    type="array",
     *                    @OA\Items(
     *                        type="object",
     *                        @OA\Property(property="id", type="integer", example=1),
     *                        @OA\Property(property="title", type="string", example="The Great Gatsby"),
     *                        @OA\Property(property="author_id", type="integer", example=1),
     *                        @OA\Property(property="published_at", type="string", format="date-time", example="1925-04-10T00:00:00Z")
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
     *         description="Book not found"
     *     )
     * )
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        if (empty($data)) {
            return redirect()->back()->withErrors(['error' => 'Недостаточно данных для обновления книги.']);
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Книга успешно обновлена.');
    }

    /**
     * @OA\Delete(
     *      path="/api/books/{book}",
     *      operationId="deleteBook",
     *      tags={"Books"},
     *      summary="Remove the specified book from storage",
     *      description="Remove the specified book from storage",
     *      @OA\Parameter(
     *          name="book",
     *          in="path",
     *          description="ID of book to delete",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Book deleted successfully"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Book not found"
     *      )
     * )
     */
    public function destroy(Book $book)
    {
        if (!$book) {
            return redirect()->route('books.index')
                             ->with('error', 'Книга не найдена.');
        }

        $book->delete();
        return redirect()->route('books.index')
                         ->with('success', 'Книга успешно удалена.');
    }
}
