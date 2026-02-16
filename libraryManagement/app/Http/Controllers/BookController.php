<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    
    public function create()
    {
        return view('books.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'published_year' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['available'] = $request->quantity; 

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

   
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'published_year' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);

        
        $borrowed_count = $book->quantity - $book->available;
        
        $new_quantity = $request->quantity;
        $new_available = $new_quantity - $borrowed_count;

        if ($new_available < 0) {
            return back()->with('error', 'Cannot reduce quantity below currently borrowed amount.');
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'published_year' => $request->published_year,
            'quantity' => $new_quantity,
            'available' => $new_available,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

   
    public function destroy(Book $book)
    {
        if ($book->quantity != $book->available) {
             return back()->with('error', 'Cannot delete book with active borrows.');
        }
        
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
