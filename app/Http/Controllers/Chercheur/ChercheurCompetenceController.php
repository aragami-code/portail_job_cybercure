<?php

namespace App\Http\Controllers\Chercheur;

use App\Http\Controllers\Controller;
use App\Regions;
use App\Villes;
use Illuminate\Support\Facades\Crypt;

use App\Emploi_Postuler;
use App\Parametres;
use App\Post_Emploi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class ChercheurCompetenceController extends Controller
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
            $parametre = Parametres::first();
        return view('chercheur.auth.login',compact('parametre'));


        }else{
        $parametre = Parametres::first();

        return view('chercheur.pages.cv.index',compact('parametre'));



        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
/*
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Post_Emploi.create')){
            abort(403, 'access interdit !! vous ete guerre authoriser à effectuer cette action veuillez contactez votre administrateur');


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
        return view('backend.pages.postemplois.create', compact('PostEmplois','Etat','Region','Ville','sectas','typemp','contratemp','formationemp'));


        }
*/

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




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       if(is_null($this->user)){
        // $parametre = Parametres::first();
        return view('chercheur.auth.login');


    }else{

               $request->validate([

            'lettre' => 'required',

            ],

            [
                'lettre.required' => 'Le message est necessaire.',

            ]);



        // creer un nouvel Utilisateur
        $CNE = new Emploi_Postuler();
        $CNE ->user_id = $request->user_id;
        $CNE ->post_emploi_id = $request->post_emploi_id;
        $CNE ->lettre = $request->lettre;

              $CNE ->save();


       session()->flash('success', 'Votre demande à postuler a été envoyé avec succès nous vous contacterons si votre profil est retenu!');
       $parametre = Parametres::first();
       return redirect()->route('chercheur.postemplois.index',compact('parametre'));


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
            return view('chercheur.auth.login');


        }else{


        $id = Crypt::decrypt($id);
        $PostEmplois = Post_Emploi::find($id);
        //$PostEmplois = DB::table('post__emplois')
        //->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        //->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
        //->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        //->select('post__emplois.titre_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','sect_activs.nom_secteur','post__emplois.created_at','post__emplois.id')->get();

            $parametre = Parametres::first();
        return view('chercheur.pages.postemplois.edit', compact('PostEmplois',compact('parametre')));


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
