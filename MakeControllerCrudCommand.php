<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeControllerCrudCommand extends Command
{
    protected $signature = 'make:controller-crud {model} {--views} ';
    protected $description = 'Generate a controller with CRUD methods for a given model.';
    public function handle()
    {
        //Getting the name of the model
        $model = $this->argument('model');
        //Getting the name of the controller
        $controllerName = "{$model}Controller";
        //inicializing the model route
        $modelName = "App\\Models\\{$model}";

       
        
        //check if the model exists
        if (!class_exists($modelName)) {
            $this->error("Model {$model} does not exist.");
            return;
        }

        //make the model to lower case.
        $modelSingularLower = strtolower($model);
        //make the model en plural to use it as collection.
        $modelPluralLower = Str::plural($modelSingularLower);

        // Creating the controller 
        $controllerContent = "<?php\n\n";
        $controllerContent .= "namespace App\\Http\\Controllers;\n\n";
        $controllerContent .= "use App\\Models\\{$model};\n";
        $controllerContent .= "use Illuminate\\Http\\Request;\n\n";
        $controllerContent .= "class {$controllerName} extends Controller\n";
        $controllerContent .= "{\n";
            //index method
        $controllerContent .= "    public function index()\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \${$modelPluralLower} = {$model}::all();\n";
        $controllerContent .= "        return view('$modelPluralLower.index', compact('$modelPluralLower'));\n";
        $controllerContent .= "    }\n\n";

        //store method
        $controllerContent .= "    public function store(Request \$request)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        $model::create(\$request->all());\n";
        $controllerContent .= "        return redirect()->route('$modelPluralLower.index')\n";
        $controllerContent .= "        ->with('success', '$model created successfully.');\n";
        $controllerContent .= "    }\n\n";
                                    
        //show method
        $controllerContent .= "    public function show(\$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \${$modelSingularLower} = {$model}::find(\$id);\n";
        $controllerContent .= "        return view('$modelPluralLower.show', compact('$modelSingularLower'));\n";
        $controllerContent .= "    }\n\n";

        //update method
        $controllerContent .= "    public function update(Request \$request, \$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \${$modelSingularLower} = $model::find(\$id);\n";
        $controllerContent .= "        \${$modelSingularLower}->update(\$request->all());\n";
        $controllerContent .= "        return redirect()->route('$modelPluralLower.index')\n";
        $controllerContent .= "        ->with('success', '$model updated successfully.');\n";
        $controllerContent .= "    }\n\n";

        //create method
        $controllerContent .= "    public function create()\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "         return view('$modelPluralLower.create');\n";
        $controllerContent .= "    }\n";

        //edit method
        $controllerContent .= "    public function edit(\$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \${$modelSingularLower} = $model::find(\$id);\n";
        $controllerContent .= "         return view('$modelPluralLower.edit', compact('$modelSingularLower'));\n";
        $controllerContent .= "    }\n";

        //destroy method
        $controllerContent .= "    public function destroy(\$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \${$modelSingularLower} = $model::find(\$id);\n";
        $controllerContent .= "        \${$modelSingularLower}->delete();\n";
        $controllerContent .= "         return redirect()->route('$modelPluralLower.index')\n";
        $controllerContent .= "        ->with('success', '$model deleted successfully.');\n";
        $controllerContent .= "    }\n";
        $controllerContent .= "}\n";

        //Get the controller path
        $path = app_path("Http/Controllers/{$controllerName}.php");

        //Check if the controller exists
        if (File::exists($path)) {
            $this->error("Controller {$controllerName} already exists!");
            return;
        }

        //Creating the controller and put CRUD methods en controller.
        File::put($path, $controllerContent);

        //Show message success
        $this->info("Controller {$controllerName} created successfully.");

        //CREATE a views if option view is isset
        if ($this->option('views')) {
            $this->createView($model);
        }
    }
    //method to crear views
    private function createView($modelName)
    {
        $this->call('make:view-crud', [
            'model' => $modelName
        ]);
    }
}
