<?php

use App\Models\ModelSerie;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;




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

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/', 'AuthController@index')->name('pages');
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

Route::resource('/atividade','AtividadeController'); 
Route::resource('/turma','HorarioTurmaController'); 
Route::resource('/professor','ProfessorController'); 
Route::resource('/consulta','ConsultaController'); 




Route::post('/turma/pegaDados','HorarioTurmaController@pegaDados'); 
Route::get('/turma/getSeries/{segui_id}','HorarioTurmaController@getSeries');
Route::get('turma/retornaDados','HorarioTurmaController@retornaDados');
Route::get('turma/retornaProf/{uni_id}','HorarioTurmaController@retornaProf');
Route::post('/turma/cadHorarios','HorarioTurmaController@store')->name('turma.cadHorarios');
Route::post('/turma/horariosProf','HorarioTurmaController@horariosProf');
Route::post('/turma/cadastroHorarioProf','HorarioTurmaController@cadastroHorarioProf')->name('turma.cadastroHorarioProf');;


Route::post('/turma/cad-prof-turma','HorarioTurmaController@cadprof')->name('turma.cad-prof-turma');


//Route::get('/get-series/','HorarioTurmaController@getSeries'); 
Route::get('atividade/getHora/{prof_id}','AtividadeController@getHora');
Route::get('/search','ProfessorController@search');
Route::get('atividade/search','AtividadeController@search');
Route::get('/atividade/getUsuario/','AtividadeController@getUsuario');
//$this->resource('turma','HorarioTurmaController');

//Route::get('/pages', 'App\Http\Controllers\SerieController@index')->name('admin.index');



