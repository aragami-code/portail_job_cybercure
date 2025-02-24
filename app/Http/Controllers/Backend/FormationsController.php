<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\FormationEmp;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class FormationsController extends Controller
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


        }elseif(!$this->user->can('type_formation.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

         $FormationEmps = FormationEmp::all();
         $parametre = Parametres::first();
        return view('backend.pages.formations.index', compact('FormationEmps','parametre'));

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


        }elseif(!$this->user->can('type_formation.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $parametre = Parametres::first();

        return view('backend.pages.formations.create',compact('parametre'));

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

    }elseif(!$this->user->can('type_formation.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{

            $request->validate([

            'formation_empl' => 'required'

            ],

            ['formation_empl.required' => 'Le nom est obligatoire.']);


        // creer un nouvel Utilisateur
        $FormationEmps = new FormationEmp();
        $FormationEmps->formation_empl = $request->formation_empl;
        $FormationEmps->save();
       session()->flash('success', 'Diplôme ajouté avec succes !');
       return redirect()->route('admin.formations.index');
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


        }elseif(!$this->user->can('type_formation.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $FormationEmps = FormationEmp::find($id);
        $parametre = Parametres::first();
        return view('backend.pages.formations.edit', compact('FormationEmps','parametre'));

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


        }elseif(!$this->user->can('type_formation.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $request->validate([

                'formation_empl' => 'required|max:100,'.$id,

                ],

                ['formation_empl.required' => 'Le nom est obligatoire.',
                /*'slug.required' => 'le slug est obligatoire (mot clé)'*/]);


              // creer un nouvel Utilisateur
              $FormationEmps = FormationEmp::find($id);
              $FormationEmps->formation_empl = $request->formation_empl;
             // $TypEmps->slug = $request->slug;
              $FormationEmps->save();

             session()->flash('success', 'Diplôme modifié avec succes !');
             return redirect()->route('admin.formations.index');
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


        }elseif(!$this->user->can('type_formation.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $FormationEmps = FormationEmp::find($id);

            if(!is_null($FormationEmps)){
                $FormationEmps->delete();
            }
            session()->flash('success', 'Diplôme supprimé avec succes !');
            return back();
        }

    }
}
