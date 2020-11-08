<?php

declare(strict_types=1);

namespace Spatie\Typed\Tests;

use Spatie\Typed\Tests\Extra\Bar;
use Spatie\Typed\Tests\Extra\Foo;
use Spatie\Typed\Tests\Extra\Line;
use Spatie\Typed\Tests\Extra\FooBar;
use Spatie\Typed\Tests\Extra\LineCollection;
use PHPUnit\Framework\TestCase;

/**
 * This test case is used to test IDE auto completion, it doesn't actually assert anything useful.
 */
class IdeTest extends TestCase
{
    /** @test */
    public function tuple_auto_completion()
    {
        $fooBar = new FooBar(new Foo(), new Bar());

        $fooBar[0]->foo();

        $this->addToAssertionCount(1);
    }

    /** @test */
    public function struct_auto_completion()
    {
        $line = new Line(1, 1, 2, 2);

        $line->a->getX();

        $this->addToAssertionCount(1);
    }

    /** @test */
    public function collection_auto_completion()
    {
        $list = new LineCollection([new Line(1, 1, 2, 2)]);

        foreach ($list as $line) {
            $line->a->getX();

            $line->a[0];
        }

        $this->addToAssertionCount(1);
    }
}
