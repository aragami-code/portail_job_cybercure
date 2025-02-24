<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Evenements;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class EvenementsController extends Controller
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


        }elseif(!$this->user->can('article.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $Ev = Evenements::all();
            $parametre = Parametres::first();
        return view('backend.pages.evenements.index', compact('Ev','parametre'));


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


        }elseif(!$this->user->can('article.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $parametre = Parametres::first();
            return view('backend.pages.evenements.create', compact('parametre'));


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


        }elseif(!$this->user->can('article.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $request->validate([

            'name_evenement' => 'required|max:100',
            'sommaire_evenement' => 'required',
            'image_evenement' => 'required|mimes:jpeg,bmp,png,jpg',
            'date_evenement'=> 'required'

            ],

            ['name_evenement.required' => 'Le nom est obligatoire.',
            'sommaire_evenement.required' => 'ce champs est obligatoire.',
            'image_evenement.required' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
            'date_evenement.required' => 'la date de l\'evenement est obligtoire']);



            // creer un nouvel Utilisateur
            $Evenement = new Evenements();
            $Evenement->name_evenement = $request->name_evenement;
            $Evenement->sommaire_evenement = $request->sommaire_evenement;
            $Evenement->image_evenement = $request->image_evenement;
            $Evenement->date_evenement = $request->date_evenement;

            if($request->hasfile('image_evenement')){
                $file = $request->file('image_evenement');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('backend/images/blog/', $filename);
                $Evenement->image_evenement = $filename;
                }else{
                    return $request;
                    $Evenement->image_evenement ='';
                }

            $Evenement->save();


        session()->flash('success', 'Evenement ajouté avec succès.');
        return redirect()->route('admin.evenement.index');

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


        }elseif(!$this->user->can('article.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $Evenement = Evenements::find($id);
        $parametre = Parametres::first();
        return view('backend.pages.evenements.edit', compact('Evenement','parametre'));

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


        }elseif(!$this->user->can('article.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $request->validate([

                'name_evenement' => 'required|max:100',
                'sommaire_evenement' => 'required',
                'image_evenement' => 'required|mimes:jpeg,bmp,png,jpg',
                'date_evenement'=> 'required'

                ],

                ['name_evenement.required' => 'Le nom est obligatoire.',
                'sommaire_evenement.required' => 'ce champs est obligatoire.',
                'image_evenement.required' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
                'date_evenement.required' => 'la date de l\'evenement est obligtoire']);



                // creer un nouvel Utilisateur
                $Evenement = new Evenements();
                $Evenement->name_evenement = $request->name_evenement;
                $Evenement->sommaire_evenement = $request->sommaire_evenement;
                $Evenement->image_evenement = $request->image_evenement;
                $Evenement->date_evenement = $request->date_evenement;

        if($request->hasfile('image_evenement')){
            $file = $request->file('image_evenement');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/images/blog/', $filename);
            $Evenement->image_evenement = $filename;
              }else{
                $img = $request->input('image_evenement2');
                DB::update('update evenement set image_evenement = ? where id = ?', [$img,$id]);
              }

        $Evenement->save();

         session()->flash('success', 'Evenement  modifié avec succes.');
         return redirect()->route('admin.evenement.index');

        }



/*
*/




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


        }elseif(!$this->user->can('article.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $Evenement = Evenements::find($id);

        if(!is_null($Evenement)){
            $Evenement->delete();
        }
        session()->flash('success', 'Evenement supprimé avec succès.');
        return back();

        }

    }
}
