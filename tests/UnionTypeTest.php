<?php

declare(strict_types=1);

namespace Spatie\Typed\Tests;

use TypeError;
use Spatie\Typed\T;
use Spatie\Typed\Collection;
use Spatie\Typed\Tests\Extra\Post;
use Spatie\Typed\Tests\Extra\Wrong;

class UnionTypeTest extends TestCase
{
    /** @test */
    public function types_can_be_combined()
    {
        $list = new Collection(T::union(T::int(), T::float()));

        $list[] = 1;
        $list[] = 1.1;

        $this->assertSame(1, $list[0]);
        $this->assertSame(1.1, $list[1]);
    }

    /** @test */
    public function union_with_generics()
    {
        $list = new Collection(T::union(T::generic(Post::class)));

        $list[] = new Post();

        $this->expectException(TypeError::class);

        $list[] = new Wrong();
    }

    /** @test */
    public function nullable_union()
    {
        $list = new Collection(T::union(T::int(), T::float())->nullable());

        $list[] = 1;

        $list[] = null;

        $list[] = 1.1;

        $this->expectException(TypeError::class);

        $list[] = new Wrong();
    }

    /** @test */
    public function nullable_child_union()
    {
        $list = new Collection(T::union(T::int()->nullable(), T::float()));

        $list[] = 1;

        $list[] = null;

        $list[] = 1.1;

        $this->expectException(TypeError::class);

        $list[] = new Wrong();
    }

    /** @test */
    public function wrong_types_throws_an_error()
    {
        $list = new Collection(T::union(T::int(), T::float(), T::generic(Post::class)));

        try {
            $list[] = 'abc';
        } catch (TypeError $typeError) {
            $message = $typeError->getMessage();

            $this->assertStringContainsString('integer', $message);
            $this->assertStringContainsString('float', $message);
            $this->assertStringContainsString('generic<Spatie\Typed\Tests\Extra\Post>', $message);
        }
    }
}
