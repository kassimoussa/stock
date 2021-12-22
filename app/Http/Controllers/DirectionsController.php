<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;

class DirectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = Direction::paginate(10);
        
        if (session('userLevel') == '2') {
            return view('2.sih.admin.listdir', compact('directions'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.listdir', compact('directions'));
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
        return view('2.sih.admin.addDir');
        if (session('userLevel') == '2') {
            return view('2.sih.admin.addDir');
        } elseif (session('userLevel') == '3') {
            return view('3.admin.addDir');
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
        $request->validate([
            "nom" => 'required',
            "sigle" => 'required|unique:directions',
        ]);
        $direction = new Direction();
        $direction->nom = $request->nom;
        $direction->sigle = $request->sigle;
        $query = $direction->save();

        if($query){
            return back()->with('success', 'Ajout réussi');
        }else{
            return back()->with('fail', 'Echec de l\'ajout ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
       
        if (session('userLevel') == '2') {
            return view('2.sih.admin.showdir', compact('direction'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.showdir', compact('direction'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Direction $direction)
    {
        
        if (session('userLevel') == '2') {
            return view('2.sih.admin.editdir', compact('direction'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.editdir', compact('direction'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direction $direction)
    {
        $direction->update($request->all());

        return back()->with('success', 'Modification réussie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direction $direction)
    {
        $direction->delete();

        return back()->with('success', 'Suppression réussie');
    }
}
