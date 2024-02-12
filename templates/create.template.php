<?php 
    include_once 'utils.php';
    $modelAtrrsTypes = getAttributeTypes($modelName);
   // var_dump($ats);
?>
@extends('layouts.master')

@section('content')
    <h1>{{ __('Crear nuevo <?=$modelName?>') }}</h1>
    <form action="{{ route('<?=$modelNamePluralLower?>.store') }}" method="POST">
        @csrf
        <?php foreach ($modelAtrrsTypes as $key => $value ): ?>
        <div class="form-group">
            
        <label for="<?=$key?>">{{ __('<?=ucfirst($key)?>') }}</label>
        <input type="<?= $value == 'integer' ? 'number' : 'text' ?>" name="<?=$key?>" id="<?=$key?>" class="form-control">
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </form>
@endsection


