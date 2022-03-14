<?php

use App\Http\Controllers\AcquisitionsController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\InterventionsController;
use App\Http\Controllers\LivraisonsController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\DirectionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

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

/* Route::get('/', function () {
    return view('auth.connexion');
});
 */
Route::get('/', [UserController::class, 'login']); 
Route::get('register', [UserController::class, 'register']);
Route::post('check', [UserController::class, 'check'])->name('check');
Route::post('store', [UserController::class, 'store'])->name('store');
Route::get('forgot', [UserController::class, 'forgot']);
Route::get('/resetview', [UserController::class, 'resetview']);
Route::put('/resetpassword', [UserController::class, 'resetpassword']);
Route::put('/reset', [UserController::class, 'reset']);

Route::get('check-queue', function(){
    Mail::to('kassim.moussali@gmail.com')->send(new TestMail());

    return 'Working';
}); 

Route::group(['middleware'=> ['logged']], function(){

    Route::get('/index', [UserController::class, 'index']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/change_infos/{user}', [UserController::class, 'change_infos']);
    Route::put('/change_pass/{user}', [UserController::class, 'change_pass']);

    Route::get('/stocks', [StocksController::class, 'index']);

    Route::get('/stocks/edit/{stock}', [StocksController::class, 'edit']);
    Route::get('/stocks/rentree/{stock}', [StocksController::class, 'rentree']);
    Route::get('/stocks/sortie/{stock}', [StocksController::class, 'sortie']);
    Route::put('/stocks/retrait/{stock}', [StocksController::class, 'soustraction']);
    Route::put('/stocks/ajout/{stock}', [StocksController::class, 'addition']);
    Route::get('/stocks/allsortie', [StocksController::class, 'allsortie']);
    Route::post('/stocks/allsortieby', [StocksController::class, 'allsortieby']);
    Route::get('/stocks/rentree/', [StocksController::class, 'rentree']);
    Route::get('/stocks/allrentree', [StocksController::class, 'allrentree']);
    Route::post('/stocks/allrentreeby', [StocksController::class, 'allrentreeby']);

    Route::get('stocks/newmateriel', [StocksController::class, 'create']);
    Route::post('stocks/store', [StocksController::class, 'store'])->name('stocks/store');
    Route::post('/stocks/store2', [StocksController::class, 'store2']);
    Route::delete('/stocks/delete/{stock}', [StocksController::class, 'destroy']);

    Route::get('/acquisition', [AcquisitionsController::class, 'index']);
    Route::get('/acquisition/newacquis', [AcquisitionsController::class, 'create']);
    Route::post('/acquisition/addacquisition', [AcquisitionsController::class, 'store']);
    Route::get('getServices', [ServicesController::class, 'getServices'])->name('getServices');
    Route::get('/acquisition/fiche/{acquisition}', [AcquisitionsController::class, 'show']);
    Route::get('/acquisition/edit/{acquisition}', [AcquisitionsController::class, 'edit']);
    Route::put('/acquisition/update/{acquisition}', [AcquisitionsController::class, 'update']);
    Route::delete('/acquisition/delete/{acquisition}', [AcquisitionsController::class, 'destroy']);
    Route::put('/acquisition/sihvalide/{acquisition}', [AcquisitionsController::class, 'sihvalide']);
    Route::put('/acquisition/dirvalide/{acquisition}', [AcquisitionsController::class, 'dirvalide']);
    Route::put('/acquisition/dsivalide/{acquisition}', [AcquisitionsController::class, 'dsivalide']);
    Route::put('/acquisition/change_status/{acquisition}', [AcquisitionsController::class, 'change_status']);
    Route::put('/acquisition/recu/{acquisition}', [AcquisitionsController::class, 'recu']);
    Route::put('/acquisition/livre/{acquisition}', [AcquisitionsController::class, 'livre']);
    Route::get('/acquisition/livraison/{acquisition}', [AcquisitionsController::class, 'livraison']);
    Route::put('/acquisition/addlivraison', [LivraisonsController::class, 'genere']);
    Route::get('/generate-pdf/{acquisition}', [AcquisitionsController::class, 'generatePDF']);

 
    Route::get('/intervention', [InterventionsController::class, 'index']);
    Route::get('/intervention/newintervention', [InterventionsController::class, 'create']);
    Route::post('/intervention/addintervention', [InterventionsController::class, 'store']);
    Route::get('/intervention/fiche/{intervention}', [InterventionsController::class, 'show']);
    Route::get('/intervention/edit/{intervention}', [InterventionsController::class, 'edit']);
    Route::get('/intervention/devis/{intervention}', [DevisController::class, 'create']);
    Route::get('/intervention/download/{devi}', [DevisController::class, 'download']);
    Route::post('/intervention/adddevis', [DevisController::class, 'store'])->name('adddevis');
    Route::delete('/intervention/delete/{intervention}', [InterventionsController::class, 'destroy']);
    Route::put('/intervention/editfiche/{intervention}', [InterventionsController::class, 'editfiche']);
    Route::put('/intervention/dirvalide/{intervention}', [InterventionsController::class, 'dirvalide']);
    Route::put('/intervention/sihvalide/{intervention}', [InterventionsController::class, 'sihvalide']);
    Route::put('/intervention/commentaire/{intervention}', [InterventionsController::class, 'commentaire']);
    Route::put('/intervention/dinvalide/{intervention}', [InterventionsController::class, 'dinvalide']);
    Route::get('/intervention/livraison/{intervention}', [InterventionsController::class, 'livraison']);
    Route::get('/generate-intervention/{intervention}', [InterventionsController::class, 'generatePDF']);
    Route::delete('/devis/delete/{devi}', [DevisController::class, 'destroy']);
    


    Route::get('/livraison', [LivraisonsController::class, 'index']);
    Route::get('/livraison/newlivraison', [LivraisonsController::class, 'create']);
    Route::put('/livraison/addlivraison', [LivraisonsController::class, 'store']);
    Route::get('/livraison/show/{livraison}', [LivraisonsController::class, 'show']);
    Route::delete('/livraison/delete/{livraison}', [LivraisonsController::class, 'destroy']);
    Route::get('/generate-livraison/{livraison}', [LivraisonsController::class, 'generatePDF']);
    

    Route::get('/admin', [UserController::class, 'admin']);
    Route::get('/admin/newdir', [DirectionsController::class, 'create']);
    Route::get('/admin/newservice', [ServicesController::class, 'create']);
    Route::get('/admin/newuser', [UserController::class, 'create']);
    Route::get('/admin/showuser', [UserController::class, 'list']);
    Route::get('/admin/useredit/{user}', [UserController::class, 'edit']);
    Route::delete('/admin/userdelete/{user}', [UserController::class, 'destroy']);
    Route::put('/admin/updateuser/{user}', [UserController::class, 'update']);

    Route::get('/admin/showdirections', [DirectionsController::class, 'index']);
    Route::get('/admin/dirshow/{direction}', [DirectionsController::class, 'show']);
    Route::get('/admin/diredit/{direction}', [DirectionsController::class, 'edit']);
    Route::delete('/admin/dirdelete/{direction}', [DirectionsController::class, 'destroy']);
    Route::put('/admin/updatedir/{direction}', [DirectionsController::class, 'update']);

    Route::get('/admin/showservices', [ServicesController::class, 'index']);
    Route::get('/admin/serviceedit/{service}', [ServicesController::class, 'edit']);
    Route::delete('/admin/servicedelete/{service}', [ServicesController::class, 'destroy']);
    Route::put('/admin/updateservice/{service}', [ServicesController::class, 'update']);

     

    Route::post('/admin/addir', [DirectionsController::class, 'store']);
    Route::post('/admin/addservice', [ServicesController::class, 'store']);
    Route::post('/admin/adduser', [UserController::class, 'store']);

});

