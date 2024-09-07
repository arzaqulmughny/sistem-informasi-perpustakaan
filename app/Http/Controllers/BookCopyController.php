<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookCopyRequest;
use App\Models\Book;
use App\Models\BookCopy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookCopyController extends Controller
{
    /**
     * Show create form
     */
    public function create(Book $book)
    {
        return view('pages.books.copies.create', [
            'parent' => $book
        ]);
    }

    /**
     * Store data
     */
    public function store(Book $book, StoreBookCopyRequest $request)
    {
        $data = $request->validated();

        try {
            BookCopy::create([
                ...$data,
                'book_id' => $book->id,
                'created_by' => $request->user()->id
            ]);

            return redirect()->route('book.show', $book->id);
        } catch (Exception $exception) {
            return redirect()->back();
        }
    }

    /**
     * Destroy data
     */
    public function destroy(Book $book, BookCopy $copy)
    {
        try {
            $copy->delete();
            return redirect()->back();
        } catch (Exception $exception) {
            return redirect()->back();
        }
    }
}
