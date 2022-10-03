<?php

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
use Illuminate\Support\Facades\Input;
use App\Estado;
use App\Ciudad;
use App\Tienda;


Route::get('/', function () {
    return view('login');
})->name('startLogin');

//Seccion de contactos - Solicita informes
//Route::get('contactos', 'ContactosController@index');

Route::get('contactos', [
   'middleware' => 'sesion:null',
   'uses' => 'ContactosController@index',
]);

Route::get('/logout', 

 
[
   'middleware' => 'sesion:logout',
   function () {
    return view('login');
   } ,
]

)->name('logoutLogin');


Route::post('contactos', [
   'middleware' => 'sesion:null',
   'uses' => 'ContactosController@index',
]);


Route::get('contactos/{contacto}', [
   'middleware' => 'sesion:null',
   'uses' => 'ContactosController@show',
]);

Route::post('contactos/{contacto}', [
   'middleware' => 'sesion:null',
   'uses' => 'ContactosController@save_data',
]);

Route::get('excel/contacto', 'ContactosController@exportContactos');

Route::get('pdf/contacto', 'ContactosController@downloadPDF');

//Seccion de sugerencias - Sugerencias, dudas o aclaraciones
Route::get('sugerencias', [
   'middleware' => 'sesion:null',
   'uses' => 'SugerenciasController@index',
]);

Route::get('sugerencias/{sugerencia}', [
   'middleware' => 'sesion:null',
   'uses' => 'SugerenciasController@show',
]);
Route::post('sugerencias/{sugerencia}', [
   'middleware' => 'sesion:null',
   'uses' => 'SugerenciasController@save_data',
]);

Route::get('excel/sugerencias', 'SugerenciasController@exportSugerencias');

Route::get('pdf/sugerencias', 'SugerenciasController@downloadPDF');



//Seccion de suscriptores - PopUp
Route::get('suscriptores', [
   'middleware' => 'sesion:null',
   'uses' => 'SubscriptorsController@index',
]);

Route::get('suscriptores/{subscriptor}', [
   'middleware' => 'sesion:null',
   'uses' => 'SubscriptorsController@show',
]);
Route::get('excel/suscriptores', 'SubscriptorsController@exportExcel');


//Seccion de GanaRac - GanaRAC
Route::get('ganarac', [
   'middleware' => 'sesion:null',
   'uses' => 'GanaRacController@index',
]);

Route::get('ganarac/{ganarac}', [
   'middleware' => 'sesion:null',
   'uses' => 'GanaRacController@show',
]);

Route::get('excel/ganarac', 'GanaRacController@exportExcel');

//get estados a partir del estado
Route::get('data/ajax-state',function()
{
    $estado_id = Input::get('estado_id');

    $ciudades = Ciudad::where('estado_id', '=', $estado_id)->get();


    return $ciudades;

})->name('getCiudadesFromEstados');

//get tiendas a partir del estado
Route::get('data/ajax-tienda',function()
{
    $ciudad_id = Input::get('ciudad_id');
    $tiendas = Tienda::where('ciudad_id','=',$ciudad_id)->get();
    return $tiendas;

})->name('getTiendasFromEstados');




Route::get('formularios/ganarac', 'GanaRacController@ganaracForm');
Route::post('formularios/ganarac', 'GanaRacController@ganaracForm');


Route::get('formularios/popup', 'SubscriptorsController@subscriptorsForm');
Route::post('formularios/popup', 'SubscriptorsController@subscriptorsForm');

Route::get('formularios/contacto', 'ContactosController@contactoForm');
Route::post('formularios/contacto', 'ContactosController@contactoForm');

Route::get('formularios/sugerencias', 'SugerenciasController@sugerianciaForm');
Route::post('formularios/sugerencias', 'SugerenciasController@sugerianciaForm');
