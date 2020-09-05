<?php

namespace App\Http\Controllers;
use App\Compte;
use App\Client;
use App\TypeCompte;
use App\TypeClient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompteClientController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return redirect('/comptes')->with('success', 'comptes saved!');
        $comptes = Compte::all();
        return view('compteclient.liste',compact('comptes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compteclient.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelCompte = new Compte();
        $ClientModel = new Client();
        $typeCompteModel = new TypeCompte();
        $typeClientModel = new TypeClient();
        if($request->get('valider'))
        {
        
            $type =  DB::table('type_comptes')->where('libelle', '=', $request->get('typeCompte'))->get();
            foreach ($type as $key => $t) 
            {
             $tp = $t->id ;
             
            }

            $modelCompte->type_compte_id = $tp;
            $modelCompte->cleRib  = "comp-".$request->get('numCompte');
            $modelCompte->date  = $request->get('dateO');
            $modelCompte->numero  =  $request->get('numCompte');
            $modelCompte->solde  = $request->get('solde');
            $modelCompte->frais  = $request->get('agio');
            $modelCompte->etat  = 1;
 
            if($request->get('ancien'))
            {
               $client = $ClientModel->find($request->get('idclient'));            
           
             $ok =1;
      
               if ($client != null && $type != null){
                  $modelCompte->client_id  = $request->get('idclient');
                  $save = $modelCompte->save();
      
               }else{
                  $ok = 0;
               }   
                  $data['ok'] = $ok;
                  return redirect()->back()->with('success', 'le client a un nouveau compte !');
                 // return view('compteClient/add',$data);
         
            }
            if($request->get('nouveau')){
               
                  $type =DB::table('type_clients')->where('libelle', '=', $request->get('typeClient'))->get();
        
                 // $typp = intval($type['id']);
                 foreach ($type as $key => $t) 
                 {
                  $tp = $t->id ;
                  
                 }
                  $ClientModel->typeclient =  $tp;
                  $ClientModel->email =  $request->get('email');
                  $ClientModel->adresse =  $request->get('adresse');
                  $ClientModel->telephone =  $request->get('tel');
                  $ClientModel->prenom =  $request->get('prenom');
                  $ClientModel->salaire =  $request->get('salaire');
                  $ClientModel->nomEntreprise =  $request->get('nomentreprise');
                
                  $cli = $ClientModel->save();
                  $modelCompte->client_id  = $ClientModel->id;

                  $comp =$modelCompte->save();
      
                     if($comp != null &&  $cli != null ){
                        $ok = 1;
                        $data['ok'] = $ok;
                     return redirect()->back()->with('success', 'client et compte enregistrer!');
                       // return view('compteclient/liste',$data);
                     }else{
                       $ok = 2;
                       $data['ok'] = $ok;
                       return view('compteclient/liste',$data);
                     }
      
            }
        
        }else{
            return $this->view->load("compteclient/add");
        }
      		return view('compteClient/liste');
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
    public function destroy($id)
    {
        //
    }
}
