@extends('compteclient.base')

@section('title', 'listeCompte')
@section('body') 


        <div class="container">  
           <strong>liste de tous les Comptes</strong>
          <div classe="tab" class="tab">
        
            <table id="listecompte">
            <thead>
              <tr>
                    <th>id Compte</th>
                    <th>Numero</th>
                    <th>Agence</th>
                    <th>cléRib</th>
                    <th>Date Ouverture</th>
                    <th>Solde</th>
                    <th>Type de compte</th>           
                    <th>Frais</th>
                    <th>Propriétaire</th>
              </tr>
            </thead>
             <tbody>
             @foreach ($comptes as $compe)
                      <tr>
                          <td> {{$compe->id}}</td>
                          <td> {{$compe->numero}}</td>
                          <td> dakar</td>
                          <td> {{$compe->cleRib}}</td>
                          <td> {{$compe->date}}</td>
                          <td> {{$compe->solde}}</td>
                          <td> {{\App\TypeCompte::find($compe->type_compte_id)->libelle}}</td>
                          <td> {{$compe->frais}}</td>
                          <td> {{App\Client::find($compe->client_id)->email }}</td>
                      </tr>
            @endforeach
             </tbody>

            </table>

  
    </div>
  </div>
     
  @endsection