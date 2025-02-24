<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('','Home\HomeController@Acceuil')->name('accueil');
Route::get('/acceuil','Home\HomeController@Acceuil1')->name('accueil1');
Route::get('/about','Home\HomeController@About')->name('about');
Route::get('/faq','Home\HomeController@Faq')->name('faq');
Route::get('/preface','Home\HomeController@preface')->name('preface');
Route::get('/contact','Home\HomeController@Contact')->name('contact');
Route::post('/contact/Messagek','Home\HomeController@Messagek')->name('Messagek');
//Route::post('/contact/nl','Home\HomeController@NL')->name('Messagek');
//Route::post('/contact/send','Home\HomeController@send');
Route::get('/carriere','Home\HomeController@Carriere')->name('carriere');
Route::get('/connexion','Home\HomeController@Connexion')->name('connexion');
Route::get('/carriere/{id}','Home\HomeController@carriereinfo')->name('carriereinfo');
Route::get('/Recherche','Home\HomeController@resultatRecherche')->name('resultatRecherche');

Route::get('/Recherche/avance','Home\HomeController@rech')->name('rech');
Route::get('/actualité','Home\HomeController@Actualite')->name('actualite');
Route::get('/actualité_detail/{id}','Home\HomeController@Actualite_detail')->name('actud');
Route::get('findRegion/{id}','Home\HomeController@findRegion')->name('findregions');

Route::get('/password/reset','Chercheur\Auth\ReinitialiserController@initialiser')->name('chercheur.password.request');
Route::get('/password/initaliserpass','Chercheur\Auth\ReinitialiserController@login')->name('chercheur.password.reinitialiser');
Route::get('/password/initaliserpass1/{email}','Chercheur\Auth\ReinitialiserController@regen')->name('chercheur.password.regen');
Route::put('/password/initaliserpass12/{id}','Chercheur\Auth\ReinitialiserController@update')->name('chercheur.password.update');
//Route::post('user/password/reset/submit','Chercheur\Auth\ForgotPasswordController@reset')->name('chercheur.password.update');


//Route::get('/home','Home\HomeController@Home')->name('home');

/*
* admin Routes
*/



