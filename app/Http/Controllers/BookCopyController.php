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

            return redirect()->route('book.show', $book->id)->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Destroy data
     */
    public function destroy(Book $book, BookCopy $copy)
    {
        try {
            DB::beginTransaction();
            $copy->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menghapus data');
        } catch (Exception $exception) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalah pada server');
        }
    }
}
