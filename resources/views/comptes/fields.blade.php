<!-- Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Clerib Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cleRib', 'Clerib:') !!}
    {!! Form::text('cleRib', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Etat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('etat', 'Etat:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('etat', 0) !!}
        {!! Form::checkbox('etat', '1', null) !!}
    </label>
</div>


<!-- Solde Field -->
<div class="form-group col-sm-6">
    {!! Form::label('solde', 'Solde:') !!}
    {!! Form::number('solde', null, ['class' => 'form-control']) !!}
</div>

<!-- Frais Field -->
<div class="form-group col-sm-6">
    {!! Form::label('frais', 'Frais:') !!}
    {!! Form::number('frais', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Compte Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_compte_id', 'Type Compte Id:') !!}
    {!! Form::number('type_compte_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', 'Client Id:') !!}
    {!! Form::number('client_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('comptes.index') }}" class="btn btn-default">Cancel</a>
</div>
