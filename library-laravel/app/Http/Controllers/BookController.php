<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use App\Models\BookGenre;
use App\Models\GlobalVariable;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $books = Book::latest('id')->paginate(5);

        return view('pages.books.books', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $models = [
            'categories'=> DB::table('categories')->get(),
            'genres' => DB::table('genres')->get(),
            'authors' => DB::table('authors')->get(),
            'publishers' => DB::table('publishers')->get(),
            'bindings' => DB::table('bindings')->get(),
            'formats' => DB::table('formats')->get(),
            'languages' => DB::table('languages')->get(),
            'letters' =>DB::table('letters')->get()
        ];

        return view('pages.books.new_book', compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BookCreateRequest $request)
    {
        $book = new Book();
        $book->title = $request->input('title');
        $book->body = $request->input('body');
        $book->publisher_id = $request->input('publisher_id');
        $book->quantity_count = $request->input('quantity_count');
        $book->page_count = $request->input('page_count');;
        $book->binding_id = $request->input('binding_id');
        $book->letter_id = $request->input('letter_id');
        $book->format_id = $request->input('format_id');
        $book->language_id = $request->input('language_id');
        $book->ISBN = $request->input('ISBN');
        $book->year = $request->input('year');
        $book->save();
        $categories=$request->input('category_id');
        $this->saveCategories($categories,$book->id);
        $authors=$request->input('author_id');
        $this->saveAuthors($authors,$book->id);
        $genres=$request->input('genre_id');
        $this->saveGenres($genres,$book->id);



        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/book-covers', $name);
            DB::table('galleries')->insert(
                ['book_id' => $book->id, 'photo' => $name, 'cover' => 1],
            );
        } else {
            return redirect('/errror');
        }

        return to_route('all-books')->with('success-book','Uspješno ste dodali knjigu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('pages.books.show_book', compact('book'));
    }

    public function publishedBooks()
    {
        $book = new Book();

        return view('pages.books.transactions.published', compact('book'));
    }

    public function activeReservations()
    {
        $book = new Book();

        return view('pages.books.transactions.active_reservations', compact('book'));
    }

    public function archivedReservations()
    {
        $book = new Book();

        return view('pages.books.transactions.archived_reservations', compact('book'));
    }

    public function returnedBooks(){
        $book = new Book();

        return view('pages.books.transactions.returned_books', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $models = [
            'categories'=> DB::table('categories')->get(),
            'genres' => DB::table('genres')->get(),
            'authors' => DB::table('authors')->get(),
            'publishers' => DB::table('publishers')->get(),
            'bindings' => DB::table('bindings')->get(),
            'formats' => DB::table('formats')->get(),
            'languages' => DB::table('languages')->get(),
            'letters' =>DB::table('letters')->get()
        ];

        $book = Book::findOrFail($id);

        return view('pages.books.edit_book', compact('book','models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->body = $request->input('body');
        $book->publisher_id = $request->input('publisher_id');
        $book->quantity_count = $request->input('quantity_count');
        $book->page_count = $request->input('page_count');;
        $book->binding_id = $request->input('binding_id');
        $book->letter_id = $request->input('letter_id');
        $book->format_id = $request->input('format_id');
        $book->language_id = $request->input('language_id');
        if(request('ISBN')) {
            $book->ISBN = $request->input('ISBN');
        }
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/students', $name);
            DB::table('galleries')->where('book_id',$book->id)->update(['photo'=>$name]);
        }
        $book->year = $request->input('year');
        $book->save();

        $categories = $request->input('category_id');
        $this->saveCategoriesEdit($categories,$book);

        $genres = $request->input('genre_id');
        $this->saveGenresEdit($genres,$book);

        $authors = $request->input('author_id');
        $this->saveAuthorsEdit($authors,$book);



        //return to_route('all-books')->with('success-edited-book', 'Uspješno ste izmijenili knjigu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return to_route('all-books')->with('book-deleted', 'Uspješno ste izbrisali knjigu.');
    }
    public function saveCategories($categories,$book){
        $categories=explode(',',$categories);
        foreach ($categories as $category){
            $table=new BookCategory();
            $table->book_id=$book;
            $table->category_id=$category;
            $table->save();
        }
    }
    public function saveGenres($genres,$book){
        $genres=explode(',',$genres);
        foreach ($genres as $genre){
            $table=new BookGenre();
            $table->book_id=$book;
            $table->genre_id=$genre;
            $table->save();
        }
    }
    public function saveAuthors($authors,$book){
        $authors=explode(',',$authors);
        foreach ($authors as $author){
            $table=new BookAuthor();
            $table->book_id=$book;
            $table->author_id=$author;
            $table->save();
        }
    }
    public function saveCategoriesEdit($categories,$book){

        $categories = explode(',', $categories);
        dd($categories);

        /*foreach($categories as $category) {
            $table = BookCategory::find($category);
            $table->book_id = $book->id;
            $table->category_id = $category;
            $table->save();
        }*/
    }
    public function saveGenresEdit($genres,$book){
        $genres = explode(',', $genres);

        /*foreach($genres as $genre) {
            $table = BookGenre::find($genre);
            $table->book_id = $book->id;
            $table->genre_id = $genre;
            $table->save();
        }*/
    }
    public function saveAuthorsEdit($authors,$book){
        $authors = explode(',', $authors);

        /*foreach($authors as $author) {
            $table = BookAuthor::find($author);
            $table->book_id = $book->id;
            $table->author_id = $author;
            $table->save();
        }*/
    }

}
