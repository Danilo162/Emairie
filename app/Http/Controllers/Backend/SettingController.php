<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\AgentController -r"
// Ce Controller combine avec "public/js/console/agent.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Mairies;
use App\Models\Agents;
use App\Models\User\User;
use App\Rules\ChangePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function lists()
    {

        return view('setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param\Illuminate\Http\Request  $request
     * @return\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            if ($request->has('phone') && !$request->signature) {

                $mairis = Mairies::findOrFail(mairies()->id);
                $image = $mairis->picture;
                if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                    $image = $request->picture->store('/mairies');
                }

                $save = $mairis->update([
                    "phone"=>$request->phone,
                    "email"=>$request->email,
                    "picture"=>$image,
                ]);

                if(!$save){

                    return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

                }
                return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

            }

            else {

                $agent = Agents::findOrFail(auth()->user()->agent_id);

                $image = $agent->signature;
                if ($request->hasFile('signature') && $request->file('signature')->isValid()) {
                    $image = $request->signature->store('/agents/signature');
                }

                $save = $agent->update([
                    "signature"=>$image,
                ]);

                if(!$save){
                    return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
                }
                return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

            }

    }



}
