<?php
return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(
        [
            'ordered_imports' => true,
            'phpdoc_order' => true,
            'array_syntax' => ['syntax' => 'short'],
        ]
    )
    ->setCacheFile(__DIR__.'/.php_cs.cache')
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__.'/src')
    );
