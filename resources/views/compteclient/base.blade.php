<!DOCTYPE html>
<html>

    <head>
         <meta charset="UTF-8"/>
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
         <title>@yield('title')</title>
         <link rel="stylesheet" href="{{asset('/css/compte.css')}}"> 
         
    </head>
    <body>
       
     <div class="compte">
       <nav class="navbar">
                <div class="row">
                <div class="col-25">
                    <img src="{{asset('/image/logo.jpeg')}}" alt="logo" id="logo">
                    <h1>BANQUE DU PEUPLE</h1>
                </div>
                <div class="col-75">

                    <ul>
                        <li><a href="{{url('compteClient/create')}}">Ajout Compte</a></li>
                        <li><a href="{{url('compteClient')}}">Liste des Comptes</a></li>
                        <li><img src="{{asset('/image/user-connect.png')}}" alt="Avatar" class="user"><a>  {{ Auth::user()->name }}</a></li>
                        <li id="connexion"><a  href="{{ route('logout') }}"   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" id="deconect">Déconnexion</a></li>  
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                        </form>
                    </ul>
                </div>
                </div>
            </nav>

        <div class="corps">
    
        <div class="sliderBar">
                <div class="espace">

                </div>
                <div class="action">
                    <div class="slb-blanc"><a href="{{url('compteClient/create')}}"> Creer un Compte</a></div>
                    <div class="slb-degrade"><a href=""> Faire un Virement </a></div>
                    <div class="slb-blanc"><a href="">Bloquer un Compte</a></div>
                    <div class="slb-degrade"><a href="">Fermer unCompte</a></div>
                    <div class="slb-blanc"><a href=""> Archiver un compte</a></div>
                    <div class="slb-degrade"><a href="{{url('compteClient')}}">Liste des Comptes</a></div>
                </div>
                
            </div>
         @yield('body')
          <script type="text/javascript" src="{{asset('/js/compte.js')}}"></script> 

    </body>
</html>