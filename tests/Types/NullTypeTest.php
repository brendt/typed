<?php

declare(strict_types=1);

namespace Spatie\Typed\Tests\Types;

use Spatie\Typed\Type;
use PHPUnit\Framework\TestCase;
use Spatie\Typed\Types\NullType;

final class NullTypeTest extends TestCase
{
    /** @test */
    public function constructor_sets_type(): void
    {
        $type = $this->prophesize(Type::class);

        $nullableType = new NullType($type->reveal());

        $this->assertSame($type->reveal(), $nullableType->getType());
        $this->assertInstanceOf(NullType::class, $nullableType->nullable());
    }
}
