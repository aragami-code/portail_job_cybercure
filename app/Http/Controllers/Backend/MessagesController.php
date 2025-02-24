<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Messages;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class MessagesController extends Controller
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


        }
        else{
            // Messages::->orderBy('id','desc');
            $parametre = Parametres::first();

            $SMS = DB::table('messages')
        ->select('messages.id','messages.Name','messages.Email','messages.status','messages.Objet'
        )->where('messages.status',0)->orderBy('messages.id','desc')->get();


           //$SMS = Messages::all()->orderBy('id','desc');

                    return view('backend.pages.message.index', compact('SMS','parametre'));


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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



            //
            $Message = Messages::find($id);
        $parametre = Parametres::first();
        return view('backend.pages.message.edit', compact('parametre','Message'));





    }





    public function upsel(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

          // activer
          $parametre = Parametres::first();

          $Message = Messages::find($id);
          DB::update('update messages set status = 1 where id = ?',[$id]);
          $Message->save();
         // $Message = Messages::find($id);

        // session()->flash('success', 'Interview éffectuée avec succes pour cet utilisateur.');

        return view('backend.pages.message.edit', compact('parametre','Message'));

         //return redirect()->route('backend.pages.message.edit');

         //return back();

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
