<?php

namespace Ycs77\LaravelCrudPage\Console;

use Illuminate\Console\GeneratorCommand;

class CrudControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:crud:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new CRUD controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'CRUDController';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }
}
