<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:edit-users");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::paginate(25) -- Colocar a quantidade que você quer que exiba.
        //No fornt-end colocar o {{ $users->links()}}

        $users = User::all();
        return view('admin.users.index', ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->only([
            'name', 'email', 'password', 'password_confirmation', 'isAdmin'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = Hash::make($data["password"]);

        if(!empty($data["isAdmin"])){
            $user->is_admin = ($data["isAdmin"] == 'on') ? 1 : 0;
        }  

        $user->save();

        return redirect()->route("admin.users");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route("admin.users");
        }

        return view("admin.users.show", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route("admin.users");
        }

        return view("admin.users.edit", ["user" => $user]);
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
        $user = User::find($id);

        //Validando de o Usuário existe no banco de dados
        if (!$user) {
            return redirect()->route('admin.users');
        }

        $data = $request->only([
            'name', 'email', 'password', 'password_confirmation', 'isAdmin'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email']
        ]);

        $user->name = $data["name"];

        if(!empty($data["isAdmin"])){
            $user->is_admin = ($data["isAdmin"] == 'on') ? 1 : 0;
        }        

        //Verificando se existe o e-mail na base de dados
        if ($user->email != $data['email']) {
            $hasEmail = User::where('email', $data['email'])->get();

            if (count($hasEmail) !== 0) {
                $validator->errors()->add('email', __('validation.unique', [
                    "attribute" => 'email'
                ]));
            } else {
                $user->email = $data["email"];
            }
        }

        //Verificando se o usuário preencheu o campo
        if (!empty($data["password"])) {
            if (strlen($data['password']) < 8) {
                $validator->errors()->add('password', __('validation.min.string', [
                    "attribute" => 'password',
                    "min" => 8
                ]));
            } elseif ($data['password'] !== $data['password_confirmation']) {
                $validator->errors()->add('password', __('validation.confirmed', [
                    "attribute" => 'password'
                ]));
            } else {
                $user->password = Hash::make($data["password"]);
            }
        }

        if (count($validator->errors()) > 0) {
            return redirect()->route('admin.users.edit', ["user" => $id])
                ->withErrors($validator);
        }

        $user->save();

        return redirect()->route("admin.users");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($id != Auth::id()) {
            $user->delete();
        }

        return redirect()->route('admin.users');
    }
}
