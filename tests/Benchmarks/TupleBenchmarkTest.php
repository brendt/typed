<?php

namespace Spatie\Typed\Tests\Benchmarks;

use Spatie\Typed\T;
use Spatie\Typed\Tuple;

class TupleBenchmarkTest extends BenchmarkTest
{
    /** @test */
    public function array_write()
    {
        $this->startTimer();

        foreach ($this->range() as $item) {
            $tuple = [1, 'a'];
        }

        $this->output('array write', $this->stopTimer());
    }

    /** @test */
    public function tuple_write()
    {
        $this->startTimer();

        $tuple = new Tuple(T::int(), T::string());
        foreach ($this->range() as $item) {
            $tuple[0] = 1;
            $tuple[1] = 'a';
        }

        $this->output('tuple write', $this->stopTimer());
    }

    /** @test */
    public function tuple_write_set()
    {
        $this->startTimer();

        $tuple = new Tuple(T::int(), T::string());
        foreach ($this->range() as $item) {
            $tuple->set(1, 'a');
        }

        $this->output('tuple write via set method', $this->stopTimer());
    }
}
