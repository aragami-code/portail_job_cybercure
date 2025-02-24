<?php

namespace App\Http\Controllers\Chercheur;

use App\Http\Controllers\Controller;

use Response;
use App\Competences;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class ChercheurSommaireController extends Controller
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
              $user = Auth::user();

              $data['competences'] = Competences::orderBy('id','desc')->where('user_id',Auth::guard('chercheur')->user()->id)->paginate(8);

             // return view('ajaxcrud.index',);


             $parametre = Parametres::first();

            return view('chercheur.pages.profile.competence', compact('user','parametre'),$data);


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

        $postID = $request->id;
        $post   =   Competences::updateOrCreate(['id' => $postID],
        ['competences_user' => $request->competences_user,
         'user_id' => $request->user_id,
         'niveau' => $request->niveau,
         'pourcentage' => $request->pourcentage]);

        return Response::json($post);

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
    $post  = Competences::where($where)->first();

    return Response::json($post);

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

            $post = Competences::where('id',$id)->delete();

            return Response::json($post);
        }

    }




























}

