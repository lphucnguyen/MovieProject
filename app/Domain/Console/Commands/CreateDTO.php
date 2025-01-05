<?php

namespace App\Domain\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateDTO extends Command
{
    protected $signature = 'create:dto {dtoName}';

    protected $description = 'Create DTO';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function getPath()
    {
        return explode('/', $this->argument('dtoName'));
    }

    public function getDTOName()
    {
        $path = $this->getPath();
        return end($path);
    }

    public function getDirectory()
    {
        $path = $this->getPath();
        return implode('/', array_slice($path, 0, -1));
    }

    public function getNamespace()
    {
        $path = $this->getPath();
        return implode('\\', array_slice($path, 0, -1));
    }

    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }

        return $contents;
    }

    public function getDTOSourceFile()
    {
        return $this->getStubContents($this->getDTOStubPath(), $this->getDTOStubVariables());
    }

    public function getDTOStubPath()
    {
        return __DIR__ . '/../../../stubs/dto.stub';
    }

    public function getDTOStubVariables()
    {
        $namespace = $this->getNamespace();

        return [
            'NAMESPACE' => 'App\\DTOs' . ($namespace ? '\\' . $namespace : ''),
            'DTO_NAME' => $this->getDTOName()
        ];
    }

    public function createDTOFile()
    {
        $dtoName = $this->getDTOName();
        $directory = $this->getDirectory();

        $dtoDir = app_path() . "/DTOs/";

        if (!$this->files->isDirectory($dtoDir . $directory)) {
            $this->files->makeDirectory($dtoDir . $directory, 0777, true, true);
        }

        $file = $dtoDir . $directory . '/' . $dtoName . ".php";

        $fileContents = $this->getDTOSourceFile();

        if ($this->files->isFile($file)) {
            return $this->error($file  . ' File Already exists!');
        }

        if (!$this->files->put($file, $fileContents)) {
            return $this->error('Something went wrong!');
        }

        $this->info('Created new DTO ' . $this->argument('dtoName') . '.php in App\Application\DTOs.');
    }

    public function handle()
    {
        $this->createDTOFile();
    }
}
