<?php

namespace App\Exceptions\Owner;

use Exception;

class BaseRequestException extends Exception
{
    private array $extras;

    public function __construct(string $message = "", int $code = 0, array $extras = [])
    {
        parent::__construct($message, $code, null);

        $this->setExtras($extras);
    }

    /**
     * @param array $extras
     * @return void
     */
    public function setExtras(array $extras): void
    {
        $this->extras = $extras;
    }

    /**
     * @return array
     */
    public function getExtras(): array
    {
        return $this->extras;
    }
}
