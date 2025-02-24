<?php

namespace App\Http\Controllers\Chercheur;

use App\Etats;
use App\Http\Controllers\Controller;
use App\Parametres;
use App\Post_Emploi;
use App\Regions;
use App\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('chercheur')->user();
            return $next($request);

        });
    }


    //
    public function index(Request $request)
    {
        $Region = Regions::all();

        $parametre = Parametres::first();


        //$PostEmplis = Post_Emploi::find($id);

        if(is_null($this->user)){
            $parametre = Parametres::first();
            return view('chercheur.auth.login',compact('parametre'));


        }else{




                 if($request->ajax() && isset($request->start)){

                $start = $request->start; // min price

                $end = $request->end;//max price

                /*$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
              */  $Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','villes.nom_ville','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->where('post__emplois.salaire_min_post_emploi','=', $start)->where('post__emplois.salaire_max_post_emploi','=', $end)->orderBy('post__emplois.salaire_max_post_emploi','ASC')->get();
             //  dd($Emplois_Postuler);
               response()->json($Emplois_Postuler);
               return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));



               }else if(isset($request->vil))
               {



                $vil = $request->vil;//max price


                /*$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
              *//**/


              /**/$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','villes.nom_ville','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')
                ->whereIN('post__emplois.id_ville_post_emploi',explode(',',$vil))->get();
             // dd($Emplois_Postuler);


                response()->json($Emplois_Postuler);

               return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));








               }
               else if(isset($request->contratt))
               {



                $contratt = $request->contratt;//max price

                /*$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
              *//**/  $Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','villes.nom_ville','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.contrat_post_emploi',explode(',',$contratt))->get();
             // dd($Emplois_Postuler);

               response()->json($Emplois_Postuler);
               return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));






               }

               else if(isset($request->secteur))
               {



                $secteur = $request->secteur;//max price

                /*$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
              *//**/  $Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','typ_emps.type_empl','villes.nom_ville','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.sectas_post_emploi',explode(',',$secteur))->get();
             // dd($Emplois_Postuler);

               response()->json($Emplois_Postuler);
               return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));






               }

               else if(isset($request->periode))
               {


                $periode = $request->periode;//max price

                /*$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
              *//**/  $Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','typ_emps.type_empl','contrat_emps.contrat_empl','villes.nom_ville','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.typemp_post_emploi',explode(',',$periode))->get();
             // dd($Emplois_Postuler);

               response()->json($Emplois_Postuler);
               return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));






               }
               else if($request->ajax() || isset($request->start) || isset($request->end) || isset($request->vil) || isset($request->contratt) || isset($request->secteur) || isset($request->periode) )
               {
/**/

                $start = $request->start; // min price

                $end = $request->end;//max price
                $vil = $request->vil;// departement

                $contratt = $request->contratt;//contrat
                $secteur = $request->secteur;//secteur d'activité
                $periode = $request->periode;//periode

                /*$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
              *//**/


              /**/$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','post__emplois.DL','contrat_emps.contrat_empl','villes.nom_ville','post__emplois.created_at','post__emplois.id')
                ->orwhere('post__emplois.salaire_min_post_emploi','<', $start)
                ->orwhere('post__emplois.salaire_max_post_emploi','>', $end)
                ->orwhereIN('post__emplois.id_ville_post_emploi',explode(',',$vil))
                ->orwhereIN('post__emplois.contrat_post_emploi',explode(',',$contratt))
                ->orwhereIN('post__emplois.typemp_post_emploi',explode(',',$periode))
                ->orwhereIN('post__emplois.sectas_post_emploi',explode(',',$secteur))
                ->orwhereIN('post__emplois.typemp_post_emploi',explode(',',$periode))
                ->get();
             // dd($Emplois_Postuler);

               response()->json($Emplois_Postuler);
               return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));






              //
             }

               else{

                $Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','post__emplois.DL','contrat_emps.contrat_empl','villes.nom_ville','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->paginate(6);
                //    $PostEmplois = Post_Emploi::all();


                return view('chercheur.pages.dashboard.index', compact('Emplois_Postuler','Region','parametre'));



               //return view('chercheur.pages.dashboard.index', compact('PostEmplois','Region','parametre'));


               }







 /*           dd('ok');

        $total_roles = count(Role::select('id')->get());
        $total_admins = count(Admin::select('id')->get());
        $total_users = count(User::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());
        $total_articles = count(Articles::select('id')->get());*/
       //$Emplois_Postuler = Post_Emploi::paginate(1);
       // $Emplois_Postuler = DB::table('post__emplois')
        //->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        //->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        //->select('post__emplois.titre_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->paginate(8);
        //    $PostEmplois = Post_Emploi::all();

        //$Region = Regions::all();

        //$parametre = Parametres::first();

        //return view('chercheur.pages.dashboard.index', compact('Emplois_Postuler','Region','parametre'));



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



    public function resultatRecherche(Request $request){



        $Region = Regions::all();
        $Ville = Villes::all();
        $emplois = Post_Emploi::all();
        $Emp = new Post_Emploi;
        $Emp->titre_post_emploi = $request->titre_post_emploi;
         $Emp->id_region_post_emploi = $request->id_region_post_emploi;
        $Emp->id_ville_post_emploi = $request->id_ville_post_emploi;
//$PostEmplois->photo;


//$cher = DB::table('post__emplois')
//->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
//->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
//->select('titre_post_emploi', 'id_region_post_emploi', 'id_ville_post_emploi')
//->where('titre_post_emploi',$Emp->titre_post_emploi,'id_region_post_emploi',$Emp->id_region_post_emploi,'id_ville_post_emploi',$Emp->id_ville_post_emploi)->get();

//$cher = DB::select("select * from post__emplois WHERE titre_post_emploi LIKE '%$Emp->titre_post_emploi%' AND id_region_post_emploi  = '$Emp->id_region_post_emploi' AND id_ville_post_emploi  = '$Emp->id_ville_post_emploi' limit 8");

//$cher = Post_Emploi::orderBy('id','desc')->where('titre_post_emploi','id_region_post_emploi','id_ville_post_emploi',$Emp->titre_post_emploi,$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi)->paginate(8);
$cher = Post_Emploi::whereRaw('titre_post_emploi like ? and id_region_post_emploi = ? and id_ville_post_emploi = ?',["%{$Emp->titre_post_emploi}%",$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi])->paginate(2);
//)->where('experience_pros.user_id',$id)->get();


           // $chercheur = Chercheur::select('drop table users');
          //$PostEmplois

         // $Emplois_Postuler = Emploi_Postuler::all();
     // $tet =   DB::select('select * from users where active = ?', [1]);


         // $Emplois_Postuler = Emploi_Postuler::all();
         $parametre = Parametres::first();
          return view('chercheur.pages.dashboard.search', compact('cher','parametre'));






    }


}
