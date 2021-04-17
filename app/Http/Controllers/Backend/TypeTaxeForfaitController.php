<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\CommuneController -r"
// Ce Controller combine avec "public/js/console/commune.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communes;
use App\Models\TypeTaxe;
use App\Models\TypeTaxeForfait;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class TypeTaxeForfaitController extends Controller
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

        $this->authorize("Listing Type Taxe Forfait");
        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';


        $result = self::queryFor($from,$order,$limit,$search,$type);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public function queryFor($from,$order,$limit,$search,$type){

        $query = DB::table("type_taxe_forfaits")
					->whereNull("deleted_at")
					->orderBy("id",$order);

            if($search && !empty($search)){
                $query->where('name', 'LIKE', "%{$search}%");
            }
        if($type && !empty($type)){
                $query->where('type_taxe_id', '=', $type);
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
     * @param \Illuminate\Http\Request  $request
     * @return\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        // Communes::updateOrCreate(['id' => $request->get('id')], ['name' => $request->commune]);
      $save =  TypeTaxeForfait::updateOrCreate(['id' => $request->get('id')],
          [
              'type_taxe_id' => $request->type,
              'amount' => $request->montant,
              ]);

        if(!$save){
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $typeTaxe = TypeTaxeForfait::findOrFail($id);
  if($typeTaxe)
        return response()->json($typeTaxe);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $typeTaxe = TypeTaxeForfait::findOrFail($request->get('id'));
        $destroy = $typeTaxe->delete();

        if (!$destroy) {
            return response()->json(array('success' => false, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => true, 'message' => Lang::get('message.delete_success')));
    }

}
