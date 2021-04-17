<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\CommuneController -r"
// Ce Controller combine avec "public/js/console/commune.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CommuneController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';


        $result = self::queryFor($from,$order,$limit,$search);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public function queryFor($from,$order,$limit,$search){

        $query = DB::table("communes")
					->whereNull("deleted_at")
					->orderBy("id",$order);

            if($search && !empty($search)){
                $query->where('name', 'LIKE', "%{$search}%");
            }


        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|min:1|unique:communes,name,NULL,id,deleted_at,NULL']);

        // Communes::updateOrCreate(['id' => $request->get('id')], ['name' => $request->commune]);
        Communes::updateOrCreate(['id' => $request->get('id')], ['name' => $request->name]);

        return response()->json(['success' => true, 'message' => 'Enregistrement de commune effectué avec succès.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commune = Communes::findOrFail($id);

        return response()->json($commune);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $commune = Communes::findOrFail($request->get('id'));
        $destroy = $commune->delete();

		if (!$destroy) {
            return response()->json(array('success' => true, 'message' => 'Suppression a echouée'), 400);
        }
        return response()->json(['success'=>'Suppression de la commune effectuée avec succès.']);
    }


}
