<?php

namespace DrudgeRajen\VoyagerDeploymentOrchestrator\ContentManager;

use Illuminate\Filesystem\Filesystem as LaravelFileSystem;
use Illuminate\Support\Composer;

class FileSystem
{
    /** @var LaravelFileSystem */
    private $filesystem;

    /** @var Composer */
    private $composer;

    /**
     * Create the event listener.
     */
    public function __construct(LaravelFileSystem $filesystem, Composer $composer)
    {
        $this->filesystem = $filesystem;
        $this->composer = $composer;
    }

    /**
     * Get seeder file.
     */
    public function getSeederFile(string $name, string $path): string
    {
        return $path.'/'.$name.'.php';
    }

    /**
     * Get Seed Folder Path.
     */
    public function getSeedFolderPath(): string
    {
        return base_path().'/database/seeders/breads';
    }

    /**
     * Get Stub Path.
     */
    public function getStubPath(): string
    {
        return __DIR__.DIRECTORY_SEPARATOR;
    }

    /**
     * Delete Seed File.
     */
    public function deleteSeedFiles(string $fileName): bool
    {
        $seederFile = $this->getSeederFile($fileName, $this->getSeedFolderPath());

        if ($this->filesystem->exists($seederFile)) {
            return $this->filesystem->delete($seederFile);
        }

        return false;
    }

    /**
     * Generate Seeder Class Name.
     */
    public function generateSeederClassName(string $modelSlug, string $suffix): string
    {
        $modelString = '';

        $modelName = explode('-', $modelSlug);
        foreach ($modelName as $modelNameExploded) {
            $modelString .= ucfirst($modelNameExploded);
        }

        return ucfirst($modelString).$suffix;
    }

    /**
     * Add Content to Seeder file.
     */
    public function addContentToSeederFile(string $seederFile, string $seederContents): bool
    {
        if (!$this->filesystem->put($seederFile, $seederContents)) {
            return false;
        }

        $this->composer->dumpAutoloads();

        return true;
    }

    /**
     * Get File Content.
     *
     * @param $file
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getFileContent($file): string
    {
        return $this->filesystem->get($file);
    }
}
