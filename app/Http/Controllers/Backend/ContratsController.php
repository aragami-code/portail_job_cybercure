<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ContratEmp;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class ContratsController extends Controller
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


        }elseif(!$this->user->can('type_contrat.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $ContratEmps = ContratEmp::all();
        $parametre = Parametres::first();
        return view('backend.pages.contrats.index', compact('ContratEmps','parametre'));

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


        }elseif(!$this->user->can('type_contrat.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $parametre = Parametres::first();

            return view('backend.pages.contrats.create',compact('parametre'));

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


    }elseif(!$this->user->can('type_contrat.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{


        $request->validate([

            'contrat_empl' => 'required'


            ],

            ['contrat_empl.required' => 'Le nom est obligatoire.']);


        // creer un nouvel Utilisateur
        $ContratEmps = new ContratEmp();
        $ContratEmps->contrat_empl = $request->contrat_empl;
        $ContratEmps->save();


       session()->flash('success', 'Type de contrat ajouté avec succès.');
       return redirect()->route('admin.contrats.index');

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


        }elseif(!$this->user->can('type_contrat.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

             $ContratEmps = ContratEmp::find($id);
             $parametre = Parametres::first();
            return view('backend.pages.contrats.edit', compact('ContratEmps','parametre'));


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


        }elseif(!$this->user->can('type_contrat.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

     $request->validate([

            'contrat_empl' => 'required|max:100,'.$id,

            ],

            ['contrat_empl.required' => 'Le nom est obligatoire.',
            /*'slug.required' => 'le slug est obligatoire (mot clé)'*/]);
            //'password.required' => 'le mot de passe est obligatoire commencer à partir de 8 caracteres'

          // creer un nouvel Utilisateur
          $ContratEmps = ContratEmp::find($id);
          $ContratEmps->contrat_empl = $request->contrat_empl;
         // $ContratEmps->slug = $request->slug;
          $ContratEmps->save();

         session()->flash('success', 'Contrat  modifié avec succès.');
         return redirect()->route('admin.contrats.index');
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


        }elseif(!$this->user->can('type_contrat.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $ContratEmps = ContratEmp::find($id);

        if(!is_null($ContratEmps)){
            $ContratEmps->delete();
        }
        session()->flash('success', 'Contrat supprimé avec succès.');
        return back();

        }

    }
}
