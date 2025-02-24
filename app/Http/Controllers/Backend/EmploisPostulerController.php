<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Etats;
use App\Regions;
use App\Villes;
use App\sect_activ;
use App\TypEmp;
use App\ContratEmp;
use App\Emploi_Postuler;
use App\FormationEmp;
use App\JobFav;
use App\Parametres;
use App\Post_Emploi;
use App\NiveauEtude;
use App\Models\Chercheur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class EmploisPostulerController extends Controller
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


        }elseif(!$this->user->can('Emploi_Postuler.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $Emplois_Postuler = DB::table('emploi__postulers')->join('post__emplois','post__emplois.id','=','emploi__postulers.id')->select('post__emplois.titre_post_emploi','post__emplois.id','post__emplois.created_at')->orderBy('post__emplois.id','desc')->get();
            $parametre = Parametres::first();
            return view('backend.pages.emploipostuler.index', compact('Emplois_Postuler','parametre'));

        }
    }

    public function indexo()
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Emploi_Postuler.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

           // $Emplois_Postuler = DB::table('emploi__postulers')->join('post__emplois','post__emplois.id','=','emploi__postulers.id')->select('post__emplois.titre_post_emploi','post__emplois.id','post__emplois.created_at')->get();
            //$parametre = Parametres::first();
            return back();

        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Emploi_Postuler.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $Emplois_Postuler = DB::table('emploi__postulers')
            ->join('chercheurs','chercheurs.id','=','emploi__postulers.user_id')
            ->select('chercheurs.name','emploi__postulers.created_at','emploi__postulers.is_selected','emploi__postulers.user_id','emploi__postulers.user_id','chercheurs.nom_famille','chercheurs.prenom','chercheurs.photo','chercheurs.resume_cv')
            ->where('emploi__postulers.post_emploi_id','=', $id)->get();
            //$PostEmplois




            $id1 = 1;

            $data['Emplois_Postule'] = DB::table('emploi__postulers')
            ->join('chercheurs','chercheurs.id','=','emploi__postulers.user_id')
            ->select('chercheurs.name',
                    'emploi__postulers.created_at',
                    'emploi__postulers.is_selected',
                    'emploi__postulers.user_id',
                    'emploi__postulers.is_interviewed',
                    'chercheurs.nom_famille',
                    'chercheurs.prenom',
                    'chercheurs.telephone',
                    'chercheurs.email',
                    'chercheurs.resume_cv',
                    'chercheurs.photo')

            ->where('emploi__postulers.is_selected','=', $id1)
            ->where('emploi__postulers.post_emploi_id','=', $id)->paginate(8);

           // $data['experiences'] = Experience_pro::orderBy('id','desc')->where('user_id',Auth::guard('chercheur')->user()->id)->paginate(8);

            //$PostEmplois
/*
            $user = Chercheur::first();
            $diplome = DB::table('niveau_etudes')
            ->join('chercheurs','chercheurs.id','=','niveau_etudes.user_id')
             ->select('niveau_etudes.titre_niveau','niveau_etudes.option','niveau_etudes.institution','niveau_etudes.annee',
            )->where('niveau_etudes.user_id',$id)->get();

            $Exp = DB::table('experience_pros')
            ->join('chercheurs','chercheurs.id','=','experience_pros.user_id')
             ->select('experience_pros.titre_job','experience_pros.entreprise','experience_pros.date_debut','experience_pros.date_fin','experience_pros.mission',
            )->where('experience_pros.user_id',$id)->get();

            $Compe = DB::table('competences')
            ->join('chercheurs','chercheurs.id','=','competences.user_id')
             ->select('competences.competences_user','competences.niveau',
            )->where('competences.user_id',$id)->get();

            $Lang = DB::table('langues')
            ->join('chercheurs','chercheurs.id','=','langues.user_id')
             ->select('langues.langue','langues.niveau',
            )->where('langues.user_id',$id)->get();


*/


           // $Emplois_Postuler = Emploi_Postuler::all();

           $parametre = Parametres::first();
            return view('backend.pages.emploipostuler.listpostulantOffres', compact('Emplois_Postuler','parametre'),$data);

        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {/**/
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $PostEmplois = Post_Emploi::find($id);
        $Etat = Etats::all();
        $Region = Regions::all();
        $Ville = Villes::all();
        $sectas = sect_activ::all();
        $typemp = TypEmp::all();
        $contratemp = ContratEmp::all();
        $formationemp = FormationEmp::all();
        $parametre = Parametres::first();

        return view('backend.pages.postemplois.edit', compact('PostEmplois','Etat','Region','Ville','sectas','typemp','contratemp','formationemp','parametre'));


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
            return view('chercheur.auth.login');


        }else{

          // activer
          $user = Emploi_Postuler::find($id);
          DB::update('update emploi__postulers set is_selected = 1 where user_id = ?',[$id]);
          $user->save();

         session()->flash('success', 'Emploi selectionné avec succès.');

         //return view('chercheur.pages.profile.',compact('user'));
        // return redirect()->route('backend.pages.postemplois.edit');
         return back();


        }

    }

    public function up1(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

          // activer
          $user = Emploi_Postuler::find($id);
          DB::update('update emploi__postulers set is_selected = 0 where user_id = ?',[$id]);
          $user->save();

         session()->flash('success', 'Utilisateur décoché avec succès.');

         //return view('chercheur.pages.profile.',compact('user'));
        // return redirect()->route('backend.pages.postemplois.edit');
         return back();

        }

    }



    public function upsel(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

          // activer
          $user = Emploi_Postuler::find($id);
          DB::update('update emploi__postulers set is_interviewed = 1 where user_id = ?',[$id]);
          $user->save();

         session()->flash('success', 'Interview éffectuée avec succès pour cet utilisateur.');

         //return view('chercheur.pages.profile.',compact('user'));
        // return redirect()->route('backend.pages.postemplois.edit');
         return back();

        }

    }

    public function upsel1(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

          // activer
          $user = Emploi_Postuler::find($id);
          DB::update('update emploi__postulers set is_interviewed = 0 where user_id = ?',[$id]);
          $user->save();

         session()->flash('success', 'Interview éffectuée avec succes pour cet utilisateur.');

         //return view('chercheur.pages.profile.',compact('user'));
        // return redirect()->route('backend.pages.postemplois.edit');
         return back();

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

    }
}
