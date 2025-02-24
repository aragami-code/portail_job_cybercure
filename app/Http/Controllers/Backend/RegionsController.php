<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Etats;
use App\Parametres;
use App\Regions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class RegionsController extends Controller
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


        }elseif(!$this->user->can('GLR.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $Regions = Regions::all();
            $parametre = Parametres::first();
                    return view('backend.pages.regions.index', compact('Regions','parametre'));


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


        }elseif(!$this->user->can('GLR.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $Regions = Regions::all();
        $Etat = Etats::all();
        $parametre = Parametres::first();

        return view('backend.pages.regions.create', compact('Regions','Etat','parametre'));


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


    }elseif(!$this->user->can('GLR.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

    }else{

        $request->validate([

            'nom_region' => 'required|max:100',
            'slug_region' => 'required',
            'etat_id' => 'required',
            'status' => 'required'

            ],

            ['nom_region.required' => 'Le nom est obligatoire.',
            'slug_region.required' => 'Le slug est obligatoire.',
            'etat_id.required' => 'Etat est  obligatoire.',
            'status.required' => 'Veuillez choisir un statut.']);



        // creer un nouvel Utilisateur
        $Regions = new Regions();
        $Regions->nom_region = $request->nom_region;
        $Regions->slug_region = $request->slug_region;
        $Regions->etat_id = $request->etat_id;
        $Regions->status = $request->status;

        $Regions->save();


       session()->flash('success', 'Nouvelle Région ajouté avec succes !');
       return redirect()->route('admin.regions.index');

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


        }elseif(!$this->user->can('GLR.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $Regions = Regions::find($id);
        $Etat = Etats::all();
        $parametre = Parametres::first();
       return view('backend.pages.regions.edit', compact('Regions','Etat','parametre'));

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


        }elseif(!$this->user->can('GLR.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
$request->validate([

    'nom_region' => 'required|max:100',
            'slug_region' => 'required',
            'etat_id' => 'required',
            'status' => 'required'

            ],

            ['nom_region.required' => 'Le nom est obligatoire.',
            'slug_region.required' => 'Le slug est obligatoire.',
            'etat_id.required' => 'Etat est  obligatoire.',
            'status.required' => 'Veuillez choisir un statut.']);


        // creer un nouvel Utilisateur
        $Regions = Regions::find($id);
        $Regions->nom_region = $request->nom_region;
        $Regions->slug_region = $request->slug_region;
        $Regions->etat_id = $request->etat_id;
        $Regions->status = $request->status;

        $Regions->save();

         session()->flash('success', 'Région modifié avec succes !');
         return redirect()->route('admin.regions.index');
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


        }elseif(!$this->user->can('GLR.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $Regions = Regions::find($id);
        if(!is_null($Regions)){
            $Regions->delete();
        }
        session()->flash('success', 'Région  supprimé avec succes !');
        return back();

        }

    }
}
