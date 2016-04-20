<?php

namespace aaemnnosttv\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class WordPressTestsCorePlugin implements PluginInterface
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
            ->addInstaller(new WordPressTestsCoreInstaller($io, $composer));
    }
}
