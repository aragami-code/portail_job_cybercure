<?php

namespace App\Http\Controllers\Chercheur;

use App\Http\Controllers\Controller;
use App\Regions;
use App\Villes;
use Illuminate\Support\Facades\Crypt;

use App\Emploi_Postuler;
use App\JobFav;
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
            $this->user = Auth::guard('chercheur')->user();
            return $next($request);

        });
    }


    public function index()
    {



        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{
 /*           dd('ok');

        $total_roles = count(Role::select('id')->get());
        $total_admins = count(Admin::select('id')->get());
        $total_users = count(User::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());
        $total_articles = count(Articles::select('id')->get());*/
       //$Emplois_Postuler = Post_Emploi::paginate(1);
       //$data['experiences'] = Experience_pro::orderBy('id','desc')->where('user_id',Auth::guard('chercheur')->user()->id)->paginate(8);

        $Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->select('post__emplois.titre_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.DL','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->get();
        //    $PostEmplois = Post_Emploi::all();



        $Region = Regions::all();

        $parametre = Parametres::first();

        return view('chercheur.pages.dashboard.index', compact('Emplois_Postuler','Region','parametre'));



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



    public function findEtat($id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{
            $region = Regions::where('etat_id',$id)->pluck("nom_region","id");


            return json_encode($region);



        }


    }




    public function findRegion($id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

              $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

                return json_encode($ville);



        }


    }

    public function favori(Request $request)
    {


       if(is_null($this->user)){
        $parametre = Parametres::first();
        return view('chercheur.auth.login',compact('parametre'));


    }else{

               $request->validate([

                'id_job' => 'required','id_user' => 'required',

            ],

            [
                'id_job.required' => 'Le Message est necessaire.',
                'id_user.required' => 'Le Message est necessaire.',

            ]);

          // activer

          $Poe = new JobFav();
          $Poe->id_job = $request->id_job;
          $Poe->id_user = $request->id_user;



         $test = count(JobFav::select('id_job')->where('id_user',[$request->id_user])->where('id_job',[$request->id_job])->get());


         if ($test > 0) {
             # code..
              session()->flash('warning', 'Attention vous avez déja choisi cette emploi comme favori!');
               return back();
         }else{
            $Poe->save();

              session()->flash('success', 'Emploi  Ajouté comme favori.');
              return back();
         }

        }

    }

    public function unfavori(Request $request)
    {

  /*      if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

          // activer
          $poe = JobFav::find($id);
          DB::delete('delete JobFav where id = ?', [$id]);
          $poe->save();

         session()->flash('success', 'emploi retiré comme favoris.');

         //return view('chercheur.pages.profile.',compact('user'));
        // return redirect()->route('backend.pages.postemplois.edit');
         return back();

        }
*/
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
        $parametre = Parametres::first();
        return view('chercheur.auth.login',compact('parametre'));


    }else{

               $request->validate([

            'lettre' => 'required',

            ],

            [
                'lettre.required' => 'Le Message est necessaire.',

            ]);



        // creer un nouvel Utilisateur
        $PostEmplois = new Emploi_Postuler();
        $PostEmplois->user_id = $request->user_id;
        $PostEmplois->post_emploi_id = $request->post_emploi_id;
        $PostEmplois->lettre = $request->lettre;
        $test = count(Emploi_Postuler::select('post_emploi_id')->where('user_id',[$request->user_id])->where('post_emploi_id',[$request->post_emploi_id])->get());


            if ($test > 0) {
                # code..
                 session()->flash('warning', 'Attention vous avez déja postulé à cette offre nous vous contacterons si votre profil est retenu!');
                  return back();
            }else{
                 $PostEmplois->save();

                        session()->flash('success', 'votre demande à postuler a été envoyé avec succès nous vous contacterons si votre profil est retenu!');
                        return redirect()->route('chercheur.dashboard');
            }

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




        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

        }
    }


    public function emploispostuler($id){


        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{
            $id = Crypt::decrypt($id);
          $Emplois_ostuler = DB::select('select distinct user_id,post_emploi_id,titre_post_emploi from post__emplois, emploi__postulers where user_id = ? and emploi__postulers.post_emploi_id = post__emplois.id', [$id]);


          $parametre = Parametres::first();
          return view('chercheur.pages.emploipostuler.emplois_postuler', compact('Emplois_ostuler','parametre'));
        }

    }


    public function emploisfavori($id){


        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{
            $id = Crypt::decrypt($id);
          $Emplois_fav = DB::select('select distinct post__emplois.id,id_user,id_job,titre_post_emploi from post__emplois, job_favs where id_job = post__emplois.id', [$id]);


          $parametre = Parametres::first();
          return view('chercheur.pages.emploipostuler.favori', compact('Emplois_fav','parametre'));
        }

    }




    public function listOffre()
    {



        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{
        $Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->select('post__emplois.titre_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.DL','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->get();
        //    $PostEmplois = Post_Emploi::all();

        $Region = Regions::all();

        $parametre = Parametres::first();

        return view('chercheur.pages.postemplois.index', compact('Emplois_Postuler','Region','parametre'));



        }
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
            return view('chercheur.auth.login');


        }else{


        $id = Crypt::decrypt($id);
        $PostEmplis = Post_Emploi::find($id);
        /*$PostEmplois =  DB::table('post__emplois')
        ->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
        ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.sectas_post_emploi')
        ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
        ->select('post__emplois.titre_post_emploi','contrat_emps.contrat_empl','typ_emps.type_empl','post__emplois.description_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','sect_activs.nom_secteur','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')
        ->where('post__emplois.id',$id)->first();*//**/
        $PostEmplois = DB::table('post__emplois')
        ->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
        ->select('post__emplois.titre_post_emploi','post__emplois.slug_post_emploi','post__emplois.DL','typ_emps.type_empl','post__emplois.description_post_emploi','post__emplois.ex_prof_post_emploi','post__emplois.DL','post__emplois.description_post_emploi','post__emplois.created_at','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')
        ->where('post__emplois.id',$id)->first();

        $parametre = Parametres::first();

        return view('chercheur.pages.postemplois.edit', compact('PostEmplois','PostEmplis','parametre'));


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
$request->validate([

    'titre_post_emploi' => 'required|max:100',
    'slug_post_emploi'  => 'required|max:100',
    'contrat_post_emploi'  => 'required',
    'sectas_post_emploi'  => 'required',
    'typemp_post_emploi'  => 'required',
   // 'description_post_emploi'  => 'required',
    //'mode_de_paie_post_emploi'  => 'required',
    'salaire_min_post_emploi'  => 'required|max:6',
    'salaire_max_post_emploi'  => 'required|max:6',
    'id_formation_post_emploi'  => 'required',
    'ex_prof_post_emploi'  => 'required',
    //'sex_post_emploi'  => 'required',
    //'nombre_place_post_emploi'  => 'required|max:3',
    'tache_post_emploi'  => 'required',
    //'id_etat_post_emploi'  => 'required',
    'id_region_post_emploi'  => 'required',
    'id_ville_post_emploi'  => 'required',
    //'adresse_post_emploi'  => 'required',
    'id_admin'  => 'required',
     'DL'  => 'required',
    ],

    [
        'titre_post_emploi.required' => 'le titre est necessaire',
        'slug_post_emploi.required'  => 'les mots clés sont necessaire',
        'contrat_post_emploi.required'  => 'veuillez choisir un contrat',
        'sectas_post_emploi.required'  => 'veuillez choisir le secteur activité correspondant au post',
        'typemp_post_emploi.required'  => 'type emplois necessaire',
      //  'description_post_emploi.required'  => 'veuillez inserer une description',
        'mode_de_paie_post_emploi.required'  => 'mode de payement obligatoire',
        'salaire_min_post_emploi.required'  => 'salaire minimum',
        'salaire_max_post_emploi.required'  => 'salaire maximun',
        'id_formation_post_emploi.required'  => 'veuillez entrer une formation',
        'ex_prof_post_emploi.required'  => 'experience professionnelle est obligatoire',
        'sex_post_emploi.required'  => 'choisir le genre',
        'nombre_place_post_emploi.required'  => 'veuillez entrer le nombre de place',
        'tache_post_emploi.required'  => 'veuillez entrer les taches',
        'id_etat_post_emploi.required'  => 'veuillez entrer un Etat',
        'id_region_post_emploi.required'  => 'veuillez entrer une region ou province',
        'id_ville_post_emploi.required'  => 'veuillez entrer une ville',
        'adresse_post_emploi.required'  => 'veuillez une addresse',
        'id_admin.required'  => 'veuillez le nom de la personne qui publie cette offre',
        'DL.required'  => 'veuillez entrer la date limite pour postuler pour  cette offre',
    ]);



        // creer un nouvel Utilisateur
        $PostEmplois = Post_Emploi::find($id);
        $PostEmplois->titre_post_emploi = $request->titre_post_emploi;
        $PostEmplois->slug_post_emploi = $request->slug_post_emploi;
        $PostEmplois->contrat_post_emploi = $request->contrat_post_emploi;
        $PostEmplois->sectas_post_emploi = $request->sectas_post_emploi;
        $PostEmplois->typemp_post_emploi = $request->typemp_post_emploi;
        $PostEmplois->description_post_emploi = $request->description_post_emploi;
        $PostEmplois->mode_de_paie_post_emploi = $request->mode_de_paie_post_emploi;
        $PostEmplois->salaire_min_post_emploi = $request->salaire_min_post_emploi;
        $PostEmplois->salaire_max_post_emploi = $request->salaire_max_post_emploi;
        $PostEmplois->id_formation_post_emploi = $request->id_formation_post_emploi;
        $PostEmplois->ex_prof_post_emploi = $request->ex_prof_post_emploi;
        $PostEmplois->sex_post_emploi = $request->sex_post_emploi;
        $PostEmplois->nombre_place_post_emploi = $request->nombre_place_post_emploi;
        $PostEmplois->tache_post_emploi = $request->tache_post_emploi;
        $PostEmplois->id_etat_post_emploi = $request->id_etat_post_emploi;
        $PostEmplois->id_region_post_emploi = $request->id_region_post_emploi;
        $PostEmplois->id_ville_post_emploi = $request->id_ville_post_emploi;
        $PostEmplois->adresse_post_emploi = $request->adresse_post_emploi;
        $PostEmplois->id_admin = $request->id_admin;
        $PostEmplois->DL = $request->DL;
        $PostEmplois->save();

         session()->flash('success', ' Emploi  a été modifié avec succes !');
         return redirect()->route('chercheur.postemplois.index');
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
            return view('chercheur.auth.login');


        }else{

             $PostEmplois = Post_Emploi::find($id);


        if(!is_null($PostEmplois)){
            $PostEmplois->delete();
        }
        session()->flash('success', '  Supprimé avec succes !');
        return back();
        }

    }
}
