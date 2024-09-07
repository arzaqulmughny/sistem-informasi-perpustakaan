<?php

namespace App\Http\Controllers;

use App\DataTables\BookCopyDataTable;
use App\DataTables\BooksDataTable;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Show book list
     */
    public function index(BooksDataTable $dataTable)
    {
        return $dataTable->render('pages.books.index');
    }

    /**
     * Show book detail
     */
    public function show(Book $book, BookCopyDataTable $dataTable)
    {
        return $dataTable->render('pages.books.show', [
            'data' => $book,
        ]);
    }

    /**
     * Show book detail
     */
    public function edit(Book $book, BookCopyDataTable $dataTable)
    {
        return $dataTable->render('pages.books.edit', [
            'data' => $book,
        ]);
    }


    /**
     * Show create form
     */
    public function create()
    {
        return view('pages.books.create');
    }

    /**
     * Store data
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $book = Book::create([
                ...$data,
                'created_by' => $request->user()->id
            ]);

            DB::commit();
            return redirect()->route('book.show', $book->id);
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();

            // return redirect()->route('book.index');
        }

        return view('pages.books.create');
    }


    /**
     * Update data
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $book->update($data);
            
            DB::commit();
            return redirect()->route('book.show', $book->id);
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();

            // return redirect()->route('book.index');
        }

        return view('pages.books.create');
    }

    /**
     * Destroy
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('book.index');
    }
}
