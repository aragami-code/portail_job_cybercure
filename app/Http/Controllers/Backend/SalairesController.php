<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Parametres;
use App\Salaires;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class SalairesController extends Controller
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


        }elseif(!$this->user->can('salaire.view')){
            abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


        }else{
        $Salaires = Salaires::all();
        $parametre = Parametres::first();
        return view('backend.pages.salaires.index', compact('Salaires','parametre'));

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


        }elseif(!$this->user->can('salaire.create')){
            abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


        }else{


            $parametre = Parametres::first();
          return view('backend.pages.salaire.create',compact('parametre'));


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

    }elseif(!$this->user->can('salaire.create')){
        abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


             }else{
            $request->validate([

            'plage_salaire' => 'required'


            ],

            ['plage_salaire.required' => 'le nom est obligatoire']);


        // creer un nouvel Utilisateur
        $Salaires = new Salaires();
        $Salaires->plage_salaire = $request->plage_salaire;
        $Salaires->save();


       session()->flash('success', 'la nouvelle plage salariale a été ajouter avec succes !');
       return redirect()->route('admin.salaires.index');

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


        }elseif(!$this->user->can('salaire.edit')){
            abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


        }else{

             $Salaires = Salaires::find($id);
             $parametre = Parametres::first();
        return view('backend.pages.salaires.edit', compact('Salaires','parametre'));


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


        }elseif(!$this->user->can('salaire.edit')){
            abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


        }else{

        $request->validate([

            'plage_salaire' => 'required|max:100,'.$id,


            ],

            ['plage_salaire.required' => 'le nom est obligatoire',
            /*'slug.required' => 'le slug est obligatoire (mot clé)'*/]);

          // creer un nouvel Utilisateur
          $Salaires = Salaires::find($id);
          $Salaires->plage_salaire = $request->plage_salaire;
         // $ContratEmps->slug = $request->slug;
          $Salaires->save();

         session()->flash('success', 'la plage salariale a été modifié avec succes !');
         return redirect()->route('admin.salaires.index');
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


        }elseif(!$this->user->can('salaire.delete')){
            abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


        }else{

            $Salaires = Salaires::find($id);

        if(!is_null($Salaires)){
            $Salaires->delete();
        }
            session()->flash('success', 'la plage salariale a été supprimé avec succes !');
        return back();


        }
    }
}
