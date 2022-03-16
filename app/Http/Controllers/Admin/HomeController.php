<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\ReportAccess;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $interval = intval($request->input('interval', 30));

        if($interval > 120){
            $interval = 120;
        }

        //Contagem de Páginas
        $pages = Page::count();

        //Contagem de Usuários
        $users = User::count();

        // Contagem de Visitantes
        $dateInterval = date('Y-m-d H:i:s', strtotime("-".$interval." days"));
        $accessList = ReportAccess::where('date', '>=', $dateInterval)->paginate(10);
        $access = ReportAccess::where('date', '>=', $dateInterval)->groupBy('ip')->count();

        //Contagem de Usuários Onlines
        $dateLimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = ReportAccess::select('ip')->where('date', '>=', $dateLimit)->groupBy('ip')->get();
        $online = count($onlineList);


        //Montagem do Gráfico
        $pagePie = [];
        $pagePieColors = [];

        $accessAll = ReportAccess::selectRaw('url, count(url) as c')->where('date', '>=', $dateInterval)->groupBy('url')->get();
        foreach($accessAll as $item){
            $pagePie[$item['url']] = intval($item['c']);
            $pagePieColors[] = 'rgba('.rand(0, 255).', '.rand(0, 255).', '.rand(0, 255).')';
        }


        $pagesLabels = json_encode(array_keys($pagePie));
        $pagesValues = json_encode(array_values($pagePie));
        $pagePieColors = json_encode( array_values($pagePieColors));


        return view('admin.dashboard', [
            'accessList' => $accessList,
            'access' => ($access ?? 0),
            'online' => ($online ?? 0),
            'pages' => ($pages ?? 0),
            'users' => ($users ?? 0),
            'pagesLabels' => $pagesLabels,
            'pagesValues' => $pagesValues,
            'pagePieColors' => $pagePieColors,
            'dateInterval' => $interval
        ]);
    }
}
