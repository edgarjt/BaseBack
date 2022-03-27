<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class LibraryCommand extends GeneratorCommand
{
    /**
     * @var string[]
     */
    protected $commands = [
        LibraryCommand::class
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:library {name : The name library}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new class library';

    /**
     * @return string
     */
    protected function getStub()
    {
        return app_path() . '/Console/Commands/Stubs/make-library.stub';
    }

    /**
     * @param $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Libraries';
    }

    /**
     * @param $stub
     * @param $name
     * @return array|string|string[]
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        return str_replace('DummyLibrary', $this->argument('name'), $stub);
    }
}
