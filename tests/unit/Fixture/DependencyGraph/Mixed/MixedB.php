<?php
namespace WoohooLabs\Dicone\Tests\Unit\Fixture\DependencyGraph\Mixed;

class MixedB
{
    public function __construct(MixedD $d)
    {
    }
}