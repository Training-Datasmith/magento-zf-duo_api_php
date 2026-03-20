<?php

declare (strict_types=1);
namespace Duo_Api;

interface Requester
{
    public function options($options);
    public function execute($url, $methods, $headers, $body);
}