<?php 

use Illuminate\Validation;
use Illuminate\Translation;
use Illuminate\Filesystem\Filesystem;

class Validator
{
    private $factory;
    
    public function __construct()
    {
        $this->factory = new Validation\Factory(
            $this->loadTranslator()
        );
    }
    protected function loadTranslator()
    {
        $filesystem = new Filesystem();
        $loader = new Translation\FileLoader($filesystem, dirname(dirname(__FILE__)) . '/lang');
            $loader->addNamespace(
                'lang',
                dirname(dirname(__FILE__)) . '/lang'
            );
        $loader->load('id', 'validation', 'lang');
        return new Translation\Translator($loader, 'id');
    }
    public function __call($method, $args)
    {
        return call_user_func_array(
            [$this->factory, $method],
            $args
        );
    }
}