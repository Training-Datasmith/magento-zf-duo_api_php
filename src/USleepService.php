<?php

declare (strict_types=1);
namespace Duo_Api;

class U_Sleep_Service implements Sleep_Service
{
    public function sleep($seconds): void
    {
        usleep($seconds * 1000000);
    }
}