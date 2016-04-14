<?php

namespace aaemnnosttv\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class WordPressTestsPlugin implements PluginInterface
{

    /**
     * Apply plugin modifications to composer
     *
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()
            ->addInstaller(new WordPressTestsInstaller($io, $composer));
    }
}
