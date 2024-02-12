<?php

use function Laravel\Prompts\error;

function getAttributeTypes($modelName)
{
    $modelo = "App\\Models\\{$modelName}";
    $modelClass = "{$modelo}";
    $model = new $modelClass;
    try {
        // Verificar si el método existe en el modelo
        if (!method_exists($model, 'getAttributeTypes')) {
            throw new \Exception('undefined function getModelAttributes() in your model '  .$modelo);
        }
        return $model->getAttributeTypes();
    } catch (\Throwable $th) {
        echo error("Error: " . $th->getMessage() . "\n");
        echo "Add this function to you class model with all attributes and types: \n " . getCodeHelper();
        exit();
    }
}

function getCodeHelper() {
    return 
"public function getAttributeTypes()
{
    return [
    'key' => 'type'
    ];
}";
}