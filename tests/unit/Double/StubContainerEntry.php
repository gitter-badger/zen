<?php
declare(strict_types=1);

namespace WoohooLabs\Zen\Tests\Unit\Double;

class StubContainerEntry
{
    /**
     * @var bool
     */
    private $a = false;

    public function getA(): bool
    {
        return $this->a;
    }
}
