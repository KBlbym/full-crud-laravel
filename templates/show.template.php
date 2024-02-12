<?php 
    include_once 'utils.php';
    $modelAtrrs = getAttributeTypes($modelName);
?>
@extends('layouts.master')
@section('content')
    <h1>{{ __('Detalles del <?=$modelName?>') }}</h1>
    <?php foreach ($modelAtrrs as $key => $value ): ?>
    <p><strong>{{ __('<?=strtoupper($key)?>') }}: </strong> {{ $<?=strtolower($modelName).'->'.$key?> }}</p>
        
    <?php endforeach; ?>
    <a href="{{ route('<?=$modelNamePluralLower?>.index') }}" class="btn btn-primary">{{ __('Volver') }}</a>
@endsection
