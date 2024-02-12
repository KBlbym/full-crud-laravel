<?php 
    include_once 'utils.php';
    $modelAtrrs = getAttributeTypes($modelName);
?>
@extends('layouts.master')

@section('content')
    <h1>{{ __('Editar <?=$modelName?>') }}</h1>
    <form action="{{ route('<?=$modelNamePluralLower?>.update', $<?=strtolower($modelName)?>->id) }}" method="POST">
        @csrf
        @method('PUT')
        <?php foreach ($modelAtrrs as $key => $value ): ?>
        <div class="form-group">
        <label for="<?=$key?>">{{ __('<?=ucfirst($key)?>') }}</label>
        <input type="<?= $value == 'integer' ? 'number' : 'text' ?>" name="<?=$key?>" id="<?=$key?>" class="form-control" value="{{ $<?=strtolower($modelName).'->'.$key?> }}">
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">{{ __('Guardar cambios') }}</button>
    </form>
@endsection
