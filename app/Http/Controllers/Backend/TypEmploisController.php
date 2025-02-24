<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Parametres;
use App\TypEmp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class TypEmploisController extends Controller
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


        }elseif(!$this->user->can('typemp.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $TypEmps = TypEmp::all();
            $parametre = Parametres::first();
        return view('backend.pages.typemplois.index', compact('TypEmps','parametre'));

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


        }elseif(!$this->user->can('typemp.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $parametre = Parametres::first();

             return view('backend.pages.typemplois.create',compact('parametre'));


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


    }elseif(!$this->user->can('typemp.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{


        $request->validate([

            'type_empl' => 'required'


            ],

            ['type_empl.required' => 'Le nom est obligatoire.']);


        // creer un nouvel Utilisateur
        $TypEmps = new TypEmp();
        $TypEmps->type_empl = $request->type_empl;
        $TypEmps->save();


       session()->flash('success', 'Type de travail ajouté avec succès !');
       return redirect()->route('admin.typemplois.index');

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


        }elseif(!$this->user->can('typemp.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $TypEmps = TypEmp::find($id);
            $parametre = Parametres::first();
            return view('backend.pages.typemplois.edit', compact('TypEmps','parametre'));


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


        }elseif(!$this->user->can('typemp.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $request->validate([

            'type_empl' => 'required|max:100,'.$id,

            ],

            ['type_empl.required' => 'Le nom est obligatoire.',
            ]);

          // creer un nouvel Utilisateur
          $TypEmps = TypEmp::find($id);
          $TypEmps->type_empl = $request->type_empl;
         // $TypEmps->slug = $request->slug;
          $TypEmps->save();

         session()->flash('success', 'Le type de travail a été modifié avec succès !');
         return redirect()->route('admin.typemplois.index');
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


        $TypEmps = TypEmp::find($id);

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('typemp.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        if(!is_null($TypEmps)){
            $TypEmps->delete();
        }
        session()->flash('success', 'le type de travail supprimé avec succès !');
        return back();
        }

    }
}
