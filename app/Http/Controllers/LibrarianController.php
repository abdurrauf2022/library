<?php

namespace App\Http\Controllers;

use App\Models\GlobalVariable;
use App\Models\User;
use App\Rules\EmailVerification\EmailVerificationRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LibrarianController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'librarian-protect']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->items) {
            $items = $request->items;
            $variable = GlobalVariable::findOrFail(4);
        } else {
            $variable = GlobalVariable::findOrFail(4);
            $items = $variable->value;
        }
        $librarians = User::latest('id')->where('user_type_id', 2)->paginate($items);
        $show_all = User::latest('id')->where('user_type_id', 2)->count();

        return view('pages.librarians.librarians', compact('librarians', 'items', 'variable', 'show_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.librarians.new_librarian');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'username' => 'required|min:2|max:255',
            'email' => [new EmailVerificationRule()],
            'password' => 'required|min:8|confirmed',   
            'JMBG' => 'required|min:14|max:14',
            'photo' => 'required',
        ])->safe()->all();

        $input['user_type_id'] = 2;
        $input['user_gender_id'] = $request->user_gender_id;
        $input['last_login_at'] = Carbon::now();
        $input['password'] = Hash::make($request->password);

        //Hash password
        $user['password'] = Hash::make(request()->password);
      
        // Store photo
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/librarians/', $name);
            $input['photo'] = $name; 
        } else {
            $input['photo'] = 'profileImg-default.jpg';
        }

        User::create($input);

        return to_route('all-librarian')->with('success-librarian', 'Uspješno ste registrovali bibliotekara ' . "'$request->username'");
    }

    public function crop(Request $request) {
        $dest = 'storage/librarians';
        $file = $request->file('photo');
        $new_image_name = date('YmdHis').uniqid().'.jpg';

        $move = $file->move($dest, $new_image_name);

        if (!$move)  {
            return response()->json(['status' => 0, 'msg' => 'Greška!']);
        } else {
            $user = User::where('id', Auth::id())->update(['photo' => $new_image_name]);

            return response()->json(['status' => 1, 'msg' => 'Uspješno ste izmijenili profilnu sliku!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($user->type->name == 'librarian') {
            $librarian = $user;
        } else {
            abort(404);
        }

        return view('pages.librarians.show_librarian', compact('librarian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->type->name == 'librarian') {
            $librarian = $user;
        } else {
            abort(404);
        }
        
        return view('pages.librarians.edit_librarian', compact('librarian'));
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
        $input = $request->all();
        $user = Auth::user();   
        $find_user = User::findOrFail($id);
        if ($find_user->gender->id == 1) {
            $word = 'bibliotekara';
        } else {
            $word = 'bibliotekarke';
        }

        $photo_old = $request->photo;
    
        if ($file = $request->file('photo')) {
            $name = $file->getClientOriginalName();
            $file->move('storage/librarians', $name);
            $input['photo'] = $name; 
        } 

        if ($request->password) {
            $input['password'] = bcrypt($request->password);
        } else {
            $input['password'] = Auth::user()->password;
        }

        $user->whereId($id)->first()->update($input);
        
        return to_route('edit-librarian', $request->username)->with('librarian-updated', "Uspješno ste izmijenili profil $word");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $librarian = User::findOrFail($id);

        if (Auth::user()->id == $librarian->id) {
            $librarian->delete();

            return to_route('good-bye');
        }

        if ($librarian->photo != 'placeholder') {
            $path = '\\storage\\librarians\\' . $librarian->photo;
            unlink(public_path() . $path);
        }

        $librarian->delete();
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', explode(",", $ids))->delete();
    }
}
