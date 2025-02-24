<?php

namespace App\Http\Controllers\Chercheur;

use App\Experience_pro;
use App\Http\Controllers\Controller;
use App\Parametres;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class ChercheurExperienceController extends Controller
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
              $user = Auth::user();

              $data['experiences'] = Experience_pro::orderBy('id','desc')->where('user_id',Auth::guard('chercheur')->user()->id)->paginate(8);

             // return view('ajaxcrud.index',);

            $parametre = Parametres::first();


            return view('chercheur.pages.profile.experience', compact('user','parametre'),$data);


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

        $experienceID = $request->id;
        $experiences   =   Experience_pro::updateOrCreate(['id' => $experienceID],
        ['user_id' => $request->user_id,
        'titre_job' => $request->titre_job,
         'entreprise' => $request->entreprise,
         'date_debut' => $request->date_debut,
         'date_fin' => $request->date_fin,
         'actif' => $request->actif,
         'mission' => $request->mission]);

        return Response::json($experiences);

       // return Respon
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {



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

            $where = array('id' => $id);
    $experiences  = Experience_pro::where($where)->first();

    return Response::json($experiences);

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


        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

            $experiences = Experience_pro::where('id',$id)->delete();

            return Response::json($experiences);
        }

    }




























}











