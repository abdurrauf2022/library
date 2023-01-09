<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\ReservationStatuses;
use Illuminate\Http\Request;

class ArchivedReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['protect-all', 'librarian-protect', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $archived_reservations
            = ReservationStatuses::where('status_reservations_id', 2)
                                 ->orWhere('status_reservations_id', 4)
                                 ->orWhere('status_reservations_id', 5)
                                 ->get();

        $is_null = ReservationStatuses::where('status_reservations_id', 2)
                                      ->orWhere('status_reservations_id', 4)
                                      ->orWhere('status_reservations_id', 5)
                                      ->count();

        return view('pages.books.transactions.archived_reservations',
            compact('archived_reservations', 'is_null'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->noContent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->noContent();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->noContent();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->noContent();
    }
}
