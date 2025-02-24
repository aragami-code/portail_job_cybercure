<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Etats;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class EtatsController extends Controller
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


        }elseif(!$this->user->can('GLE.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $Etats = Etats::all();
        $parametre = Parametres::first();
        return view('backend.pages.etats.index', compact('Etats','parametre'));



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


        }elseif(!$this->user->can('GLE.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $parametre = Parametres::first();
         return view('backend.pages.etats.create',compact('parametre'));


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


    }elseif(!$this->user->can('GLE.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{

    $request->validate([

            'nom_etat' => 'required',
            'slug_etat' => 'required',
            'code_etat'  => 'required',
            'code_etat_tel' => 'required'

            ],

            [
            'nom_secteur.required' => 'Le nom du secteur d\'activité est obligatoire.',
            'slug_etat.required' => 'Le slug est obligatoire.',
            'code_etat.required' => 'Le code Etat est obligatoire.',
            'code_etat_tel.required' => 'Le code téléphonique est obligatoire.'

            ]);


        // creer un nouvel Utilisateur
        $Etats = new Etats();
        $Etats->nom_etat = $request->nom_etat;
        $Etats->slug_etat = $request->slug_etat;
        $Etats->code_etat = $request->code_etat;
        $Etats->code_etat_tel = $request->code_etat_tel;
        $Etats->status = $request->status;
        $Etats->save();


       session()->flash('success', 'Etat ajouté avec succes !');
       return redirect()->route('admin.etats.index');


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


        }elseif(!$this->user->can('GLE.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


             $Etats = Etats::find($id);
             $parametre = Parametres::first();

        return view('backend.pages.etats.edit', compact('Etats','parametre'));

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


        }elseif(!$this->user->can('GLE.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $request->validate([

            'nom_etat' => 'required|max:100,'.$id,
            'slug_etat' => 'required',
            'code_etat'  => 'required',
            'code_etat_tel' => 'required'
            ],

            [

                'nom_secteur.required' => 'Le nom du secteur d\'activité est obligatoire.',
                'slug_etat.required' => 'Le slug est obligatoire.',
                'code_etat.required' => 'Le code Etat est obligatoire.',
                'code_etat_tel.required' => 'Le code téléphonique est obligatoire.'

            ]);
            //'password.required' => 'le mot de passe est obligatoire commencer à partir de 8 caracteres'

          // creer un nouvel Utilisateur
          $Etats = Etats::find($id);
          $Etats->nom_etat = $request->nom_etat;
          $Etats->slug_etat = $request->slug_etat;
          $Etats->code_etat = $request->code_etat;
          $Etats->code_etat_tel = $request->code_etat_tel;
          $Etats->status = $request->status;
          $Etats->save();

         session()->flash('success', 'Etat modifié avec succes !');
         return redirect()->route('admin.etats.index');

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


        }elseif(!$this->user->can('GLE.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{


            $Etats = Etats::find($id);


        if(!is_null($Etats)){
            $Etats->delete();
        }
        session()->flash('success', 'Etat supprimé avec succes !');
        return back();

        }


    }
}
