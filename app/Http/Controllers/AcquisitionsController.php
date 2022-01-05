<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acquisition;
use App\Models\Direction;
use App\Models\Service;
use App\Models\User;
use App\Models\Devis;
use PDF;
use Mail;
use App\Mail\Notif1;
use App\Mail\Notif2;
use App\Mail\Notif3;
use App\Models\Materiels_acquis;

class AcquisitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sih = 'IT HelpDesk';
        
        if (session('userLevel') == '1') {
            $search = $request['search'] ?? "";
            if($request->has('search')){
                $search = $request['search'] ;
                $acquisitions = Acquisition::where('id', 'Like', '%'.$search.'%')->orderBy('id', 'desc')->get();
            }else {
                $acquisitions = Acquisition::orderBy('id', 'desc')->paginate(10);
            }
            return view('1.acquisition.index', compact('acquisitions','search'));
        } 
        elseif (session('userLevel') == '2') {
            if (session('service') == $sih) {
                $search = $request['search'] ?? "";
                if($request->has('search')){
                    $acquisitions = Acquisition::where(function ($query) {
                        $query->where('status_dir', 'approuve');
                    })->Where(function ($query) use ($search) {
                                $query->where('dir_demandeur', 'Like', '%'.$search.'%')
                                    ->orWhere('service_demandeur', 'Like', '%'.$search.'%')
                                    ->orWhere('nom_mat', 'Like', '%'.$search.'%')
                                    ->orWhere('id', 'Like', '%'.$search.'%');
                        })->orderBy('updated_at', 'desc')->paginate(10);
                    return view('2.sih.acquisition.index', compact('acquisitions','search'));
                }else {
                    $acquisitions = Acquisition::Where(function ($query) {
                        $query->where('status_dir', 'approuve');
                    })->orderBy('updated_at', 'desc')->paginate(10);
                    return view('2.sih.acquisition.index', compact('acquisitions','search'));
                }
                
            } else {
                $search = $request['search'] ?? "";
                if($request->has('search')){
                    $acquisitions = Acquisition::where(function ($query) {
                        $query->where('dir_demandeur', session('dir'))
                        ->where('service_demandeur', session('service'))
                         ->where('status_dsi', 'approuve');
                    })->Where(function ($query) use ($search) {
                                $query->where('nom_demandeur', 'Like', '%'.$search.'%')
                                    ->orWhere('service_demandeur', 'Like', '%'.$search.'%')
                                    ->orWhere('nom_mat', 'Like', '%'.$search.'%')
                                    ->orWhere('id', 'Like', '%'.$search.'%');
                        })->orderBy('updated_at', 'desc')->paginate(10);
                        return view('2.acquisition.index', compact('acquisitions','search'));
                }else {
                    $acquisitions = Acquisition::Where(function ($query) {
                        $query->where('dir_demandeur', session('dir'))
                        ->where('service_demandeur', session('service'))
                        ->where('status_dsi', 'approuve');
                    })->orderBy('id', 'desc')->paginate(10);
                    return view('2.acquisition.index', compact('acquisitions','search'));
                }
            }
        } 
        elseif (session('userLevel') == '3') { 
            $search = $request['search'] ?? "";
            if($request->has('search')){
                $acquisitions = Acquisition::where(function ($query) {
                    $query->where('status_sih', 'approuve');
                })->Where(function ($query) use ($search) {
                            $query->where('dir_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('service_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('nom_mat', 'Like', '%'.$search.'%')
                                ->orWhere('id', 'Like', '%'.$search.'%');
                    })->orderBy('updated_at', 'desc')->paginate(10);
                return view('3.acquisition.index', compact('acquisitions','search'));
            }else {
                $acquisitions = Acquisition::Where(function ($query) {
                    $query->where('status_sih', 'approuve');
                })->orderBy('updated_at', 'desc')->paginate(10);
                return view('3.acquisition.index', compact('acquisitions','search'));
            }
        } elseif (session('userLevel') == '4') {
            if (session('dir') == 'DSI') {
                $acquisitions = Acquisition::Where(function ($query) {
                    $query->where('status_sih', 'approuve');
                })->orderBy('id', 'desc')->paginate(10);
                return view('4.dsi.acquisition.index', compact('acquisitions'));
            } else {
                $acquisitions = Acquisition::Where(function ($query) {
                    $query->where('dir_demandeur', session('dir'));
                })->orderBy('id', 'desc')->paginate(10);
                return view('4.acquisition.index', compact('acquisitions'));
            }
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sih = 'IT HelpDesk';
        $directions = Direction::all();
        $services = Service::where('direction', session('dir'))->get();

        if (session('userLevel') == '2') {
            if (session('service') == $sih) {
                return view('2.sih.acquisition.newacquis', compact('services'));
            }
        } elseif (session('userLevel') == '3') {;
            return view('3.acquisition.newacquis', compact('services'));
        } elseif (session('userLevel') == '4') {
            if (session('dir') == 'DSI') {
                return view('4.dsi.acquisition.newacquis', compact('services'));
            } else {
                return view('4.acquisition.newacquis', compact('services'));
            }
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
        $sih = 'IT HelpDesk';
        $request->validate([
            "nom_demandeur" => 'required',
            "service_demandeur" => 'required',
            "nom_mat" => 'required',
            "marque_mat" => 'required',
        ]);

        $stadsi = null;
        $datedsi = null;
        $stasih = null;
        $datesih = null;
        if (session('dir') == "DSI") {
            if (session('userLevel') == "4") {
                $stadsi = "approuve";
                $stasih = "approuve";
                $datedsi = $request->date_submit;
                $datesih = $request->date_submit;
            } elseif (session('userLevel') == "2" || session('userLevel') == "3") {
                $stasih = "approuve";
                $datesih = $request->date_submit;
            }
        } else {
            $stadsi = null;
            $datedsi = null;
            $stasih = null;
            $datesih = null;
        }

        $acquisition = new Acquisition();
        $acquisition->id = $request->id;
        $acquisition->nom_demandeur = $request->nom_demandeur;
        $acquisition->dir_demandeur = session('dir');
        $acquisition->service_demandeur = $request->service_demandeur;
        $acquisition->nom_mat = $request->nom_mat;
        $acquisition->quantite = $request->quantite;
        $acquisition->description_mat = $request->description_mat;
        $acquisition->marque_mat = $request->marque_mat; 
        $acquisition->model_mat = $request->model_mat;
        $acquisition->processeur_mat = $request->processeur_mat;
        $acquisition->ram_mat = $request->ram_mat;
        $acquisition->stockage_mat = $request->stockage_mat;
        $acquisition->os_mat = $request->os_mat;
        $acquisition->date_submit = $request->date_submit;
        $acquisition->date_dir = $request->date_submit;
        $acquisition->date_sih = $datesih;
        $acquisition->date_dsi = $datedsi;
        $acquisition->status_dir = "approuve";
        $acquisition->status_dsi = $stadsi;
        $acquisition->status_sih = $stasih;
        $acquisition->submitbyID = session('Loggeduser');
        $query = $acquisition->save();

        $materiel = new Materiels_acquis();
        $materiel->fiche_acquisition = $request->id;
        $materiel->nom_mat = $request->nom_mat;
        $materiel->quantite = $request->quantite;
        $materiel->description_mat = $request->description_mat;
        $materiel->marque_mat = $request->marque_mat;
        $materiel->processeur_mat = $request->processeur_mat;
        $materiel->ram_mat = $request->ram_mat;
        $materiel->stockage_mat = $request->stockage_mat;
        $materiel->os_mat = $request->os_mat;
        $query2 = $materiel->save();


        $fileModel = new Devis();

        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName);

            $fileModel->numero_devis = $request->numero_devis;
            $fileModel->fournisseur = $request->fournisseur;
            $fileModel->fiche = 'acquisition';
            $fileModel->numero_fiche = $request->id;
            $fileModel->file_name = time() . '_' . $request->file->getClientOriginalName();
            $fileModel->path =  $filePath;
            $query2 =   $fileModel->save();
        }
        $user = User::where('level', '2')->where('direction', 'DSI')
            ->where('service', 'IT HelpDesk')->first();

        $submitby = session('username');
        $nom = $request->nom_demandeur;
        $service = $request->service_demandeur;
        $direction = session('dir');
        $materiel = $request->materiel;
        $to_name = $user->name;
        $to_email = $user->email;
        if ($query) {
            Mail::to($to_email, $to_name)
                ->later(now()->addSeconds(1), new Notif1($nom, $service, $direction, $submitby, $materiel));
            return back()->with('success', 'Ajout réussi');
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
    public function show(Acquisition $acquisition)
    {
        $devis = Devis::where('numero_fiche', $acquisition->id)->where('fiche', 'acquisition')->get();
        $sih = 'IT HelpDesk';
        $user = User::where('id', session('Loggeduser'))->first();
        if (session('userLevel') == '1') {
            return view('1.acquisition.show', compact('acquisition', 'user', 'devis'));
        } elseif (session('userLevel') == '2') {
            if (session('userLevel') == '2') {
                if (session('service') == $sih) {
                    return view('2.sih.acquisition.show', compact('acquisition', 'user', 'devis'));
                } else {
                    return view('2.acquisition.show', compact('acquisition', 'user', 'devis'));
                }
            }
        } elseif (session('userLevel') == '3') {
            return view('3.acquisition.show', compact('acquisition', 'user', 'devis'));
        } elseif (session('userLevel') == '4') {
            if (session('dir') == 'DSI') {
                return view('4.dsi.acquisition.show', compact('acquisition', 'devis'));
            } else {
                return view('4.acquisition.show', compact('acquisition', 'user', 'devis'));
            }
        }
    }

    public function generatePDF(Acquisition $acquisition)
    {
        //PDF::setOptions(['defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.ficheacq', compact('acquisition'));

        return $pdf->download('fiche.pdf');
        /* return view('fiches', compact('acquisition')); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Acquisition $acquisition)
    {
        $directions = Direction::all();
        return view('2.sih.acquisition.edit', compact('acquisition', 'directions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acquisition $acquisition)
    {
        $acquisition->update($request->all());

        return back()->with('success', 'Modification réussie');
    }


    public function sihvalide(Request $request, Acquisition $acquisition)
    {
        $date =  $request->date_sih;
        $status =  $request->status_sih;
        $dirdemandeur = $acquisition->dir_demandeur;
        $date_submit = $acquisition->date_submit;
        $acquisition->update(['status_sih' => $status, 'date_sih' => $date]);

        $user = User::where('level', '4')->where('direction', 'DSI')->first();


        $to_email = $user->email;
        /* Mail::to($to_email)
            ->later(now()->addSeconds(1), new Notif2($dirdemandeur, $date_submit)); */

        return redirect('/acquisition')->with('success', 'Action éffectue');
        /* return back()->with('success', 'Modification réussie'); */
    }

    public function dsivalide(Request $request, Acquisition $acquisition)
    {
        $date =  $request->date_dsi;
        $status =  $request->status_dsi;
        $dirdemandeur = $acquisition->dir_demandeur;
        $date_submit = $acquisition->date_submit;
        $acquisition->update(['status_dsi' => $status, 'date_dsi' => $date]);

        $user = User::where('level', '4')->where('direction', $dirdemandeur)->first();


        $to_email = $user->email;
        /* Mail::to($to_email)
            ->later(now()->addSeconds(1), new Notif2($dirdemandeur, $date_submit)); */

        return redirect('/acquisition')->with('success', 'Action éffectue');
        /* return back()->with('success', 'Modification réussie'); */
    }

    public function change_status(Request $request, Acquisition $acquisition)
    {
        if ($acquisition->status == 0) {
            $acquisition->update(['status' => '1']);
        } else {
            $acquisition->update(['status' => '0']);
        }

        return redirect('/acquisition')->with('success', 'Status de fiche changé');
        /* return back()->with('success', 'Modification réussie'); */
    }

    public function recu(Request $request, Acquisition $acquisition)
    {
        if ($acquisition->recu == 'non') {
            $acquisition->update(['recu' => 'oui']);
        } else {
            $acquisition->update(['recu' => 'non']);
        }

        return redirect('/acquisition')->with('success', 'Status de réception changé');
        /* return back()->with('success', 'Modification réussie'); */
    }

    public function livre(Request $request, Acquisition $acquisition)
    {
        if ($acquisition->livre == 'non') {
            $acquisition->update(['livre' => 'oui']);
        } else {
            $acquisition->update(['livre' => 'non']);
        }

        return redirect('/acquisition')->with('success', 'Status de réception changé');
        /* return back()->with('success', 'Modification réussie'); */
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acquisition $acquisition)
    {
        $acquisition->delete();

        return back()->with('success', 'fiche supprimé');
    }

    public function livraison(Acquisition $acquisition)
    {
        $devis = Devis::where('numero_fiche', $acquisition->id)->where('fiche', 'acquisition')->get();
        $materiels = Materiels_acquis::where('fiche_acquisition', $acquisition->id)->first();
        $sih = 'IT HelpDesk';
        $user = User::where('id', session('Loggeduser'))->first();
        if (session('userLevel') == '1') {
            return view('1.acquisition.show', compact('acquisition', 'materiels', 'devis'));
        } elseif (session('userLevel') == '2') {
            if (session('userLevel') == '2') {
                if (session('service') == $sih) {
                    //return $materiels;
                    return view('2.sih.acquisition.newlivraison', compact('acquisition', 'materiels', 'devis'));
                } else {
                    return view('2.acquisition.show', compact('acquisition', 'materiels', 'devis'));
                }
            }
        } elseif (session('userLevel') == '3') {
            return view('3.acquisition.show', compact('acquisition', 'user', 'devis'));
        } elseif (session('userLevel') == '4') {
            if (session('dir') == 'DSI') {
                return view('4.dsi.acquisition.show', compact('acquisition', 'devis'));
            } else {
                return view('4.acquisition.show', compact('acquisition', 'user', 'devis'));
            }
        }
    }
}
