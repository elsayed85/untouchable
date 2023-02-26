<?php

namespace Elsayed85\Untouchable;

class Untouchable
{
    protected $file;
    protected $code;
    protected $hash;

    protected function setCode($code)
    {
        $this->code = $code;
        $this->hash = hash_hmac('sha256', $code, config('untouchable.key'));
    }

    public function setFile($file)
    {
        $this->file = $file;
        $this->setCode(file_get_contents($this->file));
        return $this;
    }

    public function fileIsNotModified($expected_hash)
    {
        return hash_equals($this->hash, $expected_hash);
    }

    public function setDir($dir)
    {
        $files = glob($dir . '/*');
        $results = [];
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->setDir($file);
            } else {
                $this->setFile($file);
                $results[$file] = $this->hash;
            }
        }
        return $results;
    }

    public function dirFilesIsNotModified($expected_results)
    {
        $results = [];
        foreach ($expected_results as $file => $hash) {
            $this->setFile($file);
            $results[$file] = $this->fileIsNotModified($hash);
        }
        return $results;
    }
}
