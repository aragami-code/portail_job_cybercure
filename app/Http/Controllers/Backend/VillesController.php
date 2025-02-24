<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Parametres;
use App\Regions;
use App\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class VillesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);

        });
    }


    public function index()
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('GLV.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $Villes = Villes::all();
            $parametre = Parametres::first();
        return view('backend.pages.villes.index', compact('Villes','parametre'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


      if(is_null($this->user)){
        return view('backend.auth.login');


    }elseif(!$this->user->can('GLV.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{
  $Villes = Villes::all();
        $Region = Regions::all();
        $parametre = Parametres::first();
      return view('backend.pages.villes.create', compact('Villes','Region','parametre'));


    }
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       if(is_null($this->user)){
        return view('backend.auth.login');


    }elseif(!$this->user->can('GLV.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{
        $request->validate([

            'nom_ville' => 'required|max:100',
            'slug_ville' => 'required',
            'region_id' => 'required',
            'status' => 'required'

            ],

            ['nom_ville.required' => 'Le nom est obligatoire.',
            'slug_ville.required' => 'Le slug est obligatoire.',
            'region_id.required' => 'Région est  obligatoire',
            'status.required' => 'Veuillez choisir un statut.']);



        // creer un nouvel Utilisateur
        $Villes = new Villes();
        $Villes->nom_ville = $request->nom_ville;
        $Villes->slug_ville = $request->slug_ville;
        $Villes->region_id = $request->region_id;
        $Villes->status = $request->status;

        $Villes->save();


       session()->flash('success', 'Département ajouté avec succès !');
       return redirect()->route('admin.villes.index');



    }
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
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('GLV.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $Villes = Villes::find($id);
        $Region = Regions::all();
        $parametre = Parametres::first();
        return view('backend.pages.villes.edit', compact('Villes','Region','parametre'));

        }
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




        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('GLV.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


$request->validate([

            'nom_ville' => 'required|max:100',
            'slug_ville' => 'required',
            'region_id' => 'required',
            'status' => 'required'

            ],

            ['nom_ville.required' => 'Le nom est obligatoire.',
            'slug_ville.required' => 'Le slug est obligatoire.',
            'region_id.required' => 'Région est  obligatoire.',
            'status.required' => 'Veuillez choisir un statut.']);


        // creer un nouvel Utilisateur
        $Villes = Villes::find($id);
        $Villes->nom_ville = $request->nom_ville;
        $Villes->slug_ville = $request->slug_ville;
        $Villes->region_id = $request->region_id;
        $Villes->status = $request->status;

        $Villes->save();

         session()->flash('success', 'ville  a été modifié avec succes !');
         return redirect()->route('admin.villes.index');
        //return back();

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


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('GLV.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

             $Villes = Villes::find($id);


        if(!is_null($Villes)){
            $Villes->delete();
        }
        session()->flash('success', 'Département  supprimé avec succes !');
        return back();

        }

    }
}
