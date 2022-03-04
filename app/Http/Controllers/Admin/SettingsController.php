<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = Setting::first();
        return view('admin.settings.settings', ["settings" =>  $settings]);
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
        $settings = Setting::find($id);

        //Validando de o Usuário existe no banco de dados
        if (!$settings) {
            return redirect()->route('admin');
        }

        $data = $request->only([
            'title', 'subtitle', 'description', 'email', 'bg_color', 'font_color'
        ]);

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'subtitle' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:160'],
            'email' => ['required', 'string', 'max:100', 'email'],
            'bg_color' => ['required', 'string', 'regex:/#[a-zA-Z0-9]{6}/i'],
            'font_color' => ['required', 'string', 'regex:/#[a-zA-Z0-9]{6}/i'],
        ]);

        $settings->title = $data["title"];
        $settings->subtitle = $data["subtitle"];
        $settings->description = $data["description"];
        $settings->email = $data["email"];
        $settings->bg_color = $data["bg_color"];
        $settings->font_color = $data["font_color"];
  

        if (count($validator->errors()) > 0) {
            return redirect()->route('admin.settings')
                ->withInput()
                ->withErrors($validator);
        }

        $settings->save();

        return redirect()->route("admin.settings")
            ->with('success', 'Suas informações foram alteradas com sucesso!');
    }
}
