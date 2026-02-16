<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CirculationController extends Controller
{
    public function index()
    {
        $activeLoans = BorrowRecord::with(['book', 'member'])
            ->whereNull('returned_at')
            ->orderBy('due_date')
            ->get();

        return view('circulation.index', compact('activeLoans'));
    }

    public function create()
    {
        $books = Book::where('available', '>', 0)->get();
        $members = Member::all();
        return view('circulation.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'due_date' => 'required|date|after:today',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->available < 1) {
            return back()->with('error', 'Book is not available for borrowing.');
        }

       
        BorrowRecord::create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'borrowed_at' => Carbon::now(),
            'due_date' => $request->due_date,
        ]);

       
        $book->decrement('available');

        return redirect()->route('circulation.index')->with('success', 'Book borrowed successfully.');
    }

    public function returnBook(BorrowRecord $borrowRecord)
    {
        if ($borrowRecord->returned_at) {
             return back()->with('error', 'Book already returned.');
        }

        $borrowRecord->update([
            'returned_at' => Carbon::now(),
        ]);

        
        $borrowRecord->book->increment('available');

        return redirect()->route('circulation.index')->with('success', 'Book returned successfully.');
    }
}
