<!-- Numero Field -->
<div class="form-group">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{{ $compte->numero }}</p>
</div>

<!-- Clerib Field -->
<div class="form-group">
    {!! Form::label('cleRib', 'Clerib:') !!}
    <p>{{ $compte->cleRib }}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $compte->date }}</p>
</div>

<!-- Etat Field -->
<div class="form-group">
    {!! Form::label('etat', 'Etat:') !!}
    <p>{{ $compte->etat }}</p>
</div>

<!-- Solde Field -->
<div class="form-group">
    {!! Form::label('solde', 'Solde:') !!}
    <p>{{ $compte->solde }}</p>
</div>

<!-- Frais Field -->
<div class="form-group">
    {!! Form::label('frais', 'Frais:') !!}
    <p>{{ $compte->frais }}</p>
</div>

<!-- Type Compte Id Field -->
<div class="form-group">
    {!! Form::label('type_compte_id', 'Type Compte Id:') !!}
    <p>{{ $compte->type_compte_id }}</p>
</div>

<!-- Client Id Field -->
<div class="form-group">
    {!! Form::label('client_id', 'Client Id:') !!}
    <p>{{ $compte->client_id }}</p>
</div>

