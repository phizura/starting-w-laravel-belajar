<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tools membuat service (Awasefra)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $content = $this->choice(
            'Pilih jenis file:',
            ['empty', 'basic'],
            0
        );

        $servicePath = 'app/Services/' . $this->generateFileName($name, 'Service') . '.php';

        $this->createFile($servicePath, 'Service', 'Services', $name, $content);

        $this->info('Files created successfully!');

        exec("start $servicePath");
    }

    private function generateFileName($name, $type)
    {
        return $name . $type;
    }

    private function createFile($path, $type, $folder, $name, $content)
    {
        $directory = dirname($path);

        // directory sudah ada atauka belum
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

        $content .= "class {$className}{$type}";
        $content .= "\n{\n";
        $content .= "    // Implement your code logic here\n";
        $content .= "}\n";

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

        $content .= "class {$className}{$type}";
        $content .= "\n{\n\n";
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

        return $content;
    }
}
