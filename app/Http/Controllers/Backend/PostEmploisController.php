<?php

namespace App\Http\Controllers\Backend;

use App\Competences;
use App\Http\Controllers\Controller;
use App\Etats;
use App\Regions;
use App\Villes;
use App\sect_activ;
use App\TypEmp;
use App\ContratEmp;
use App\FormationEmp;
use App\Models\Chercheur;
use App\Parametres;
use App\Post_Emploi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class PostEmploisController extends Controller
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


        }elseif(!$this->user->can('Post_Emploi.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            // = Post_Emploi::;
         $PostEmplois   = DB::select('select * from  post__emplois ORDER BY id DESC');


            $parametre = Parametres::first();






            return view('backend.pages.postemplois.index', compact('PostEmplois','parametre'));

        }
    }






    public function indexL()
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            // = Post_Emploi::;
         $PostEmplois   = DB::select('select * from  post__emplois ORDER BY id DESC');


            $parametre = Parametres::first();






            return view('backend.pageL.postemplois.index', compact('PostEmplois','parametre'));

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


        }elseif(!$this->user->can('Post_Emploi.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        $PostEmplois = Post_Emploi::all();
        $Etat = Etats::all();
        $Region = Regions::all();
        $Ville = Villes::all();
        $sectas = sect_activ::all();
        $typemp = TypEmp::all();
        $contratemp = ContratEmp::all();
        $formationemp = FormationEmp::all();
      //  $permission_groups = User::getpermissionGroups();
       // dd( $permission_groups);
       $parametre = Parametres::first();
        return view('backend.pages.postemplois.create', compact('PostEmplois','Etat','Region','Ville','sectas','typemp','contratemp','formationemp','parametre'));


        }


    }



    public function findEtat($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $region = Regions::where('etat_id',$id)->pluck("nom_region","id");


            return json_encode($region);



        }


    }


    public function findEtatEdit($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $region = Regions::where('etat_id',$id)->pluck("nom_region","id");


            return json_encode($region);



        }


    }

    public function findRegion($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

              $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

                return json_encode($ville);



        }


    }


    public function findRegions($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

              $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

                return json_encode($ville);



        }


    }

    public function findRegionEdit($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

              $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

                return json_encode($ville);



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


    }elseif(!$this->user->can('Post_Emploi.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{

               $request->validate([

            'titre_post_emploi' => 'required|max:100',
            'slug_post_emploi'  => 'required|max:100',
            'contrat_post_emploi'  => 'required',
            'sectas_post_emploi'  => 'required',
            'typemp_post_emploi'  => 'required',
            'description_post_emploi'  => 'required',
            'salaire_min_post_emploi'  => 'required|max:6',
            'salaire_max_post_emploi'  => 'required|max:6',
            'id_formation_post_emploi'  => 'required',
            'ex_prof_post_emploi'  => 'required',
            //'sex_post_emploi'  => 'required',
            //'nombre_place_post_emploi'  => 'required|max:3',
            'tache_post_emploi'  => 'required',
            'id_region_post_emploi'  => 'required',
            'id_ville_post_emploi'  => 'required',
            'profil_post_emploi'  => 'required',
            'DL'=>'required'
            ],

            [
                'titre_post_emploi.required' => 'Le titre est necessaire.',
                'slug_post_emploi.required'  => 'Les mots clés sont necessaire.',
                'contrat_post_emploi.required'  => 'Veuillez choisir un contrat.',
                'sectas_post_emploi.required'  => 'Veuillez choisir le secteur d\'activité correspondant au poste.',
                'typemp_post_emploi.required'  => 'Le type d\'emploi necessaire.',
                'description_post_emploi.required'  => 'Veuillez inserer une description',
                'salaire_min_post_emploi.required'  => 'Salaire minimum obligatoire.',
                'salaire_max_post_emploi.required'  => 'Salaire maximun obligatoire.',
                'id_formation_post_emploi.required'  => 'Veuillez choisir un diplôme.',
                'ex_prof_post_emploi.required'  => 'Experience professionnelle est obligatoire.',
               // 'sex_post_emploi.required'  => 'choisir le genre',
                //'nombre_place_post_emploi.required'  => 'veuillez entrer le nombre de place',
                'tache_post_emploi.required'  => 'Veuillez entrer les différentes missions concernant l\'offre que vous voulez poster.',
                'id_region_post_emploi.required'  => 'Veuillez choisir une region.',
                'id_ville_post_emploi.required'  => 'Veuillez choisir un département.',
                'profil_post_emploi.required'  => 'Veuillez entrer les informations du profil souhaité pour cette offre.',
                'DL.required' => 'Veuillez entrer la date limite pour les prise de candidature pour l\'offre',
                   ]);



        // creer un nouvel post
        $PostEmplois = new Post_Emploi();
        $PostEmplois->titre_post_emploi = $request->titre_post_emploi;
        $PostEmplois->slug_post_emploi = $request->slug_post_emploi;
        $PostEmplois->contrat_post_emploi = $request->contrat_post_emploi;
        $PostEmplois->sectas_post_emploi = $request->sectas_post_emploi;
        $PostEmplois->typemp_post_emploi = $request->typemp_post_emploi;
        $PostEmplois->description_post_emploi = $request->description_post_emploi;
        $PostEmplois->salaire_min_post_emploi = $request->salaire_min_post_emploi;
        $PostEmplois->salaire_max_post_emploi = $request->salaire_max_post_emploi;
        $PostEmplois->id_formation_post_emploi = $request->id_formation_post_emploi;
        $PostEmplois->ex_prof_post_emploi = $request->ex_prof_post_emploi;
        //$PostEmplois->sex_post_emploi = $request->sex_post_emploi;
        //$PostEmplois->nombre_place_post_emploi = $request->nombre_place_post_emploi;
        $PostEmplois->DL = $request->DL;
        $PostEmplois->tache_post_emploi = $request->tache_post_emploi;
        $PostEmplois->id_region_post_emploi = $request->id_region_post_emploi;
        $PostEmplois->id_ville_post_emploi = $request->id_ville_post_emploi;
          $PostEmplois->profil_post_emploi = $request->profil_post_emploi;
        $PostEmplois->id_admin = $request->id_admin;
        $PostEmplois->save();


       session()->flash('success', 'le nouvel utilisateur a été ajouter avec succes !');
       return redirect()->route('admin.postemplois.index');


    }

    }






    public function resultatRecherche(Request $request){



        $Region = Regions::all();
        $Ville = Villes::all();
        $sectas = sect_activ::all();
        $typemp = TypEmp::all();
        $contratemp = ContratEmp::all();
        $formationemp = FormationEmp::all();
        $com = Competences::all();
        $user = Chercheur::all()->where('');
$PostEmplois = new Chercheur();
$PostEmplois->metier = $request->metier;
$PostEmplois->genre = $request->genre;
$PostEmplois->age = $request->age;
$PostEmplois->statut_marital = $request->statut_marital;
$PostEmplois->type_emploi_sollicite = $request->type_emploi_sollicite;
$PostEmplois->type_contrat_sollicite = $request->type_contrat_sollicite;
$PostEmplois->distance_minimum = $request->distance_minimum;
$PostEmplois->region = $request->region;
$PostEmplois->ville = $request->ville;
$PostEmplois->experience = $request->experience;
$PostEmplois->niveau_ecole = $request->niveau_ecole;
//$cmp = new Competences();
//$cmp->competences_user = $request->competences_user;
//$PostEmplois->photo;



          $cher = DB::select("select * from chercheurs WHERE metier LIKE '%$PostEmplois->metier%' OR genre  LIKE '%$PostEmplois->genre%' OR age  LIKE '%$PostEmplois->age%' or statut_marital  LIKE '%$PostEmplois->statu_marital%' OR type_emploi_sollicite  LIKE '%$PostEmplois->type_emploi_sollicite%'  OR type_contrat_sollicite  LIKE '%$PostEmplois->type_contrat_sollicite%' OR distance_minimum  LIKE '%$PostEmplois->distance_minimum%' OR region LIKE '%$PostEmplois->region%' OR ville  LIKE '%$PostEmplois->ville%' OR experience  LIKE '%$PostEmplois->experience%' OR niveau_ecole  LIKE '%$PostEmplois->niveau_ecole%'");
           // $chercheur = Chercheur::select('drop table users');
          //$PostEmplois

         // $Emplois_Postuler = Emploi_Postuler::all();
     // $tet =   DB::select('select * from users where active = ?', [1]);


         // $Emplois_Postuler = Emploi_Postuler::all();
         $parametre = Parametres::first();
          return view('backend.pages.postemplois.search', compact('cher','parametre','Region','Ville','sectas','typemp','contratemp','formationemp'));






    }




    public function matcher()
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Emploi_Postuler.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

 $PostEmplois = Post_Emploi::all();
