<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in('src')
    ->in('tests')
    ->notPath('_assets')
    ->filter(function (SplFileInfo $file) {
        if (strstr($file->getPath(), 'compatibility')) {
            return false;
        }
    });
$config = Symfony\CS\Config\Config::create();
$config->level(Symfony\CS\FixerInterface::PSR2_LEVEL);
$config->finder($finder);
return $config;
