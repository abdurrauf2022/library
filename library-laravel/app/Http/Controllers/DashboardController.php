<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $returned_books = Rent::count();
        $reserved_books = User::count();
        $overdue_books = Author::count();

        foreach ($books as $book) {
            // $data = $book->rent()->paginate(5);
            $data = $book->rent()->whereDay('created_at', date('d'))->orderBy('id', 'desc')->get();
        }
        
        return view('pages.dashboard.dashboard_content', compact('books', 'data', 'returned_books', 'reserved_books', 'overdue_books'));
    }

    public function index_activity() 
    {
        $books = Book::all();

        foreach ($books as $book) {
            // $data = $book->rent()->paginate(5);
            $data = $book->rent()->orderBy('id', 'desc')->get();
        }

        return view('pages.dashboard.dashboard_activity', compact('books', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
