<?php

namespace aaemnnosttv\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class WordPressTestsCoreInstaller extends LibraryInstaller
{

    const TYPE = 'wordpress-tests-core';
    const EXTRA_KEY = 'wordpress-tests-core-dir';

    private static $installed = [];

    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        /**
         * Set install path from root
         */
        $path = $this->getRootInstallPath();

        /**
         * Set install path via package
         */
        if ( ! $path && $package->getExtra()) {
            $path = $this->getInstallPathFromExtra($package->getExtra());
        }

        $this->recordInstallPath($package, $path);

        return $path;
    }

    /**
     * [recordInstallPath description]
     *
     * @param  PackageInterface $package [description]
     * @param  [type]           $path    [description]
     *
     * @return [type]                    [description]
     */
    protected function recordInstallPath(PackageInterface $package, $path)
    {
        $this->guardAgainstPathConflicts($package, $path);

        self::$installed[ $path ] = $package;
    }

    /**
     * [guardAgainstPathConflicts description]
     *
     * @param  PackageInterface $package [description]
     * @param  [type]           $path    [description]
     *
     * @return [type]                    [description]
     */
    protected function guardAgainstPathConflicts(PackageInterface $package, $path)
    {
        if ($this->isPackageConflictForPath($package, $path)) {
            throw new \InvalidArgumentException('Two packages cannot share the same directory!');
        }
    }

    /**
     * [isPackageConflictForPath description]
     *
     * @param  PackageInterface $package [description]
     * @param  [type]           $path    [description]
     *
     * @return boolean                   [description]
     */
    protected function isPackageConflictForPath(PackageInterface $package, $path)
    {
        return $this->hasPackageForPath($path)
               && ($package->getPrettyName() != self::$installed[ $path ]->getPrettyName());
    }

    /**
     * [hasPackageForPath description]
     *
     * @param  [type]  $path [description]
     *
     * @return boolean       [description]
     */
    protected function hasPackageForPath($path)
    {
        return ! empty(self::$installed[ $path ]);
    }

    /**
     * [getRootInstallPath description]
     * @return [type] [description]
     */
    protected function getRootInstallPath()
    {
        if ( ! $this->composer->getPackage()) {
            return;
        }

        return $this->getInstallPathFromExtra($this->composer->getPackage()->getExtra());
    }

    /**
     * Get the install path from the "extra" config
     *
     * @param  [type] $extra [description]
     *
     * @return [type]        [description]
     */
    protected function getInstallPathFromExtra($extra)
    {
        return ! empty($extra[ self::EXTRA_KEY ])
            ? $extra[ self::EXTRA_KEY ]
            : null;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return self::TYPE === $packageType;
    }
}
