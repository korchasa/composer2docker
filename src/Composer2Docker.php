<?php

namespace Composer2Docker;

use Twig_Environment;
use Twig_Loader_Array;

class Composer2Docker
{
    protected $alpinePackages = [];
    protected $package;
    protected $binName;
    protected $buildInPackages = ['php7-mbstring', 'php7-json', 'php7-ctype', 'php7-xml', 'php7-iconv'];

    public function composerLock($composerLockPath, $composerJsonPath)
    {
        $mainPackage = json_decode(file_get_contents($composerJsonPath), true);

        $this->alpinePackages = $this->extractAlpinePackages(array_merge(
            json_decode(file_get_contents($composerLockPath), true)['packages'],
            [$mainPackage]
        ));
        $this->package = $mainPackage['name'];

        $this->binName = $mainPackage['bin'][0];

        return $this;
    }

    public function dockerfile()
    {
        $twig = new Twig_Environment(new Twig_Loader_Array([
            'default' => file_get_contents(__DIR__.'/Dockerfile.twig')
        ]));
        return $twig->render('default', [
            'composerPackage' => $this->package,
            'alpinePackages' => $this->alpinePackages,
            'binName' => $this->binName
        ]);
    }

    protected function extensionToPackage($extension)
    {
        switch ($extension) {
            case 'pcre':
                return null;
            default:
                return 'php7-'.$extension;
        }
    }

    /**
     * @param array $phpPackages
     * @return string[]
     */
    protected function extractAlpinePackages($phpPackages): array
    {
        $expectedExceptions = [];
        foreach ($phpPackages as $phpPackage) {
            foreach ($phpPackage['require'] ?? [] as $dependencyName => $dependencyVersion) {
                if (0 === strpos($dependencyName, 'ext-')) {
                    $expectedExceptions[] = substr($dependencyName, 4);
                }
            }
        }
        $expectedExceptions = array_values($expectedExceptions);

        return array_values(array_unique(array_merge(
            $this->buildInPackages,
            array_map([$this, 'extensionToPackage'], $expectedExceptions)
        )));
    }
}
