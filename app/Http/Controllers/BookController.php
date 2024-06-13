<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Book::with('user')->get();
        return view('books',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::find(3);
        $user->book()->create([
            'title'=> 'book 3',
            'price'=> 56
        ]);
        return redirect()->route('books.index')->with('status','Successfully Inserted.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        Gate::authorize('view',$book);
        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // Gate::authorize('update',$book);
        // if($request->user()->cannot('update',$book)){
        //     abort(403);
        // }
        return view('bookedit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Gate::authorize('update',$book);           // First System
        if($request->user()->cannot('update',$book)){   //Second System
            abort(403,"You are not authorized.");
        }
        $request->validate([
            'title'=>'required',
            'price'=>'required|numeric'
        ]);
        $book->title = $request->title;
        $book->price = $request->price;
        $book->save();
        
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Gate::authorize('delete',$book);
        $book->delete();
        return redirect()->back();
    }
}