//Route::group(['prefix' => 'admin'], function(){
        Route::group(['middleware' => ['nocache']], function () {
        Route::get('admin/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');
        Route::get('admin/dashboardL', 'Backend\DashboardController@indexL')->name('admin.dashboardL');
        Route::resource('admin/roles','Backend\RolesController', ['names' => 'admin.roles']);
        Route::resource('admin/users','Backend\UsersController', ['names' => 'admin.users']);
        Route::resource('admin/admins','Backend\AdminsController', ['names' => 'admin.admins']);
        Route::resource('admin/bcategories','Backend\BcategoryController', ['names' =>'admin.bcategories']);
        Route::resource('admin/articles','Backend\ArticlesController', ['names' =>'admin.articles']);
        Route::resource('admin/evenements','Backend\EvenementsController', ['names' =>'admin.evenement']);
        Route::resource('admin/contrats','Backend\ContratsController', ['names' =>'admin.contrats']);
        Route::resource('admin/formations','Backend\FormationsController', ['names' =>'admin.formations']);
        Route::resource('admin/sectas','Backend\SectaController', ['names' =>'admin.sectas']);
        Route::resource('admin/etats','Backend\EtatsController', ['names' =>'admin.etats']);
        Route::resource('admin/villes','Backend\VillesController', ['names' =>'admin.villes']);
        Route::resource('admin/regions','Backend\RegionsController', ['names' =>'admin.regions']);
        Route::resource('admin/salaires','Backend\SalairesController', ['names' =>'admin.salaires']);
        Route::resource('admin/typemplois','Backend\TypEmploisController', ['names' =>'admin.typemplois']);
        Route::resource('admin/postemplois','Backend\PostEmploisController', ['names' =>'admin.postemplois']);

        Route::get('admin/postemploisL','Backend\PostEmploisController@indexL')->name('admin.postemplois.indexL');


        Route::resource('admin/Newsletter','Backend\NewsLetterContactController')->names('admin.newsletter');
        Route::resource('admin/Messages','Backend\MessagesController')->names('admin.message');

        Route::put('admin/MessagesR/{id} ','Backend\MessagesController@upsel')->name('admin.message.upsel');
       // Route::put('admin/MessageR/{id} ','Backend\MessagesController@upsel1')->name('admin.message.upsel1');


        Route::get('admin/postemplois/{postemploi}/findEtat/{id}','Backend\PostEmploisController@findEtatEdit')->name('admin.postemplois.findetatsEdit');
        Route::get('admin/postemplois/{postemploi}/findRegion/{id}','Backend\PostEmploisController@findRegionEdit')->name('admin.postemplois.findregionsEdit');
        Route::get('admin/postemplois/findEtat/{id}','Backend\PostEmploisController@findEtat')->name('admin.postemplois.findetats');
        Route::get('admin/postemplois/findRegions/{id}','Backend\PostEmploisController@findRegions')->name('admin.postemplois.findregion');
        Route::get('admin/postemplois/getMotCle/{id}','Backend\PostEmploisController@getMotCle')->name('admin.postemplois.getmocle');

        //Route::get('findEtat/{id}','Chercheur\ChercheursProfileController@findEtat')->name('chercheur.profile.findetats');
        //Route::get('findRegion/{id}','Chercheur\ChercheursProfileController@findRegion')->name('chercheur.profile.findregions');

        Route::get('admin/postemploi/matcher','Backend\PostEmploisController@matcher')->name('admin.postemplois.matcher');
        Route::get('admin/postemploi/findRegion/{id}','Backend\PostEmploisController@findRegion')->name('admin.postemplois.findregions');


        Route::get('admin/postemploi/search','Backend\PostEmploisController@resultatRecherche')->name('admin.postemplois.resultatRecherche');
      //  Route::get('admin/postemploi/matche','Backend\PostEmploisController@resultatRecherche')->name('admin.postemplois.resultatRecherche');

        Route::resource('admin/cv/chercheur','Backend\ChercheursProfileController', ['names' => 'admin.chercheurprofile']);

        Route::resource('admin/profile','Backend\AdminsProfileController', ['names' => 'admin.adminprofile']);
        Route::resource('admin/emploipostuler','Backend\EmploisPostulerController', ['names' =>'admin.emploispostuler']);
 //Route::get('admin/emploipostule ','Backend\EmploisPostulerController@indexo')->name('admin.emploispostuler.indexo');
        Route::put('admin/emploipostule/{emploipostuler} ','Backend\EmploisPostulerController@up1')->name('admin.emploispostuler.up1');
        Route::put('admin/emploipostul/{emploipostuler} ','Backend\EmploisPostulerController@upsel')->name('admin.emploispostuler.upsel');
        Route::put('admin/emploipostu/{emploipostuler} ','Backend\EmploisPostulerController@upsel1')->name('admin.emploispostuler.upsel1');

        Route::put('admin/user/{users} ','Backend\UsersController@blackl')->name('admin.users.blackl');
        Route::put('admin/uses/{users} ','Backend\UsersController@unblackl')->name('admin.users.unblackl');
        Route::get('admin/liste','Backend\UsersController@listblack')->name('admin.listblack');
        // Route::get('admin/ListRetenu/{id} ','Backend\EmploisPostulerController@list')->name('admin.emploispostuler.list');


        Route::resource('admin/parametres','Backend\ParametresController', ['names' =>'admin.parametres']);


   //     Route::get('admin/emploipostuler/{emploispostuler}/{id}','Backend\EmploisPostulerController@voircv')->name('admin.emploispostuler.voircv');
         Route::get('admin/emploipostuler/{emploispostuler}/{id}','Backend\EmploisPostulerController@voircv')->name('admin.emploispostuler.voircv');

        //login
        Route::get('admin/login','Backend\Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('admin/login/submit','Backend\Auth\LoginController@Login')->name('admin.login.submit');


        //logout
        Route::post('admin/logout/submit','Backend\Auth\LoginController@Logout')->name('admin.logout.submit');


        //forgot password
        Route::get('admin/password/reset','Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('admin/password/reset/submit','Backend\Auth\ForgotPasswordController@reset')->name('admin.password.update');
        });
//});

//Route::get('/login','Auth\LoginController@index')->name('login');







//Route::group(['prefix' => 'admin'], function(){
        Route::group(['middleware' => ['nocache']], function () {
        Route::get('user/dashboard', 'Chercheur\DashboardController@index')->name('chercheur.dashboard');
        Route::get('user/Dashboard/search','Chercheur\DashboardController@resultatRecherche')->name('chercheur.dashboard.resultatRecherche');

       // Route::get('user/Dashboard/matcher','Chercheur\DashboardController@matcher')->name('chercheur.dashboard.matcher');
         Route::get('user/findRegion/{id}','Chercheur\DashboardController@findRegion')->name('chercheur.dashboard.findregions');

        //voir l'offre

        Route::resource('user/detail','Chercheur\PostEmploisController', ['names' =>'chercheur.postemplois']);
        Route::get('user/offre','Chercheur\PostEmploisController@listOffre')->name('chercheur.postemplois.listOffre');

        Route::get('user/postemplois/{postemploi}/findEtat/{id}','Chercheur\PostEmploisController@findEtatEdit')->name('chercheur.postemplois.findetatsEdit');
        Route::get('user/postemplois/{postemploi}/findRegion/{id}','Chercheur\PostEmploisController@findRegionEdit')->name('chercheur.postemplois.findregionsEdit');
        Route::get('user/postemplois/emploispostuler/{id}','Chercheur\PostEmploisController@emploispostuler')->name('chercheur.postemplois.emploispostule');
        Route::get('user/postemplois/emploisfavori/{id}','Chercheur\PostEmploisController@emploisfavori')->name('chercheur.postemplois.emploisfav');

        Route::put('user/detail','Chercheur\PostEmploisController@favori')->name('chercheur.postemplois.favori');
       // Route::put('user/postemplois','Chercheur\PostEmploisController@unfavori')->name('chercheur.postemplois.unfavori');

        //creer son CV
        Route::resource('user/cv','Chercheur\ChercheurCompetenceController', ['names' =>'chercheur.competence']);
        Route::resource('user/experience','Chercheur\ChercheurExperienceController', ['names' =>'chercheur.experience']);
        Route::resource('user/langue','Chercheur\ChercheurLangueController', ['names' =>'chercheur.langue']);
       Route::resource('user/Niveau','Chercheur\ChercheurNiveauEtudeController', ['names' =>'chercheur.niveau']);
        Route::resource('user/Competence','Chercheur\ChercheurSommaireController', ['names' =>'chercheur.sommaire']);
        //user/profile/1/edit



        //login
       //Route::get('user/login','Chercheur\Auth\LoginController@showLoginForm')->name('chercheur.login');
        Route::post('user/login/submit','Chercheur\Auth\LoginController@Login')->name('chercheur.login.submit');


        // register

       Route::get('/Enregistrement','Chercheur\ChercheurRegisterController@index')->name('chercheur.register');
       Route::post('/Enregistrement/create','Chercheur\ChercheurRegisterController@store')->name('chercheur.register.create');



        //logout
        Route::post('user/logout/submit','Chercheur\Auth\LoginController@Logout')->name('chercheur.logout.submit');

        //profile

        Route::resource('user/profile','Chercheur\ChercheursProfileController', ['names' => 'chercheur.profile']);
        Route::post('user/profile/{profile}','Chercheur\ChercheursProfileController@upinfo')->name('chercheur.profile.upinfo');
        Route::post('user/profil/{profile}','Chercheur\ChercheursProfileController@upinfocv')->name('chercheur.profile.upinfocv');

        Route::get('user/profile/{profile}/edite','Chercheur\ChercheursProfileController@edite')->name('chercheur.profile.edite');






        //forgot password
        //Route::get('user/password/reset','Chercheur\Auth\ReinitialiserController@initialiser')->name('chercheur.password.request');
        //Route::get('user/password/initaliserpass','Chercheur\Auth\ReinitialiserController@login')->name('chercheur.password.reinitialiser');
        //Route::get('user/password/initaliserpass1/{email}','Chercheur\Auth\ReinitialiserController@regen')->name('chercheur.password.regen');
       // Route::post('user/password/reset/submit','Chercheur\Auth\ForgotPasswordController@reset')->name('chercheur.password.update');
        });/**/
