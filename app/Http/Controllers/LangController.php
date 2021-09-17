<?php

namespace App\Http\Controllers;

use App\Http\Requests\System\LangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function changeLang(LangRequest $request)
    {
        try {
            $lang = $request->input("lang", "en");

            if (array_key_exists($lang, Config::get("languages"))) {
                Session::put("applocale", $lang);
            }
            return back();
        } catch (\Throwable $th) {
            return back()->withErrors([
                "modal-message" => "Não foi possivel mudar a linguagens "
            ]);
        }
    }
}
