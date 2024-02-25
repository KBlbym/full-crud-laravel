<?php 
    include_once 'utils.php';
    $modelAtrrsTypes = getAttributeTypes($modelName);
    $inputTypes = [
        'integer' => 'number',
        'string' => 'text',
        'boolean' => 'checkbox',
        'date' => 'date',
        'email' => 'email',
        'textarea' => 'textarea',

        // Si tienes mas tipos los puedes añadir aquí
    ];
?>
@extends('layouts.master')

@section('content')
    <h1>{{ __('Crear nuevo <?=$modelName?>') }}</h1>
    <form action="{{ route('<?=$modelNamePluralLower?>.store') }}" method="POST">
        @csrf
        <?php foreach ($modelAtrrsTypes as $key => $value ): 
            $inputType = $inputTypes[$value] ?? 'text';
        ?>
            
        <div class="form-group">
            
        <label for="<?=$key?>">{{ __('<?=ucfirst($key)?>') }}</label>
        <?php if($inputType == 'textarea') :  ?>
        <textarea class="form-control" name="<?=$key?>" id="<?=$key?>"></textarea>
        <?php else: ?>
        <input type="<?= $inputType ?>" name="<?=$key?>" id="<?=$key?>" class="form-control">
        <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </form>
@endsection


