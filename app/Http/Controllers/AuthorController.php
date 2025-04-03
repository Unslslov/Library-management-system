<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

        return view('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }


    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('author.show', compact('author'));
    }

    /**
     * @OA\Post(
     *     path="/api/authors",
     *     summary="Store a newly created author in storage",
     *     tags={"Authors"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthorStoreRequestSchema")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Author stored successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Petr"),
     *                     @OA\Property(property="bio", type="string", example="bio")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */


    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validated();

        if (empty($data)) {
            return redirect()->back()->withErrors(['error' => 'Недостаточно данных для добавления автора.']);
        }

        $author = Author::create($data);
        return redirect()->route('authors.index')->with('success', 'Автор успешно добавлен(а).');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('author.edit', compact('author'));
    }


    /**
     * @OA\Patch(
     *     path="/api/authors/{author}",
     *     summary="Update the specified author in storage",
     *     tags={"Authors"},
     *     @OA\Parameter(
     *         name="author",
     *         in="path",
     *         description="ID of author to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthorUpdateRequestSchema")
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="Author stored successfully",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=1),
     *                      @OA\Property(property="name", type="string", example="Petr"),
     *                      @OA\Property(property="bio", type="string", example="bio")
     *                  )
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="author not found"
     *     )
     * )
     */

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $data = $request->validated();

        if (empty($data)) {
            return redirect()->back()->withErrors(['error' => 'Недостаточно данных для обновления данных об авторе.']);
        }

        $author->update($data);
        return redirect()->route('authors.index')->with('success', 'Автор успешно обновлен(а).');
    }

    /**
     * @OA\Delete(
     *      path="/api/authors/{author}",
     *      operationId="deleteAuthor",
     *      tags={"Authors"},
     *      summary="Remove the specified author from storage",
     *      description="Remove the specified author from storage",
     *      @OA\Parameter(
     *          name="author",
     *          in="path",
     *          description="ID of author to delete",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Author deleted successfully"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Author not found"
     *      )
     * )
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
    }
}
