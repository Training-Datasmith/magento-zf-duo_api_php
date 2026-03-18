<?php

declare(strict_types=1);

namespace DuoAPI;

class USleepService implements SleepService
{
    public function sleep($seconds): void
    {
        usleep($seconds * 1000000);
    }
}
