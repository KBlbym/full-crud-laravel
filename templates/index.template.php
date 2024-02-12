<?php 
    include_once 'utils.php';
    $modelAtrrs = getAttributeTypes($modelName);
?>

@extends('layouts.master')

@section('content')
    <h1>{{ __('Listado de de <?=$modelNamePluralLower?>') }}</h1>
    <a href="{{route('<?=$modelNamePluralLower?>.create') }}" class="btn btn-primary">{{__('Crear nuevo elemento') }}</a>

    <table class="table">
        <thead>
            <tr>
        <?php 
            foreach ($modelAtrrs as $key => $value) :
        ?>
        <th><?=$key?></th>
        <?php endforeach ?>
        <th>Acción</th>
    </tr>
        </thead>
        <tbody>
            @foreach ($<?=$modelNamePluralLower?> as $element)
            <tr>
        <?php 
            foreach ($modelAtrrs as $key => $value) :
        ?>
        <td>{{ $element-><?=$key?> }}</td>
        <?php endforeach ?>
        <td>
                    <a href="{{ route('<?=$modelNamePluralLower?>.show', $element->id) }}" class="btn btn-info">{{ __('Ver') }}</a>
                    <a href="{{ route('<?=$modelNamePluralLower?>.edit', $element->id) }}" class="btn btn-warning">{{ __('Editar') }}</a>
                    <form action="{{ route('<?=$modelNamePluralLower?>.destroy', $element->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Eliminar') }}</button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
