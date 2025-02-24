<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Parametres;
use App\sect_activ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class SectaController extends Controller
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


        }elseif(!$this->user->can('sectA.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

           $sect_activs = sect_activ::all();
           $parametre = Parametres::first();
        return view('backend.pages.sectas.index', compact('sect_activs','parametre'));


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


        }elseif(!$this->user->can('sectA.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $parametre = Parametres::first();
           return view('backend.pages.sectas.create',compact('parametre'));


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


    }elseif(!$this->user->can('sectA.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{

                $request->validate([

            'nom_secteur' => 'required',
            'status' => 'required'

            ],

            ['nom_secteur.required' => 'Le nom du secteur d\'activité est obligatoire.',
            'status.required' => 'Le statut est obligatoire.']);


        // creer un nouvel Utilisateur
        $sect_activs = new sect_activ();
        $sect_activs->nom_secteur = $request->nom_secteur;
        $sect_activs->status = $request->status;
        $sect_activs->save();


       session()->flash('success', 'Le secteur d\'activité ajouté avec succes !');
       return redirect()->route('admin.sectas.index');



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


        }elseif(!$this->user->can('sectA.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $sect_activs = sect_activ::find($id);
        $parametre = Parametres::first();
            return view('backend.pages.sectas.edit', compact('sect_activs','parametre'));



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
        // validation data


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('sectA.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            $request->validate([

            'nom_secteur' => 'required|max:100,'.$id,
            'status' => 'required|max:50',
            //'password' => 'nullable|between:8,255|confirmed',
           // 'password_confirmation' => 'required'
            ],

            ['nom_secteur.required' => 'Le nom est obligatoire.',
            'status.required' => 'Le status est obligatoire.']);
            //'password.required' => 'le mot de passe est obligatoire commencer à partir de 8 caracteres'

          // creer un nouvel Utilisateur
          $sect_activs = sect_activ::find($id);
          $sect_activs->nom_secteur = $request->nom_secteur;
          $sect_activs->status = $request->status;
          $sect_activs->save();

         session()->flash('success', 'Le secteur d\'activité a été modifié avec succes !');
         return redirect()->route('admin.sectas.index');
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


        }elseif(!$this->user->can('sectA.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $sect_activs = sect_activ::find($id);

        if(!is_null($sect_activs)){
            $sect_activs->delete();
        }
        session()->flash('success', 'Le secteur d\'activité supprimé avec succes !');
        return back();

        }

    }
}
