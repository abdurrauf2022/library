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
use Intervention\Image\ImageManagerStatic as Image;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'librarian-protect'])
        ->except('show', 'crop', 'edit', 'update', 'destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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

        $show_criterium = false;

        $searched = $request->trazeno;
        if($searched){
            $students = User::search($request->trazeno)->where('user_type_id', 1)->paginate($items);
            $count = User::search($request->trazeno)->get()->count();
            if ($count == 0) {
                $show_criterium = true;
            } else {
                $show_criterium = false;
            }
        }else{
            $students = User::latest('id')->where('user_type_id', 1)->paginate($items);
            $show_criterium = false;
        }
    
        $show_all = User::latest('id')->where('user_type_id', 1)->count();

        return view('pages.students.students', compact('students', 'items', 'variable', 'show_all', 'searched', 'show_criterium'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.students.new_student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'username' => 'required|min:2|max:255',
            'email' => [new EmailVerificationRule()],
            // 'password' => 'required|min:8|confirmed',   
            // 'JMBG' => 'required|min:14|max:14',
            'photo' => 'required',
        ])->safe()->all();

        $input['user_type_id'] = 1;
        $input['user_gender_id'] = $request->user_gender_id;
        $input['last_login_at'] = Carbon::now();
        $input['password'] = Hash::make($request->password);

        //Hash password
        $user['password'] = Hash::make(request()->password);
      
        // if ($file = $request->file('photo')) {
        //     $name = time() . $file->getClientOriginalName();
        //     $file->move('storage/students/', $name);
        //     $input['photo'] = $name; 
        // } else {
        //     $input['photo'] = 'profileImg-default.jpg';
        // }

        if($request->hasFile('photo')) {

            $image = $request->file('photo');
            $filename = $image->getClientOriginalName();
        
            $image_resize = Image::make($image->getRealPath());              

            $image_resize->resize(500, 500);

            $image_resize->save('storage/students/' . $filename);
            $input['photo'] = $filename; 
        } else {
            $input['photo'] = 'profileImg-default.jpg';
        }

        User::create($input);

        return to_route('all-student')->with('success-student', 'Uspješno ste registrovali učenika ' . "'$request->username'");
    }

    public function crop(Request $request) {
        $dest = 'storage/students';
        $file = $request->file('photo');
        $new_image_name = date('YmdHis').uniqid().'.jpg';

        $move = $file->move($dest, $new_image_name);

        if (!$move)  {
            return response()->json(['status' => 0, 'msg' => 'Greška!']);
        } else {
            // $user = auth()->user();
            // $userPhoto = $user->photo;

            // if ($userPhoto != '') {
            //     unlink($dest.$userPhoto);
            // }
            $user = User::where('id', Auth::user()->id)->update(['photo' => $new_image_name]);

            return response()->json(['status' => 1, 'msg' => 'Uspješno ste izmijenili profilnu sliku!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        if ($user->type->name == 'student') {
            $student = $user;
        } else {
            abort(404);
        }
        
        return view('pages.students.show_student', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        if ($user->type->name == 'student') {
            $student = $user;
        } else {
            abort(404);
        }
        
        return view('pages.students.edit_student', compact('student'));
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
        $input = $request->all();
        $user = Auth::user();
        $find_user = User::findOrFail($id);
        if ($find_user->gender->id == 1) {
            $word = 'učenika';
        } else {
            $word = 'učenice';
        }

        $photo_old = $request->photo;

        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/students', $name);
            $input['photo'] = $name;
        }

        if ($request->password) {
            $input['password'] = bcrypt($request->password);
        } else {
            $input['password'] = Auth::user()->password;
        }

        $user->whereId($id)->first()->update($input);
        
        return to_route('edit-student', $request->username)->with('student-updated', "Uspješno ste izmijenili profil $word");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $student = User::findOrFail($id);

        if (Auth::user()->id == $student->id) {
            $student->delete();

            return to_route('good-bye');
        }

        if ($student->photo != 'placeholder') {
            $path = '\\storage\\students\\' . $student->photo;
            unlink(public_path() . $path);
        }

        $student->delete();
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', explode(",", $ids))->delete();
    }
}
