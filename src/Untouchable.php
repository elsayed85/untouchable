<?php

namespace Elsayed85\Untouchable;

use function Pest\Laravel\get;

class Untouchable
{
    protected $source_code;
    protected $hash;
    protected $file;
    protected $directory;
    protected $secret;

    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function getSourceCode()
    {
        return file_get_contents($this->file);
    }

    public function getHash()
    {
        return hash_hmac('sha256', $this->getSourceCode(), $this->secret ??  config('untouchable.key'));
    }

    public function getAllPhpFiles($directory)
    {
        $files = [];
        foreach (scandir($directory) as $file) {
            if ('.' === $file || '..' === $file) {
                continue;
            } elseif (is_dir($directory . '/' . $file)) {
                $files = array_merge($files, $this->getAllPhpFiles($directory . '/' . $file));
            } elseif (preg_match('/\.php$/', $file)) {
                $files[] = $directory . '/' . $file;
            }
        }

        return $files;
    }

    public function verify($directory_hash)
    {
        $files = $this->getAllPhpFiles($this->directory);
        $results = [];
        foreach ($files as $file) {
            $this->setFile($file);
            $hash = $this->getHash();
            $results[$file] = $hash == $directory_hash[$file];
        }
    }
}
