<?php

use App\Events\MyEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\ConducteurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Prog_entretienController;
use App\Http\Controllers\Type_entretienController;

//Welcome Page
Route::get('/', [WelcomeController::class, 'welcome']);

//Dashboard Page
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users', UtilisateurController::class);
});


//CRUD Utilisateur
Route::get('/utilisateur', [UtilisateurController::class, 'utilisateur']);
Route::post('/store_user', [UtilisateurController::class, 'store_user'])->name('store_user');
Route::delete('/delete_user', [UtilisateurController::class, 'delete_user'])->name('delete_user');
Route::get('/edit_user', [UtilisateurController::class, 'edit_user'])->name('edit_user');
Route::post('/update_user', [UtilisateurController::class, 'update_user'])->name('update_user');

//CRUD Profiles
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/update_profile', [ProfileController::class, 'update_profile'])->name('update_profile');

//CRUD Véhicules
Route::get('/vehicle', [VehicleController::class, 'vehicle']);
Route::post('/store_Vehicle', [VehicleController::class, 'store_Vehicle'])->name('store_Vehicle');
Route::delete('/delete_Vehicle', [VehicleController::class, 'delete_Vehicle'])->name('delete_Vehicle');
Route::get('/edit_Vehicle', [VehicleController::class, 'edit_Vehicle'])->name('edit_Vehicle');
Route::post('/update_Vehicle', [VehicleController::class, 'update_Vehicle'])->name('update_Vehicle');

//CRUD Type Entretien
Route::get('/type_entretien', [Type_entretienController::class, 'type_entretien']);
Route::post('/store_type_entretien', [Type_entretienController::class, 'store_type_entretien'])->name('store_type_entretien');
Route::delete('/delete_type_entretien', [Type_entretienController::class, 'delete_type_entretien'])->name('delete_type_entretien');
Route::get('/edit_type_entretien', [Type_entretienController::class, 'edit_type_entretien'])->name('edit_type_entretien');
Route::post('/update_type_entretien', [Type_entretienController::class, 'update_type_entretien'])->name('update_type_entretien');

//CRUD Programme Entretien
Route::get('/prog_entretien', [Prog_entretienController::class, 'prog_entretien']);
Route::post('/store_prog_entretien', [Prog_entretienController::class, 'store_prog_entretien'])->name('store_prog_entretien');
Route::delete('/delete_prog_entretien', [Prog_entretienController::class, 'delete_prog_entretien'])->name('delete_prog_entretien');
Route::get('/edit_prog_entretien', [Prog_entretienController::class, 'edit_prog_entretien'])->name('edit_prog_entretien');
Route::post('/update_prog_entretien', [Prog_entretienController::class, 'update_prog_entretien'])->name('update_prog_entretien');
Route::get('/get_entretien', [Prog_entretienController::class, 'get_entretien'])->name('get_entretien');
Route::get('/updateProgStatus/{k}/{y}', [Prog_entretienController::class, 'updateProgStatus']);

//CRUD Assurancce, Taxe et Visite
Route::get('/assurance', [AssuranceController::class, 'assurance']);
Route::post('/store_assurance', [AssuranceController::class, 'store_assurance'])->name('store_assurance');
Route::delete('/delete_assurance', [AssuranceController::class, 'delete_assurance'])->name('delete_assurance');
Route::get('/edit_assurance', [AssuranceController::class, 'edit_assurance'])->name('edit_assurance');
Route::post('/update_assurance', [AssuranceController::class, 'update_assurance'])->name('update_assurance');
Route::get('/edit_date', [AssuranceController::class, 'edit_date'])->name('edit_date');

//CRUD Conducteurs
Route::get('/employee', [ConducteurController::class, 'employee']);
Route::post('/store', [ConducteurController::class, 'store'])->name('store');
Route::get('/fetchall', [ConducteurController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [ConducteurController::class, 'delete'])->name('delete');
Route::get('/edit', [ConducteurController::class, 'edit'])->name('edit');
Route::post('/update', [ConducteurController::class, 'update'])->name('update');

//CRUD Commande
Route::get('/commande', [CommandeController::class, 'commande']);
Route::get('/updateOrderStatus/{k}/{y}', [CommandeController::class, 'updateOrderStatus']);
Route::post('/store_commande', [CommandeController::class, 'store_commande'])->name('store_commande');
Route::delete('/delete_commande', [CommandeController::class, 'delete_commande'])->name('delete_commande');
Route::get('/edit_commande', [CommandeController::class, 'edit_commande'])->name('edit_commande');
Route::post('/update_commande', [CommandeController::class, 'update_commande'])->name('update_commande');

//CRUD Mission
Route::get('/mission', [MissionController::class, 'mission']);
Route::get('/updateMissionStatus/{k}/{y}', [MissionController::class, 'updateMissionStatus']);
//Route::get('/changeStatus', 'MissionController@changeStatus')->name('changeStatus');
Route::get('/changeStatus', [MissionController::class, 'changeStatus'])->name('changeStatus');

Route::post('/store_mission', [MissionController::class, 'store_mission'])->name('store_mission');
Route::delete('/delete_mission', [MissionController::class, 'delete_mission'])->name('delete_mission');
Route::get('/edit_mission', [MissionController::class, 'edit_mission'])->name('edit_mission');
Route::post('/update_mission', [MissionController::class, 'update_mission'])->name('update_mission');
Route::get('/get_commande', [MissionController::class, 'get_commande'])->name('get_commande');
Route::get('/print_pdf_invoice/{id}', [MissionController::class, 'printPDFInvoice']);
Route::get('/get_vehicle', [MissionController::class, 'get_vehicle'])->name('get_vehicle');
Route::get('/get_driver', [MissionController::class, 'get_driver'])->name('get_driver');

//Notifications
Route::get('/notif_ass', [NotificationsController::class, 'notif_ass']);

/* Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php'; */

/* Route::get('/produit', [EmployeeController::class, 'employee']); */
