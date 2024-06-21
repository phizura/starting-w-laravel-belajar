<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create Interface, Repository, and add Binding to ServiceProvider (Awasefra)';

    public function handle()
    {
        $name = $this->argument('name');
        $pilihan = $this->choice(
            'Pilih jenis file:',
            ['empty', 'basic'],
            0
        );

        $interfacePath = 'app/Interfaces/' . $this->generateFileName($name, 'Interface') . '.php';
        $repositoryPath = 'app/Repositories/' . $this->generateFileName($name, 'Repository') . '.php';
        $serviceName = 'RepositoryServiceProvider';

        $this->createFile($interfacePath, 'Interface', 'Interfaces', $name, $pilihan);
        $this->createFile($repositoryPath, 'Repository', 'Repositories', $name, $pilihan);

        // $this->addBindingToServiceProvider($serviceName, $name);

        $this->info('Files created and Binding added successfully!');

        exec("start $repositoryPath");
    }

    private function generateFileName($name, $type)
    {
        return $name . $type;
    }

    private function createFile($path, $type, $folder, $name, $content)
    {
        $directory = dirname($path);

        // Check if the directory exists, create it if not
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true, true);
            $this->info("Directory created: {$directory}");
        }

        if (File::exists($path)) {
            $this->error("File {$type} already exists!");
        } else {
            if ($content == 'empty')
                File::put($path, $this->generateFileContent($type, $folder, $name));
            elseif ($content == 'basic') {
                File::put($path, $this->generateFileContentBasic($type, $folder, $name));
            }
            $this->info("{$type} file created: {$path}");
        }
    }

    private function addBindingToServiceProvider($serviceName, $name)
    {
        $path = "app/Providers/{$serviceName}.php";
        $binding = $this->generateBindingStatement($name);

        if (File::exists($path)) {
            $content = File::get($path);

            if (strpos($content, $binding) === false) {
                $content = str_replace('// bindings-placeholder', $binding . PHP_EOL . '        // bindings-placeholder', $content);
                File::put($path, $content);
                $this->info("Binding added to existing ServiceProvider: {$path}");
            } else {
                $this->info("Binding already exists in ServiceProvider: {$path}");
            }
        } else {
            File::put($path, $this->generateServiceProviderContent($serviceName, $binding));
            $this->info("ServiceProvider created with Binding: {$path}");
        }
    }

    private function generateFileContent($type, $folder, $name)
    {
        $content = "<?php\n\n";

        $name = str_replace('/', '\\', $name);

        // mengambil nama sebelum /
        $lastBackslashPos = strrpos($name, '\\');
        $namespace = '';
        $className = $name;

        if ($lastBackslashPos !== false) {
            $namespace = substr($name, 0, $lastBackslashPos);
            $className = substr($name, $lastBackslashPos + 1);
        }

        // menambahkan / sebelu, namespace
        $namespace = ($namespace !== '') ? '\\' . $namespace : '';

        $content .= "namespace App\\{$folder}{$namespace};\n\n";

        if ($type === 'Repository') {
            $interfaceName = "Interface";
            $content .= "use App\\Interfaces{$namespace}\\{$className}{$interfaceName};\n\n";
            $content .= "class {$className}{$type} implements {$className}{$interfaceName}\n";
            $content .= "{\n";
            $content .= "    // Implement your repository logic here\n";
            $content .= "}\n";
        } else {
            $content .= "interface {$className}{$type}\n";
            $content .= "{\n";
            $content .= "}\n";
        }

        return $content;
    }

    private function generateFileContentBasic($type, $folder, $name)
    {
        $content = "<?php\n\n";

        $name = str_replace('/', '\\', $name);

        // mengambil nama sebelum /
        $lastBackslashPos = strrpos($name, '\\');
        $namespace = '';
        $className = $name;

        if ($lastBackslashPos !== false) {
            $namespace = substr($name, 0, $lastBackslashPos);
            $className = substr($name, $lastBackslashPos + 1);
        }

        $id = '$id';
        eval("\$id = $id;");

        $request = '$request';
        eval("\$request = $request;");

        // menambahkan / sebelu, namespace
        $namespace = ($namespace !== '') ? '\\' . $namespace : '';

        $content .= "namespace App\\{$folder}{$namespace};\n\n";

        if ($type === 'Repository') {
            $interfaceName = "Interface";
            $content .= "use App\\Interfaces{$namespace}\\{$className}{$interfaceName};\n\n";
            $content .= "class {$className}{$type} implements {$className}{$interfaceName}\n";
            $content .= "{\n\n";
            $content .= "    function get()\n";
            $content .= "{\n";
            $content .= "\n";
            $content .= "}\n";
            $content .= "\n";
            $content .= "    function show($id)\n";
            $content .= "{\n";
            $content .= "\n";
            $content .= "}\n";
            $content .= "\n";
            $content .= "    function update($request, $id)\n";
            $content .= "{\n";
            $content .= "\n";
            $content .= "}\n";
            $content .= "\n";
            $content .= "    function delete($id)\n";
            $content .= "{\n";
            $content .= "\n";
            $content .= "}\n";
            $content .= "\n";
            $content .= "}\n";
        } else {
            $content .= "interface {$className}{$type}\n";
            $content .= "{\n\n";
            $content .= "    function get();\n";
            $content .= "    function show($id);\n";
            $content .= "    function update($request, $id);\n";
            $content .= "    function delete($id);\n";
            $content .= "}\n";
        }

        return $content;
    }

    private function generateServiceProviderContent($name, $binding)
    {
        $content = "<?php\n\n";
        $content .= "namespace App\\Providers;\n\n";
        $content .= "use Illuminate\Support\ServiceProvider;\n\n";
        $content .= "class {$name} extends ServiceProvider\n{\n";
        $content .= "    public function register()\n    {\n";
        $content .= "        // bindings-placeholder\n";
        $content .= $binding;
        $content .= "    }\n";
        $content .= "}\n";

        return $content;
    }

    private function generateBindingStatement($name)
    {
        $interface = str_replace('/', '\\', "App\Interfaces\\{$name}Interface");
        $repository = str_replace('/', '\\', "App\Repositories\\{$name}Repository");

        return "        \$this->app->bind('{$interface}', '{$repository}');";
    }
}
