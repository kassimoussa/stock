<?php

namespace App\Http\Controllers;

use App\Models\Rentree;
use App\Models\Sortie;
use App\Models\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request['search'] ?? "";
        if ($request->has('search')) {
            $search = $request['search'];
            $stocks = Stock::where('materiel', 'Like', '%' . $search . '%')->get();
        } else {
            $stocks = Stock::all();
        }
        //$stocks = compact('stocks');

        if (session('userLevel') == '1') {
            return view('1.stock.index', compact('stocks', 'search'));
        } elseif (session('userLevel') == '2') {
            //return $search;
            return view('2.sih.stock.index', compact('stocks', 'search'));
        } elseif (session('userLevel') == '3') {
            return view('3.stock.index', compact('stocks', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session('userLevel') == '1') {
            return view('1.stock.create');
        } elseif (session('userLevel') == '2') {
            return view('2.sih.stock.create');
        } elseif (session('userLevel') == '3') {
            return view('3.stock.create');
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
        $nbr = count($nom_materiel);

        for ($i = 0; $i < $nbr; $i++) {
            $stock = new Stock();
            $stock->materiel = $nom_materiel[$i];
            $stock->quantite = $quantite[$i];

            $query = $stock->save();
        }
        if ($query) {
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
    public function edit(Stock $stock)
    {
        return view('1.stock.edit', compact('stock'));
    }
    public function rentree(Stock $stock)
    {
        $rentrees = Rentree::where('materiel', $stock->materiel)->get();
        $sorties = Sortie::where('materiel', $stock->materiel)->get();
        if (session('userLevel') == '1') {
            return view('1.stock.rentree', compact('stock', "rentrees", "sorties"));
        } elseif (session('userLevel') == '2') {
            return view('2.sih.stock.rentree', compact('stock', "rentrees", "sorties"));
        } elseif (session('userLevel') == '3') {
            return view('3.stock.rentree', compact('stock', "rentrees", "sorties"));
        }
    }

    public function sortie(Stock $stock)
    {
        $rentrees = Rentree::where('materiel', $stock->materiel)->orderby('date_rentree', 'desc')->get();
        $sorties = Sortie::where('materiel', $stock->materiel)->orderby('date_sortie', 'desc')->get();
        if (session('userLevel') == '2') {
            return view('2.sih.stock.sortiee', compact('stock', "rentrees", "sorties"));
        } elseif (session('userLevel') == '4') {
            return view('4.stock.sortiee', compact('stock', "rentrees", "sorties"));
        }
    }

    public function soustraction(Request $request, Stock $stock)
    {
        $old_quantite = $stock->quantite;
        $new_quantite =  $old_quantite - $request->quantite;
        $query1 = $stock->update(['quantite' => $new_quantite]);

        $sortie = new Sortie();
        $sortie->materiel = $stock->materiel;
        $sortie->quantite = $request->quantite;
        $sortie->raison = $request->raison;
        $sortie->date_sortie = $request->date_sortie;
        $query2 = $sortie->save();
        if ($query1 && $query2) {
            return back()->with('success', 'Rétrait effectué');
        } else {
            return back()->with('fail', 'Echec du rétrait ');
        }
    }

    public function addition(Request $request, Stock $stock)
    {
        $old_quantite = $stock->quantite;
        $new_quantite =  $old_quantite + $request->quantite;
        $query1 = $stock->update(['quantite' => $new_quantite]);

        $rentree = new Rentree();
        $rentree->materiel = $stock->materiel;
        $rentree->quantite = $request->quantite;
        $rentree->fournisseur = $request->fournisseur;
        $rentree->date_rentree = $request->date_rentree;
        $query2 = $rentree->save();
        if ($query1 && $query2) {
            return back()->with('success', 'Ajout effectué');
        } else {
            return back()->with('fail', 'Echec de l\'ajout ');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
