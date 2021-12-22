<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Intervention $intervention)
    {
        return view('2.sih.intervention.devis', compact('intervention'));
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
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            $fileModel = new Devis();
    
            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName);

                $fileModel->numero_devis = $request->numero_devis;
                $fileModel->fournisseur = $request->fournisseur;
                $fileModel->fiche = $request->fiche;
                $fileModel->numero_fiche = $request->numero_fiche;
                $fileModel->file_name = time().'_'.$request->file->getClientOriginalName();
                $fileModel->path =  $filePath;
                $fileModel->save();
    
                return back()
                ->with('success','Le devis a bien été enregistrer.')
                ->with('file', $fileName);
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

    public function download(Devis $devi)
    {
        $path = storage_path('app/'.$devi->path);
        return response()->download($path);
        //
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
    public function destroy(Devis $devi)
    {
        $devi->delete();

        return back()->with('success', 'fiche supprimé');
    }
}
