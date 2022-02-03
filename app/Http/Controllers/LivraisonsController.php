<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Models\Livraison;
use App\Models\materiels_livres;
use App\Models\Sortie;
use App\Models\Stock;
use PDF;

class LivraisonsController extends Controller
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
                $livraisons = Livraison::where(function ($query) use ($search) {
                            $query->where('nom_intervenant', 'Like', '%'.$search.'%')
                                ->orWhere('nom_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('direction', 'Like', '%'.$search.'%')
                                ->orWhere('service', 'Like', '%'.$search.'%')
                                ->orWhere('fiche', 'Like', '%'.$search.'%')
                                ->orWhere('numero_fiche', 'Like', '%'.$search.'%')
                                ->orWhere('id', 'Like', '%'.$search.'%');
                    })->orderBy('id', 'desc')->paginate(10);
            }else {
                $livraisons = Livraison::orderBy('id', 'desc')->paginate(10);
            }
            return view('1.livraison.index',  compact('livraisons','search'));
        } 
        elseif (session('userLevel') == '2') {
            if (session('service') == $sih) {
                $search = $request['search'] ?? "";
            if($request->has('search')){
                $search = $request['search'] ;
                $livraisons = Livraison::where(function ($query) use ($search) {
                            $query->where('nom_intervenant', 'Like', '%'.$search.'%')
                                ->orWhere('nom_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('direction', 'Like', '%'.$search.'%')
                                ->orWhere('service', 'Like', '%'.$search.'%')
                                ->orWhere('fiche', 'Like', '%'.$search.'%')
                                ->orWhere('numero_fiche', 'Like', '%'.$search.'%')
                                ->orWhere('id', 'Like', '%'.$search.'%');
                    })->orderBy('id', 'desc')->paginate(10);
            }else {
                $livraisons = Livraison::orderBy('id', 'desc')->paginate(10);
            }
                return view('2.sih.livraison.index', compact('livraisons','search'));
            } else {
                $search = $request['search'] ?? "";
            if($request->has('search')){
                $search = $request['search'] ;
                $livraisons = Livraison::where('direction', session('dir'))->where('service', session('service'))->
                where(function ($query) use ($search) {
                            $query->where('nom_demandeur', 'Like', '%'.$search.'%')
                                ->orWhere('fiche', 'Like', '%'.$search.'%')
                                ->orWhere('numero_fiche', 'Like', '%'.$search.'%')
                                ->orWhere('id', 'Like', '%'.$search.'%');
                    })->orderBy('id', 'desc')->paginate(10);
            }else {
                $livraisons = Livraison::where('direction', session('dir'))->where('service', session('service'))->orderBy('id', 'desc')->paginate(10);
            }
                return view('2.livraison.index', compact('livraisons','search'));
            } 
            
        } 
        elseif (session('userLevel') == '3') {
            $livraisons = Livraison::orderBy('id', 'desc')->paginate(5);
            return view('3.livraison.index', compact('livraisons'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directions = Direction::all();
        $stocks = Stock::all();
        if (session('userLevel') == '1') {
            return view('1.livraison.newlivraison', compact('directions', 'stocks'));
        } elseif (session('userLevel') == '2') {
            return view('2.sih.livraison.newlivraison', compact('directions', 'stocks'));
        } elseif (session('userLevel') == '3') {
            return view('3.livraison.newlivraison', compact('directions', 'stocks'));
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
        $nom_materiel = $request->input('nom_materiel');
        $quantite = $request->input('quantite');
        $observation = $request->input('observation');
        $livraison_id = $request->input('livraison_id');
        $nbr = count($nom_materiel);

        for ($i = 0; $i < $nbr; $i++) {
            $materiel = new materiels_livres;
            $materiel->nom_materiel = $nom_materiel[$i];
            $materiel->quantite = $quantite[$i];
            $materiel->observation = $observation[$i];
            $materiel->livraison_id = $livraison_id;
            $query = $materiel->save();

            $stock = Stock::where('materiel', $nom_materiel[$i])->first();
            $old_quantite = $stock->quantite;
            $new_quantite =  $old_quantite - $quantite[$i];
            $query3 = Stock::where('materiel', $nom_materiel[$i])->update(['quantite' => $new_quantite]);

            $sortie = new Sortie;
            $sortie->materiel = $nom_materiel[$i];
            $sortie->quantite = $quantite[$i];
            $sortie->raison = "livraison";
            $sortie->date_sortie = $request->date_livraison;
            $sortie->numero_fiche = $livraison_id;
            $query5 = $sortie->save();
        }

        $livraison = new Livraison;
        $livraison->id = $livraison_id;
        $livraison->nom_intervenant = $request->input('nom_intervenant');
        $livraison->nom_demandeur = $request->input('nom_demandeur');
        $livraison->direction = $request->input('direction');
        $livraison->service = $request->input('service');
        $livraison->fiche = $request->input('fiche');
        $livraison->numero_fiche = $request->input('numero_fiche');
        $livraison->date_livraison = $request->input('date_livraison');
        $query2 = $livraison->save();

        /* $user = User::where('direction', '=', session('dir'))->where('level', '2')->first();

        $to_name = $user->name;
        $to_email = $user->email;
        $ligne1 = "Une nouvelle mission à soumit dans le Gestionnaire des Missions  par " . session('username') . " ";
        $ligne2 = "Pour voir et approuver la mission cliquer sur la rubirique Nouvelle Mission ";
        $name = session('username');
        Mail::to($to_email, $to_name)
            ->later(now()->addSeconds(1), new Notifs()); */

        if ($query && $query2) {
            return back()->with('success', 'Fiche de livraison soumis avec succès');
        } else {
            return back()->with('fail', "Echec de l'ajout de la soumission");
        }
        //return redirect()->route('register');
    }

    public function genere(Request $request)
    {

        $nom_materiel = $request->input('nom_materiel');
        $quantite = $request->input('quantite');
        $observation = $request->input('observation');
        $livraison_id = $request->input('livraison_id');
        $description_mat = $request->input('description_mat');
        $marque_mat = $request->input('marque_mat');
        

            $materiel = new materiels_livres;
            $materiel->nom_materiel = $nom_materiel;
            $materiel->description_mat = $description_mat;
            $materiel->marque_mat = $marque_mat;
            $materiel->quantite = $quantite;
            $materiel->observation = $observation;
            $materiel->livraison_id = $livraison_id;
            $query = $materiel->save();

        $livraison = new Livraison;
        $livraison->id = $livraison_id;
        $livraison->nom_intervenant = $request->input('nom_intervenant');
        $livraison->nom_demandeur = $request->input('nom_demandeur');
        $livraison->direction = $request->input('direction');
        $livraison->service = $request->input('service');
        $livraison->fiche = $request->input('fiche');
        $livraison->numero_fiche = $request->input('numero_fiche');
        $livraison->date_livraison = $request->input('date_livraison');
        $query2 = $livraison->save();

        

        if ($query && $query2) {
            return back()->with('success', 'Fiche de livraison généré avec succès');
        } else {
            return back()->with('fail', "Echec de la génération de la fiche ");
        }
        //return redirect()->route('register');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Livraison $livraison)
    {
        $sih = 'IT HelpDesk';
        $materiels = materiels_livres::where('livraison_id', $livraison->id)->get();
        
        if (session('userLevel') == '1') {
            return view('1.livraison.show', compact('livraison', 'materiels'));
        } elseif (session('userLevel') == '2') {
            if (session('service') == $sih) {
                return view('2.sih.livraison.show', compact('livraison', 'materiels'));
            } else {
                return view('2.livraison.show', compact('livraison', 'materiels'));
            } 
        } elseif (session('userLevel') == '3') {
            return view('3.livraison.show', compact('livraison', 'materiels'));
        }
    }

    public function generatePDF(Livraison $livraison)
    {
        //PDF::setOptions(['defaultFont' => 'sans-serif']);
        $materiels = materiels_livres::where('livraison_id', $livraison->id)->get();
        $pdf = PDF::loadView('pdf.fichelivraison', compact('livraison', 'materiels'));

        return $pdf->download('fiche_livraison.pdf');
        /* return view('fiches', compact('acquisition')); */
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
    public function destroy(Livraison $livraison)
    {
        $livraison->delete();

        materiels_livres::where('livraison_id',$livraison->id)->delete();

        return back()->with('success', 'fiche supprimé');
    }
}
