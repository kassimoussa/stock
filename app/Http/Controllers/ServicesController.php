<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Direction;

class ServicesController extends Controller
{
    

    public function getServices(Request $request)
    {
        $dir = $request->dir_id;

        $services = Service::where('direction', $dir)->pluck('nom');
        return response()->json($services);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(10);
        if (session('userLevel') == '2') {
            return view('2.sih.admin.listservice', compact( 'services' ));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.listservice', compact( 'services' ));
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
        if (session('userLevel') == '2') {
            return view('2.sih.admin.addService', compact('directions'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.addService', compact('directions'));
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
            "direction" => 'required'
        ]);
        $service = new Service();
        $service->nom = $request->nom;
        $service->direction = $request->direction;
        $query = $service->save();

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
    public function edit(Service $service)
    {
        $directions = Direction::all();
        
        if (session('userLevel') == '2') {
            return view('2.sih.admin.editservice', compact('service', 'directions'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.editservice', compact('service', 'directions'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());

        return back()->with('success', 'Modification réussie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return back()->with('success', 'Suppression réussie');
    }
}
