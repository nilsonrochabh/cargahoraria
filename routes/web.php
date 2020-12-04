<?php

use App\Http\Controllers\ProfessorController;
use App\Models\ModelSerie;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
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
Auth::routes(['register' => false]);  
Auth::routes();


Route::get('/', 'AuthController@index')->name('pages')->middleware('auth');;
Route::get('/pages/logout', 'AuthController@logout')->name('pages.logout');

Route::get('/pages/login', 'AuthController@loginForm')->name('pages.login');
Route::post('/pages/login/do', 'AuthController@login')->name('pages.login.do');

//Route::get('/turma', 'HorarioTurmaController@index')->name('turma');
//Route::post('/turma/create', 'HorarioTurmaController@store')->name('turma.create');

//Route::get('/pesquisa', 'PesquisaController@index')->name('pesquisa');




//Route::resource('atividades', AtividadeController::class);

// Route::get('/atividade', 'AtividadeController@index')->name('atividade');
// Route::get('/atividade/create', 'AtividadeController@create')->name('atividade.create');

// Route::post('/atividade/create/do', 'AtividadeController@store')->name('atividade.create.do');

Route::resource('/atividade','AtividadeController')->middleware('auth');; 
Route::resource('/turma','HorarioTurmaController')->middleware('auth');; 
//Route::resource('/professor','ProfessorController'); 
Route::resource('/consulta','ConsultaController')->middleware('auth');; 

Route::get(' professor','ProfessorController@index')->middleware('auth');;
Route::post(' professor','ProfessorController@store')->middleware('auth');;
Route::get(' professor/create','ProfessorController@create')->middleware('auth');;
Route::post(' professor/{professor}/enturmar','ProfessorController@enturmar')->middleware('auth');;
Route::put(' professor/{professor}','ProfessorController@update')->middleware('auth');;
Route::get(' professor/{professor}','ProfessorController@show')->middleware('auth');;
Route::get(' professor/{professor}/edit','ProfessorController@edit')->middleware('auth');;







Route::post('/turma/pegaDados','HorarioTurmaController@pegaDados')->middleware('auth');; 
Route::get('/turma/getSeries/{segui_id}','HorarioTurmaController@getSeries')->middleware('auth');;
Route::get('/turma/getMaterias/{segui_id}','HorarioTurmaController@getMaterias')->middleware('auth');;

Route::get('turma/retornaDados','HorarioTurmaController@retornaDados')->middleware('auth');;
Route::get('turma/retornaProf/{uni_id}','HorarioTurmaController@retornaProf')->middleware('auth');;
Route::post('/turma/cadHorarios','HorarioTurmaController@store')->name('turma.cadHorarios')->middleware('auth');;
Route::post('/turma/horariosProf','HorarioTurmaController@horariosProf')->middleware('auth');;
Route::post('/turma/cadastroHorarioProf','HorarioTurmaController@cadastroHorarioProf')->name('turma.cadastroHorarioProf')->middleware('auth');;

Route::get('/turma/horario_prof/{id}','HorarioTurmaController@horarioProfessores')->middleware('auth');;


Route::post('/turma/cad-prof-turma','HorarioTurmaController@cadprof')->name('turma.cad-prof-turma')->middleware('auth');;


//Route::get('/get-series/','HorarioTurmaController@getSeries'); 
Route::get('atividade/getHora/{prof_id}','AtividadeController@getHora')->middleware('auth');;
Route::get('/search','ProfessorController@search')->middleware('auth');;
Route::get('atividade/search','AtividadeController@search')->middleware('auth');;
Route::get('/atividade/getUsuario/','AtividadeController@getUsuario')->middleware('auth');;
//$this->resource('turma','HorarioTurmaController');

//Route::get('/pages', 'App\Http\Controllers\SerieController@index')->name('admin.index');




Route::get('professor/{id}/enturmar', 'ProfessorController@enturmar')->middleware('auth');;