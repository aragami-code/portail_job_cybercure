<?php

namespace App\Http\Controllers\Home;

use App\Articles;
use App\Evenements;
use App\Http\Controllers\Controller;
use App\Parametres;
use App\Post_Emploi;
use App\Regions;
use App\Villes;
use App\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function Acceuil(){

        //dd('teest');
       //return view('welcome');
       //$art = Articles::paginate(2);
      $art = Articles::orderBy('id','desc')->paginate(3);
       return view('site.home.fr.acceuil', compact('art'));

    }
    public function Acceuil1(){

        //dd('teest');
       //return view('welcome');

       $art = Articles::orderBy('id','desc')->paginate(3);

       return view('site.home.fr.acceuil',compact('art'));

    }

    public function Actualite(){

        //dd('teest');
       //return view('welcome');

       $ev = Evenements::orderBy('id','desc')->paginate(4);
       $art = DB::table('articles')
       ->join('b_categories','b_categories.id','=','articles.id_categorie')

       ->join('admins','admins.id','=','articles.id_admin')

        ->select('articles.id','articles.name_article','articles.sommaire_article','b_categories.name as name_categorie','admins.name as nom_admin','articles.created_at','articles.image_article')->orderBy('id','desc')->paginate(3);


       return view('site.home.fr.actualite',compact('art','ev'));

    }
    public function Actualite_detail($id){

        //dd('teest');
       //return view('welcome');
       $id = Crypt::decrypt($id);
       $ev = Articles::find($id);
       $art = DB::table('articles')
       ->select('articles.id','articles.name_article','articles.image_article')->limit(5)->orderBy('id','desc')->get();

       //$art = Articles::all();


       return view('site.home.fr.detail',compact('ev','art'));

    }
    public function Faq(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.faq');

    }

    public function Contact(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.contact');

    }
    /*
    function send(Request $request){

        $this->validate($request,[
            'Name' => 'required',
            'Email' => 'required|email',
            'Services' => 'required',
            'Objet' => 'required',
            'Message' => 'required'
        ]);

        $data = array(
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Services' => $request->Services,
            'Objet' => $request->Objet,

            'Message' => $request->Message
                    );
//danielassoumou25@gmail.com
        Mail::to("fredytimothee@gmail.com")->send(new SendEmail($data));
        return back()->with('succes','Merci nous vous répondrons!');
    }*/




   public function Messagek(Request $request){


    $request->validate([

        'Name' => 'required',
        'Email' => 'required|email',
        'Objet' => 'required',
        'Message' => 'required'

            ],

            [
            'Name.required' => 'Votre Nom est obligatoire.',
            'Email.required' => 'Votre E-mail est obligatoire.',
            'Objet.required' => 'L\'Objet de votre message est obligatoire.',
            'Message.required' => 'Le message est nécessaire s\'il vous plait.'

            ]);

              //  $SMSstatus = 0 ;
        // creer un nouvel Utilisateur
        $Messages = new Messages();
        $Messages->Name = $request->Name;
        $Messages->Email = $request->Email;
        $Messages->Objet = $request->Objet;
        $Messages->Message = $request->Message;
        $Messages->status = $request->status;
        $Messages->save();
        session()->flash('success', 'message envoyé avec success !');


 //dd('test');

 //return view('site.home.fr.contact');
 //return back();
 return  redirect('/contact');

    }







    public function About(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.about');

    }

    public function preface(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.preface');

    }

    public function rech(Request $request){

       // $Region = Regions::all();

        $parametre = Parametres::first();
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
       return view('site.home.fr.ofr', compact('Emplois_Postuler'));



       }else if(isset($request->vil))
       {



        $vil = $request->vil;//max price


        /*$Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
      *//**/  $Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','villes.nom_ville','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.id_ville_post_emploi',explode(',',$vil))->paginate(6);
     // dd($Emplois_Postuler);

       response()->json($Emplois_Postuler);
       return view('site.home.fr.ofr', compact('Emplois_Postuler'));






       }
      else if(isset($request->contratt))
       {



        $contratt = $request->contratt;//max price

        /*$Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
      *//**/

      $Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','villes.nom_ville','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.contrat_post_emploi',explode(',',$contratt))->paginate(6);
     // dd($Emplois_Postuler);

       response()->json($Emplois_Postuler);
       return view('site.home.fr.ofr', compact('Emplois_Postuler'));






       }

      else if(isset($request->secteur))
       {



        $secteur = $request->secteur;//max price

        /*$Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
      *//**/

      $Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','typ_emps.type_empl','villes.nom_ville','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.sectas_post_emploi',explode(',',$secteur))->paginate(6);
     // dd($Emplois_Postuler);

       response()->json($Emplois_Postuler);
       return view('site.home.fr.ofr', compact('Emplois_Postuler'));






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

        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','typ_emps.type_empl','contrat_emps.contrat_empl','villes.nom_ville','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.typemp_post_emploi',explode(',',$periode))->paginate(6);
     // dd($Emplois_Postuler);

       response()->json($Emplois_Postuler);
       return view('site.home.fr.ofr', compact('Emplois_Postuler'));






       }
      else if($request->ajax() || isset($request->start) || isset($request->end) || isset($request->vil) || isset($request->contratt) || isset($request->secteur) || isset($request->periode) )
       {


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
       $Emplois_Postuler = DB::table('post__emplois')
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
        ->paginate(6);
     // dd($Emplois_Postuler);

       response()->json($Emplois_Postuler);
       return view('site.home.fr.ofr', compact('Emplois_Postuler'));






       }

       else{

        $Emplois_Postuler = DB::table('post__emplois')
        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
        ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','post__emplois.DL','contrat_emps.contrat_empl','villes.nom_ville','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->paginate(8);
        //    $PostEmplois = Post_Emploi::all();




 return view('site.home.fr.rech', compact('Emplois_Postuler','parametre'));
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

    public function Carriere(Request $request){

        //dd('teest');
       //return view('welcome');

       $Region = Regions::all();

        if(isset($request->vil))
               {



                $vil = $request->vil;//max price


                /*$Emplois_Postuler = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
              *//**/  $PostEmplois = DB::table('post__emplois')
                ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
                ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
                ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
                ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

                ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.DL','villes.nom_ville','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->whereIN('post__emplois.id_ville_post_emploi',explode(',',$vil))->paginate(6);
             // dd($Emplois_Postuler);

               response()->json($PostEmplois);

      // return view('site.home.fr.carriere',compact('PostEmplois','Region','parametre'));

               return view('site.home.fr.ofr', compact('PostEmplois','Region','parametre'));






               }//else if{

            //}
           // else if{

            //}

            else if($request->ajax() || isset($request->vil) ||  isset($request->secteur) )
            {

             $vil = $request->vil;// departement

             $secteur = $request->secteur;//secteur d'activité

             /*$Emplois_Postuler = DB::table('post__emplois')
             ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
             ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
             ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','contrat_emps.contrat_empl','post__emplois.created_at','post__emplois.id')->orderBy('post__emplois.id','DESC')->where('post__emplois.salaire_min_post_emploi','<=', $start)->where('post__emplois.salaire_max_post_emploi','<=', $end)->paginate(8);
           *//**/  $Emplois_Postuler = DB::table('post__emplois')
             ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')
             ->join('sect_activs','sect_activs.id','=','post__emplois.sectas_post_emploi')
             ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
             ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
             ->select('post__emplois.titre_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','typ_emps.type_empl','post__emplois.DL','contrat_emps.contrat_empl','villes.nom_ville','post__emplois.created_at','post__emplois.id')

             ->orwhereIN('post__emplois.id_ville_post_emploi',explode(',',$vil))
             ->orwhereIN('post__emplois.sectas_post_emploi',explode(',',$secteur))
             ->paginate(6);
          // dd($Emplois_Postuler);

            response()->json($Emplois_Postuler);
            return view('site.home.fr.ofr', compact('Emplois_Postuler'));






            }
            else{


        //$PostEmplois = Post_Emploi::orderBy('id','desc')->paginate(5);
        $PostEmplois = DB::table('post__emplois')
        ->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
        ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

        ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')

        ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
        ->select('contrat_emps.contrat_empl','post__emplois.id','post__emplois.titre_post_emploi','post__emplois.DL','typ_emps.type_empl','post__emplois.created_at','post__emplois.slug_post_emploi','post__emplois.description_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')->orderBy('post__emplois.id','desc')->paginate(5);

        $parametre = Parametres::first();

       return view('site.home.fr.carriere',compact('PostEmplois','Region','parametre'));
/*
       $PostEmplois = Post_Emploi::find($id);
       $Mat =  $PostEmplois->slug_post_emploi;
       $pars = explode(",",$Mat);
       foreach($pars as $part){
           echo"<li>";
           echo trim($part).",";
           echo"</li>";
*/
//dd('test');
            }


    }



    public function Reg(){


        return view('chercheur.auth.login');

     }

     public function Connexion(){


        return view('chercheur.auth.login');

     }




    public function Carriereinfo($id){

        //dd('teest');
        //return view('welcome');
  /*      $id = Crypt::decrypt($id);

        $PostEmplois = DB::table('post__emplois')
->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
->select('post__emplois.titre_post_emploi','post__emplois.slug_post_emploi','post__emplois.description_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')
->where('post__emplois.id',$id)->first();


       // $PostEmplois = Post_Emploi::find($id);

        $art = Post_Emploi::orderBy('id','desc')->paginate(8);



       // $PostEmplois = Post_Emploi::find($id);
        /**/



/*

        return view('site.home.fr.carriereDescription', compact('PostEmplois','art'));




*/











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
        ->select('post__emplois.id','post__emplois.titre_post_emploi','post__emplois.slug_post_emploi','post__emplois.DL','typ_emps.type_empl','post__emplois.description_post_emploi','post__emplois.ex_prof_post_emploi','post__emplois.DL','post__emplois.description_post_emploi','post__emplois.created_at','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')
        ->where('post__emplois.id',$id)->first();

       // $art = Post_Emploi::orderBy('id','desc')->paginate(8);
        $art = DB::table('post__emplois')
     ->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
     ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

     ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')

     ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
     ->select('contrat_emps.contrat_empl','post__emplois.id','post__emplois.titre_post_emploi','post__emplois.DL','typ_emps.type_empl','post__emplois.created_at','post__emplois.slug_post_emploi','post__emplois.description_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')
     ->orderBy('post__emplois.id','desc')->paginate(8);

        $parametre = Parametres::first();

        return view('site.home.fr.carriereDescription', compact('PostEmplois','PostEmplis','parametre','art'));


    }
      /*

*/
//dd('test');


public function resultatRecherche(Request $request){



    //$Region = Regions::all();
    //$Ville = Villes::all();
    $emplois = Post_Emploi::all();
    $Emp = new Post_Emploi;
    $Emp->titre_post_emploi = $request->titre_post_emploi;
    // $Emp->id_region_post_emploi = $request->id_region_post_emploi;
    //$Emp->id_ville_post_emploi = $request->id_ville_post_emploi;
//$PostEmplois->photo;


//$cher = DB::table('post__emplois')
//->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
//->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
//->select('titre_post_emploi', 'id_region_post_emploi', 'id_ville_post_emploi')
//->where('titre_post_emploi',$Emp->titre_post_emploi,'id_region_post_emploi',$Emp->id_region_post_emploi,'id_ville_post_emploi',$Emp->id_ville_post_emploi)->get();

//$cher = DB::select("select * from post__emplois WHERE titre_post_emploi LIKE '%$Emp->titre_post_emploi%' AND id_region_post_emploi  = '$Emp->id_region_post_emploi' AND id_ville_post_emploi  = '$Emp->id_ville_post_emploi' limit 8");

//$cher = Post_Emploi::orderBy('id','desc')->where('titre_post_emploi','id_region_post_emploi','id_ville_post_emploi',$Emp->titre_post_emploi,$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi)->paginate(8);
//cher = Post_Emploi::whereRaw('titre_post_emploi like ?',["%{$Emp->titre_post_emploi}%"])->paginate(8);
//$cher = Post_Emploi::whereRaw('titre_post_emploi like ? and id_region_post_emploi = ? and id_ville_post_emploi = ?',["%{$Emp->titre_post_emploi}%",$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi])->paginate(2);
/*
    if ($cher == null) {

        # code...
    } else {
        # code...
    }

*/

//)->where('experience_pros.user_id',$id)->get();


       // $chercheur = Chercheur::select('drop table users');
      //$PostEmplois

     // $Emplois_Postuler = Emploi_Postuler::all();
 // $tet =   DB::select('select * from users where active = ?', [1]);


     // $Emplois_Postuler = Emploi_Postuler::all();
     $cher = DB::table('post__emplois')
     ->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
     ->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')

     ->join('typ_emps','typ_emps.id','=','post__emplois.typemp_post_emploi')

     ->join('contrat_emps','contrat_emps.id','=','post__emplois.contrat_post_emploi')
     ->select('contrat_emps.contrat_empl','post__emplois.id','post__emplois.titre_post_emploi','post__emplois.DL','typ_emps.type_empl','post__emplois.created_at','post__emplois.slug_post_emploi','post__emplois.description_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')
     ->whereRaw('titre_post_emploi like ?',["%{$Emp->titre_post_emploi}%"])
     ->orderBy('post__emplois.id','desc')->paginate(5);


     $art = Post_Emploi::orderBy('id','desc')->paginate(8);
     $parametre = Parametres::first();
     //return view('site.home.fr.search', compact('cher','Region','Ville','parametre'));
     return view('site.home.fr.search', compact('cher','parametre','art'));

}

public function findRegion($id)
{


          $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

            return json_encode($ville);


}




    public function Home(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.en.master');

    }


}
