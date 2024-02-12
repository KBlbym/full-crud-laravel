<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeViewCrudCommand extends Command
{
    protected $signature = 'make:view-crud {model}';
    protected $description = 'Generate CRUD views for a given model.';
    
    public function handle()
    {
        //make the frist letter on upercase
        $modelName = ucfirst($this->argument('model'));
        $modelFolder = "App\\Models\\{$modelName}";

        // check if the model exists
        if (!class_exists($modelFolder)) {
            $this->error("Model {$modelName} does not exist.");
            return;
        }
        //here you can specify all the views you need.
        $views = ['index', 'create', 'show', 'edit'];

        foreach ($views as $view) {
            $this->createView($view, $modelName);
        }
    }

    /**
     * Creating the views with html struct a all model data
     * @param string $modelName
     * @param string $view
     */
    private function createView($view, $modelName)
    {
        $modelNamePluralLower =strtolower(Str::plural($modelName));
        $path = $this->viewPath($modelNamePluralLower.'/'.$view);
        $this->createDir($path);
        if (File::exists($path))
        {
            $this->error("File {$path} already exists!");
            return;
        }
        

        //Initiates an output buffer for the script's output
        ob_start();

        include resource_path("templates/{$view}.template.php");
        //get the current content of the output buffer and then clears it
        $viewContent = ob_get_clean();

        //Create the view whith the content of the template
        File::put($path, $viewContent);

        $this->info("the view  {$view} created successfully.");

    }
    /**
     * get a view path
     * @param string $view 
     * @return string return view path 
     */
    public function viewPath($view)
    {
        $view = str_replace('.', '/', $view) . '.blade.php';
        $path = "resources/views/{$view}";
        return $path;
    }
    /**
   * Create a view directory if it does not exist.
   * @param $path
   */
    public function createDir($path)
    {
        $dir = dirname($path);
        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }
}
