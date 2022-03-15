<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(25);

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'title',
            'content'
        ]);

        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make($data, [
            "title" => ['required', 'string', 'max:100'],
            "slug" => ['required', 'string', 'unique:pages'],
            "content" => ['string']
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pages.create')
                ->withErrors($validator)
                ->withInput();
        }

        $page = new Page;
        $page->title = $data['title'];
        $page->slug = $data['slug'];
        $page->content = $data['content'];
        $page->save();

        return redirect()->route('admin.pages')
            ->with('success', 'Sua nova página foi criada com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $page = Page::find($id);

        if (!$page) {
            return redirect()->route("admin.pages")
                ->with('warning', 'Whooops! Nenhum registro encontrado...');
        }

        return view("admin.pages.edit", ["page" => $page]);
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

        $page = Page::find($id);

        if ($page) {
            $data = $request->only([
                'title',
                'content'
            ]);

            if ($page['title'] == $data['title']) {
                $data['slug'] = Str::slug($data['title'], '-');

                $validator = Validator::make($data, [
                    "title" => ['required', 'string', 'max:100'],
                    "slug" => ['required', 'string', 'unique:pages'],
                    "content" => ['string']
                ]);
            } else {
                $validator = Validator::make($data, [
                    "title" => ['required', 'string', 'max:100'],
                    "content" => ['string']
                ]);
            }

            if ($validator->fails()) {
                return redirect()->route('admin.pages.edit', ['page' => $id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $page->title = $data['title'];
            $page->content = $data['content'];

            if(!empty($data['slug'])){
                $page->slug = $data['slug'];
            }

            $page->save();

            return redirect()->route('admin.pages')
                ->with('success', 'Sua página foi alterada com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if ($page) {
            $page->delete();
        }

        return redirect()->route('admin.pages')
            ->with('success', "Seu registro foi excluido com sucesso!");
    }
}
