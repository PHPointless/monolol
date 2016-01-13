<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Hash implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }

    public function lolify(array $record)
    {
        $record['message'] = $this->hash($record['message']);

        return $record;
    }

    private function hash($string)
    {
        $algorithm = $this->getRandomAlgorithm();

        return hash($algorithm, $string);
    }

    private function getRandomAlgorithm()
    {
        $algorithms = hash_algos();

        return $algorithms[array_rand($algorithms)];
    }
}

