<?php

namespace App\Domain\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateCommand extends Command
{
    protected $signature = 'create:command {commandName} {--handler=true}';

    protected $description = 'Create Command and Command Handler';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function getPath()
    {
        return explode('/', $this->argument('commandName'));
    }

    public function getCommandName()
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

    public function getCommandStubPath()
    {
        return __DIR__ . '/../../../../stubs/command.stub';
    }

    public function getHandlerStubPath()
    {
        return __DIR__ . '/../../../../stubs/command.handler.stub';
    }

    public function getCommandStubVariables()
    {
        $namespace = $this->getNamespace();

        return [
            'NAMESPACE' => 'App\\Application\\Commands' . ($namespace ? '\\' . $namespace : ''),
            'COMMAND_NAME' => $this->getCommandName()
        ];
    }

    public function getHandlerStubVariables()
    {
        $namespace = $this->getNamespace();

        return [
            'NAMESPACE' => 'App\\Application\\CommandHandlers' . ($namespace ? '\\' . $namespace : ''),
            'COMMAND_NAME' => $this->getCommandName()
        ];
    }

    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }

        return $contents;
    }

    public function getCommandSourceFile()
    {
        return $this->getStubContents($this->getCommandStubPath(), $this->getCommandStubVariables());
    }

    public function getHandlerSourceFile()
    {
        return $this->getStubContents($this->getHandlerStubPath(), $this->getHandlerStubVariables());
    }

    public function createCommandFile()
    {
        $commandName = $this->getCommandName();
        $directory = $this->getDirectory();

        $commandDir = app_path() . "/Application/Commands/";

        if (!$this->files->isDirectory($commandDir . $directory)) {
            $this->files->makeDirectory($commandDir . $directory, 0777, true, true);
        }

        $file = $commandDir . $directory . '/' . $commandName . "Command.php";

        $fileContents = $this->getCommandSourceFile();

        if ($this->files->isFile($file)) {
            return $this->error($file  . ' File Already exists!');
        }

        if (!$this->files->put($file, $fileContents)) {
            return $this->error('Something went wrong!');
        }

        $this->info('Created new Command ' . $this->argument('commandName') . 'Command.php in App\Application\Commands.');
    }

    public function createHandlerFile()
    {
        if ($this->option('handler') === 'false') {
            return;
        }

        $commandName = $this->getCommandName();
        $directory = $this->getDirectory();

        $commandHandlerDir = app_path() . "/Application/CommandHandlers/";

        if (!$this->files->isDirectory($commandHandlerDir . $directory)) {
            $this->files->makeDirectory($commandHandlerDir . $directory, 0777, true, true);
        }

        $file = $commandHandlerDir . $directory . '/' . $commandName . "Handler.php";

        $fileContents = $this->getHandlerSourceFile();

        if ($this->files->isFile($file)) {
            return $this->error($file  . ' File Already exists!');
        }

        if (!$this->files->put($file, $fileContents)) {
            return $this->error('Something went wrong!');
        }

        $this->info(
            'Created new Command Handler ' . $this->argument('commandName') . 'Handler.php in App\Application\CommandHandlers.'
        );
    }

    public function handle()
    {
        $this->createCommandFile();
        $this->createHandlerFile();
    }
}
