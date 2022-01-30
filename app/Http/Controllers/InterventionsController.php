<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Models\Intervention;
use App\Models\Service;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifInter1;
use App\Mail\NotifInter2;
use App\Mail\NotifInter3;
use App\Mail\NotifInter4;
use App\Mail\NotifInter5;
use App\Mail\NotifInter6;
use App\Mail\NotifInter7;
use App\Models\Devis;
use App\Models\Materiels_acquis;
use App\Models\Stock;

class InterventionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index(Request $request)
    {
        $devis = Devis::all();

        if (session('userLevel') == '1') {
            $search = $request['search'] ?? "";
            if($request->has('search')){
                $search = $request['search'] ;
                $interventions = Intervention::where(function ($query) use ($search) {
                            $query->where('dir_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('service_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('materiel', 'Like', '%'.$search.'%')
                                ->orWhere('ref_patrimoine', 'Like', '%'.$search.'%')
                                ->orWhere('id', 'Like', '%'.$search.'%');
                    })->orderBy('updated_at', 'desc')->paginate(10);
            }else {
                $interventions = Intervention::orderBy('updated_at', 'desc')->paginate(10);
            }
            return view('1.intervention.index', compact('interventions','search'));
        } 
        elseif (session('userLevel') == '2') {
            if (session('service') == 'IT HelpDesk') {
                $search = $request['search'] ?? "";
                if($request->has('search')){
                    $search = $request['search'] ;
                    $interventions = Intervention::where(function ($query) use ($search) {
                                $query->where('dir_demandeur', 'Like', '%'.$search.'%')
                                    ->orWhere('service_demandeur', 'Like', '%'.$search.'%')
                                    ->orWhere('materiel', 'Like', '%'.$search.'%')
                                    ->orWhere('ref_patrimoine', 'Like', '%'.$search.'%')
                                    ->orWhere('id', 'Like', '%'.$search.'%');
                        })->orderBy('updated_at', 'desc')->paginate(10);
                }else {
                    $interventions = Intervention::orderBy('updated_at', 'desc')->paginate(10);
                }
                return view('2.sih.intervention.index', compact('interventions','search'));
            } else {
            $search = $request['search'] ?? "";
                if($request->has('search')){
                    $search = $request['search'] ;
                    $interventions = Intervention::where('status_sih', 'approuve')
                    ->where('dir_demandeur', session('dir'))
                    ->where('service_demandeur', session('service'))->where(function ($query) use ($search) {
                        $query->where('nom_demandeur', 'Like', '%'.$search.'%')
                            ->orWhere('materiel', 'Like', '%'.$search.'%')
                            ->orWhere('ref_patrimoine', 'Like', '%'.$search.'%')
                            ->orWhere('id',$search);
                        })->orderBy('updated_at', 'desc')->paginate(10);
                }else {
                    $interventions = Intervention::Where(function ($query) {
                        $query->where('status_sih', 'approuve')
                            ->where('dir_demandeur', session('dir'))
                            ->where('service_demandeur', session('service'));
                    })->orderBy('id', 'desc')->paginate(10);
                }
                return view('2.intervention.index', compact('interventions', 'search'));
            }
        } 
        elseif (session('userLevel') == '3') {
            $search = $request['search'] ?? "";
            if($request->has('search')){
                $search = $request['search'] ;
                $interventions = Intervention::where('status_dir', 'approuve')->where(function ($query) use ($search) {
                            $query->where('dir_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('service_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('materiel', 'Like', '%'.$search.'%')
                                ->orWhere('ref_patrimoine', 'Like', '%'.$search.'%')
                                ->orWhere('id',$search);
                    })->orderBy('updated_at', 'desc')->paginate(10);
            }else {
                $interventions = Intervention::where('status_dir', 'approuve')->orderBy('updated_at', 'desc')->paginate(10);
            }
            return view('3.intervention.index', compact('interventions', 'search'));
        } 
        elseif (session('userLevel') == '4') {
            $search = $request['search'] ?? "";
            if($request->has('search')){
                $search = $request['search'] ;
                $interventions = Intervention::where('dir_demandeur', session('dir'))
                                ->where(function ($query) use ($search) {
                                $query->orWhere('service_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('materiel', 'Like', '%'.$search.'%')
                                ->orWhere('ref_patrimoine', 'Like', '%'.$search.'%')
                                ->orWhere('id', 'Like', '%'.$search.'%');
                    })->orderBy('updated_at', 'desc')->paginate(10);
            }else {
                $interventions = Intervention::orderBy('updated_at', 'desc')->paginate(10);
            }
            return view('4.intervention.index', compact('interventions','search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $directions = Direction::all();
        if (session('userLevel') == '1') {
            return view('1.intervention.newintervention', compact('services', 'directions'));
        } elseif (session('userLevel') == '2') {
            if (session('dir') == 'DSI') {
                return view('2.sih.intervention.newintervention', compact('services', 'directions'));
            } else {
                return view('2.intervention.newintervention', compact('services', 'directions'));
            }
        } elseif (session('userLevel') == '3') {
            return view('3.intervention.newintervention', compact('services'));
        } elseif (session('userLevel') == '4') {
            return view('4.intervention.newintervention', compact('services'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $request->validate([
            "nom_demandeur" => 'required',
            "nom_intervenant" => 'required',
            "service_demandeur" => 'required',
            "diagnostique" => 'required',
            "materiel" => 'required',
            "model" => 'required',
            "commentaire" => 'required',
            "ref_patrimoine" => 'required',
        ]); */
        $sih = 'IT HelpDesk';

        $intervention = new Intervention();
        $intervention->nom_demandeur = $request->nom_demandeur;
        $intervention->nom_intervenant = $request->nom_intervenant;
        $intervention->dir_demandeur = $request->dir_demandeur;
        $intervention->service_demandeur = $request->service_demandeur;
        $intervention->diagnostique = $request->diagnostique;
        $intervention->ref_patrimoine = $request->ref_patrimoine;
        $intervention->materiel = $request->materiel;
        $intervention->model = $request->model;
        $intervention->date_acquisition = $request->date_acquisition;
        $intervention->date_intervention = $request->date_intervention;
        $intervention->submitbyID = session('Loggeduser');
        $query = $intervention->save();



        if ($query) {
            $user = User::where('level', '2')->where('direction', 'DSI')
                ->where('service', $sih)->first();

            $nom = $request->input('nom_demandeur');
            $service = $request->input('service_demandeur');
            if ($user != null) {
                $to_name = $user->name;
                $to_email = $user->email;
                /* Mail::to($to_email, $to_name)
                    ->later(now()->addSeconds(1), new NotifInter1($nom, $service)); */
                return back()->with('success', 'Ajout réussi !');
            } else {
                return back()->with('success', 'Ajout réussi !');
            }
        } else {
            return back()->with('fail', 'Echec de l\'ajout ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Intervention $intervention)
    {
        $devis = Devis::where('numero_fiche', $intervention->id)->get();
        if (session('userLevel') == '1') {
            return view('1.intervention.show', compact('intervention'));
        } elseif (session('userLevel') == '2') {
            if (session('dir') == 'DSI') {
                return view('2.sih.intervention.show', compact('intervention', 'devis'));
            } else {
                return view('2.intervention.show', compact('intervention', 'devis'));
            }
        } elseif (session('userLevel') == '3') {
            return view('3.intervention.show', compact('intervention', 'devis'));
        } elseif (session('userLevel') == '4') {
            return view('4.intervention.show', compact('intervention', 'devis'));
        }
    }

    public function dirvalide(Request $request, Intervention $intervention)
    {
        $sih = 'IT HelpDesk';
        $commentaire =  $request->commentaire;
        $date =  $request->date_dir;
        $status =  $request->status_dir;
        /* if($status == 'approuve'){
            $intervention->update(['suggestion' => $suggestion, 'date_ser_approbation' => $date, 'status_service' => $status ]);
        } */
        $query = $intervention->update(['commentaire' => $commentaire, 'date_dir' => $date, 'status_dir' => $status]);

        if ($query) {
            if ($status == 'approuve') {
                $user = User::where('level', '3')->first();
                $nom = $intervention->nom_demandeur;
                $service = $intervention->service_demandeur;
                $dir = $intervention->dir_demandeur;
                $fiche = $intervention->id;
                if ($user != null) {
                    $to_name = $user->name;
                    $to_email = $user->email;
                    /* Mail::to($to_email, $to_name)
                        ->later(now()->addSeconds(1), new NotifInter2($nom, $service, $dir, $fiche)); */
                    return back()->with('success', 'Changement éffectué !');
                } else {
                    return back()->with('success', 'Changement éffectué !');
                }
            } elseif ($status == 'attente' || $status == 'rejete') {
                $user = User::where('level', '2')->where('direction', 'DSI')
                    ->where('service', $sih)->first();
                $nom = $intervention->nom_demandeur;
                $service = $intervention->service_demandeur;
                $dir = $intervention->dir_demandeur;
                $fiche = $intervention->id;
                if ($user != null) {
                    $to_name = $user->name;
                    $to_email = $user->email;
                    /* Mail::to($to_email, $to_name)
                        ->later(now()->addSeconds(1), new NotifInter3($nom, $service, $dir, $fiche, $status)); */
                    return back()->with('success', 'Changement effectué !');
                } else {
                    return back()->with('success', 'Changement effectué !');
                }
            }
            return back()->with('success', 'Ajout effectué');
        }
    }

    public function sihvalide(Request $request, Intervention $intervention)
    {
        $sih = 'IT HelpDesk';
        $suggestion =  $request->suggestion;
        $date =  $request->date_sih;
        $status =  $request->status_sih;
        $dir = $intervention->dir_demandeur;
        $service = $intervention->service_demandeur;
        if($service == $sih){
            $status_dir = $status;
             $query = $intervention->update(['suggestion' => $suggestion, 'date_sih' => $date, 'status_sih' => $status, 'status_dir' => $status_dir]);
        }else{
            $query = $intervention->update(['suggestion' => $suggestion, 'date_sih' => $date, 'status_sih' => $status]);
        }

        if ($query) {
            if ($status == 'approuve') {

                $nom = $intervention->nom_demandeur; 
                $fiche = $intervention->id;
                $user = User::where('level', '2')->where('direction',  $dir)
                    ->where('service', $service)->first();

                if ($user != null) {
                    $to_name = $user->name;
                    $to_email = $user->email;

                    /* Mail::to($to_email, $to_name)
                        ->later(now()->addSeconds(1), new NotifInter4($nom, $service, $dir, $fiche)); */
                        return back()->with('success', "Changement effectué  " );
                } else {
                    return back()->with('success', "Changement effectué mais il n'y a pas d'user pour le chef de service " . $service);
                }
            } elseif ($status == 'attente' || $status == 'rejete') {
                $user = $user = User::where('level', '1')->where('id', $intervention->submitbyID)->first();
                $nom = $intervention->nom_demandeur;
                $service = $intervention->service_demandeur;
                $dir = $intervention->dir_demandeur;
                $fiche = $intervention->id;
                if ($user != null) {
                    $to_name = $user->name;
                    $to_email = $user->email;
                    /* Mail::to($to_email, $to_name)
                        ->later(now()->addSeconds(1), new NotifInter5($nom, $service, $dir, $fiche, $status)); */
                    return back()->with('success', 'Changement effectué !');
                } else {
                    return back()->with('success', 'Changement effectué !');
                }
            }
        }
    }

    public function dinvalide(Request $request, Intervention $intervention)
    {
        $avis =  $request->avis;
        $date =  $request->date_din;
        $status =  $request->status_din;

        $query = $intervention->update(['avis' => $avis, 'date_din' => $date, 'status_din' => $status]);

        if ($query) {
            if ($status == 'approuve') {
                $nom = $intervention->nom_demandeur;
                $service = $intervention->service_demandeur;
                $dir = $intervention->dir_demandeur;
                $fiche = $intervention->id;
                $user = User::where('level', '2')->where('direction',  $dir)
                    ->where('service', $service)->first();
                if ($user != null) {
                    $to_name = $user->name;
                    $to_email = $user->email;
                    /* Mail::to($to_email, $to_name)
                        ->later(now()->addSeconds(1), new NotifInter4($nom, $service, $dir, $fiche)); */
                    return back()->with('success', 'Changement éffectué !');
                } else {
                    return back()->with('success', 'Changement éffectué !');
                }
            } elseif ($status == 'attente' || $status == 'rejete') {

                $nom = $intervention->nom_demandeur;
                $service = $intervention->service_demandeur;
                $dir = $intervention->dir_demandeur;
                $fiche = $intervention->id;
                $user = User::where('level', '2')->where('direction',  $dir)
                    ->where('service', $service )->first();
                $to_name = $user->name;
                $to_email = $user->email;

                /* Mail::to($to_email, $to_name)
                    ->later(now()->addSeconds(1), new NotifInter5($nom, $service, $dir, $fiche, $status)); */
            }
            return back()->with('success', 'Modification effectué');
        }
    }

    public function avis(Request $request, Intervention $intervention)
    {
        $avis =  $request->avis;
        $date =  $request->date_div;
        $status =  $request->status_div;
        $query = $intervention->update(['avis' => $avis, 'date_div' => $date, 'status_div' => $status]);

        if ($query) {
            /* if ($status == 'approuve') {
                $user = User::where('id', $intervention->submitbyID)->first();
                $user2 = User::where('direction', $intervention->dir_demandeur)
                ->where('level', '4')->first();
                $user3 = User::where('level', '3')->first();
                $nom = $intervention->nom_demandeur;
                $service = $intervention->service_demandeur;
                $dir = $intervention->dir_demandeur;
                $fiche = $intervention->id;
                $to_email = [$user->email, $user2->email, $user3->email];

                Mail::to($to_email)
                    ->later(now()->addSeconds(1), new NotifInter6($nom, $service, $dir, $fiche));
            } elseif ($status == 'attente' || $status == 'rejete') {
                $user = User::where('direction', $intervention->dir_demandeur)
                    ->where('level', '3')->first();
                $nom = $intervention->nom_demandeur;
                $service = $intervention->service_demandeur;
                $dir = $intervention->dir_demandeur;
                $fiche = $intervention->id;
                $to_name = $user->name;
                $to_email = $user->email;

                Mail::to($to_email, $to_name)
                    ->later(now()->addSeconds(1), new NotifInter7($nom, $service, $dir, $fiche, $status));
            } */
            return back()->with('success', 'Modification effectué');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Intervention $intervention)
    {
        $services = Service::where('direction', 'DSI')->get();
        $directions = Direction::all();
        if (session('userLevel') == '1') {
            return view('1.intervention.edit', compact('intervention', 'directions', 'services'));
        } elseif (session('userLevel') == '2') {
            if (session('dir') == 'DSI') {
                return view('2.sih.intervention.edit', compact('intervention', 'directions', 'services'));
            } else {
                return view('2.intervention.edit', compact('intervention', 'directions', 'services'));
            }
        } elseif (session('userLevel') == '3') {
            return view('3.intervention.edit', compact('intervention'));
        } elseif (session('userLevel') == '4') {
            return view('4.intervention.edit', compact('intervention'));
        }
    }

    public function editfiche(Request $request, Intervention $intervention)
    {
        $intervention->update($request->all());

        return back()->with('success', 'Modification réussie');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intervention $intervention)
    {
        $intervention->delete();

        return back()->with('success', 'fiche supprimé');
    }

    public function livraison(Intervention $intervention)
    {
        $stocks = Stock::all();
        $devis = Devis::where('numero_fiche', $intervention->id)->where('fiche', 'intervention')->get();
        $materiels = Materiels_acquis::where('fiche_acquisition', $intervention->id)->first();
        $sih = 'IT HelpDesk';
        $user = User::where('id', session('Loggeduser'))->first();
        if (session('userLevel') == '1') {
            return view('1.livraison.newlivraison', compact('intervention', 'stocks', 'materiels'));
        } elseif (session('userLevel') == '2') {
            if (session('userLevel') == '2') {
                if (session('service') == $sih) {
                    //return $materiels;
                    return view('2.sih.livraison.newlivraison', compact('intervention', 'stocks','materiels', 'devis'));
                } else {
                    return view('2.intervention.show', compact('intervention', 'materiels', 'devis'));
                }
            }
        } elseif (session('userLevel') == '3') {
            return view('3.intervention.show', compact('intervention', 'user', 'devis'));
        } elseif (session('userLevel') == '4') {
            if (session('dir') == 'DSI') {
                return view('4.dsi.intervention.show', compact('intervention', 'devis'));
            } else {
                return view('4.intervention.show', compact('intervention', 'user', 'devis'));
            }
        }
    }

    public function generatePDF(Intervention $intervention)
    {
        //PDF::setOptions(['defaultFont' => 'sans-serif']);
         $pdf = PDF::loadView('pdf.ficheintervention', compact('intervention'));

        return $pdf->download('fiche_intervention.pdf'); 
        /*return view('pdf.ficheintervention', compact('intervention'));*/
    }
}