$Etat = Etats::all();
$Region = Regions::all();
$Ville = Villes::all();
$sectas = sect_activ::all();
$typemp = TypEmp::all();
$contratemp = ContratEmp::all();
$formationemp = FormationEmp::all();
$commp = Competences::all();
//  $permission_groups = User::getpermissionGroups();
// dd( $permission_groups);
$parametre = Parametres::first();
return view('backend.pages.postemplois.matcher', compact('PostEmplois','Region','Ville','sectas','typemp','contratemp','formationemp','commp','parametre'));
//return view('backend.pages.postemplois.rechercher', compact('PostEmplois','Etat','Region','Ville','sectas','typemp','contratemp','formationemp'));


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


        }elseif(!$this->user->can('Post_Emploi.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $PostEmplois = Post_Emploi::find($id);
        //$Etat = Etats::all();
        $Region = Regions::all();
        $user = Chercheur::all();
        $sectas = sect_activ::all();
        $typemp = TypEmp::all();
        $contratemp = ContratEmp::all();
        $formationemp = FormationEmp::all();
        $parametre = Parametres::first();
    //    abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');
    return view('backend.pages.postemplois.edit', compact('PostEmplois','Region','sectas','typemp','contratemp','formationemp','user','parametre'));

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


        }elseif(!$this->user->can('Post_Emploi.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
$request->validate([

    'titre_post_emploi' => 'required|max:100',
    //'slug_post_emploi'  => 'required|max:100',
    'contrat_post_emploi'  => 'required',
    'sectas_post_emploi'  => 'required',
    'typemp_post_emploi'  => 'required',
    'description_post_emploi'  => 'required',
    'salaire_min_post_emploi'  => 'required|max:6',
    'salaire_max_post_emploi'  => 'required|max:6',
    'id_formation_post_emploi'  => 'required',
    'ex_prof_post_emploi'  => 'required',
    //'sex_post_emploi'  => 'required',
    //'nombre_place_post_emploi'  => 'required|max:3',
    'tache_post_emploi'  => 'required',
    'id_region_post_emploi'  => 'required',
    'id_ville_post_emploi'  => 'required',
    'profil_post_emploi'  => 'required',
    'id_admin'  => 'required', 'DL'  => 'required',
    ],

    [
        'titre_post_emploi.required' => 'Le titre est necessaire.',
       // 'slug_post_emploi.required'  => 'les mots clés sont necessaire',
        'contrat_post_emploi.required'  => 'Veuillez choisir un contrat.',
        'sectas_post_emploi.required'  => 'Veuillez choisir le secteur d\'activité correspondant à l\'offre que vous modifiez.',
        'typemp_post_emploi.required'  => 'Type emploi obligatoire.',
        'description_post_emploi.required'  => 'Veuillez inserer une description.',
        'salaire_min_post_emploi.required'  => 'Salaire minimum.',
        'salaire_max_post_emploi.required'  => 'Salaire maximun.',
        'id_formation_post_emploi.required'  => 'Veuillez choisir un Diplôme.',
        'ex_prof_post_emploi.required'  => 'L\'Experience professionnelle est obligatoire.',
        //'sex_post_emploi.required'  => 'choisir le genre',
      //  'nombre_place_post_emploi.required'  => 'veuillez entrer le nombre de place',
        'tache_post_emploi.required'  => 'Veuillez entrer les missions concernant l\'offre que vous modifiez.',
        'id_region_post_emploi.required'  => 'Veuillez entrer une region.',
        'id_ville_post_emploi.required'  => 'Veuillez entrer un  departement.',
        'profil_post_emploi.required'  => 'Veuillez entrer un profil utilisateur pour cette offre.',
        'DL.required' => 'Veuillez entrer la date limite pour les prise de candidature pour l\'offre',
       ]);



        // creer un nouvel Utilisateur
        $PostEmplois = Post_Emploi::find($id);
        $PostEmplois->titre_post_emploi = $request->titre_post_emploi;
        $PostEmplois->slug_post_emploi = $request->slug_post_emploi;
        $PostEmplois->contrat_post_emploi = $request->contrat_post_emploi;
        $PostEmplois->sectas_post_emploi = $request->sectas_post_emploi;
        $PostEmplois->typemp_post_emploi = $request->typemp_post_emploi;
        $PostEmplois->description_post_emploi = $request->description_post_emploi;
        $PostEmplois->salaire_min_post_emploi = $request->salaire_min_post_emploi;
        $PostEmplois->salaire_max_post_emploi = $request->salaire_max_post_emploi;
        $PostEmplois->id_formation_post_emploi = $request->id_formation_post_emploi;
        $PostEmplois->ex_prof_post_emploi = $request->ex_prof_post_emploi;
        //$PostEmplois->sex_post_emploi = $request->sex_post_emploi;
        //$PostEmplois->nombre_place_post_emploi = $request->nombre_place_post_emploi;
        $PostEmplois->DL = $request->DL;
        $PostEmplois->tache_post_emploi = $request->tache_post_emploi;
        $PostEmplois->id_region_post_emploi = $request->id_region_post_emploi;
        $PostEmplois->id_ville_post_emploi = $request->id_ville_post_emploi;
        $PostEmplois->profil_post_emploi = $request->profil_post_emploi;
             $PostEmplois->save();

         session()->flash('success', 'Offre modifié avec succes !');
         return redirect()->route('admin.postemplois.index');
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


        }elseif(!$this->user->can('Post_Emploi.delete')){
            abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


        }else{

             $PostEmplois = Post_Emploi::find($id);


        if(!is_null($PostEmplois)){
            $PostEmplois->delete();
        }
        session()->flash('success', 'Offre  supprimé avec succès !');
        return back();
        }

    }


    public function getMotCle($id)
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

             $PostEmplois = Post_Emploi::find($id);
             $Mat =  $PostEmplois->slug_post_emploi;
             $pars = explode(",",$Mat);
             foreach($pars as $part){
                 echo"<li>";
                 echo trim($part).",";
                 echo"</li>";
             }

        }

    }
}
