<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        $id = intval( Auth::id() );
        $user = User::find($id);

        if(!$user){
            return redirect()->route('admin');
        }

        return view('admin.profile.edit', ["user" => $user]);
    }

    public function update(Request $request)
    {
        $id = intval( Auth::id() );
        $user = User::find($id);

        //Validando de o Usuário existe no banco de dados
        if (!$user) {
            return redirect()->route('admin');
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
            return redirect()->route('admin.profile', ["user" => $id])
                ->withErrors($validator);
        }

        $user->save();

        return redirect()->route("admin.profile.edit")
            ->with('success', 'Suas informações foram alteradas com sucesso!');
    }
}
