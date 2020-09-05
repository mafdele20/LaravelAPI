@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Type Compte
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($typeCompte, ['route' => ['typeComptes.update', $typeCompte->id], 'method' => 'patch']) !!}

                        @include('type_comptes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection