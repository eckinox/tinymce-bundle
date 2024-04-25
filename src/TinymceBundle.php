<?php

namespace Eckinox\TinymceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class TinymceBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}
