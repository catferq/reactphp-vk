<?php

namespace ReactPHPVK\Throttling;

use Closure;
use React\EventLoop\LoopInterface;
use React\Promise\Promise;
use function React\Promise\Timer\resolve;

class QManager
{
    private LoopInterface $loop;
    private array $qHistoryStack = [];

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function limiter(Closure $closure, float $limitPerSecond, $tag): Promise
    {
        if($limitPerSecond == 0) return $closure();

        return resolve($this->getTimer($tag, 1 / $limitPerSecond), $this->loop)->then(
            fn () => $closure()
        );
    }

    private function getTimer(string $tag, float $limiter): float
    {
        $q = $this->getQHistoryStack($tag);
        $current = microtime(true);

        if (intval(end($q)) < time()) {
            $timer = $current;
        } else {
            $timer = end($q) + $limiter;
        }

        $this->pushQHistoryStack($tag, $timer);

        return $timer - $current;
    }


    private function getQHistoryStack(string $tag): array
    {
        return $this->qHistoryStack[$tag] ?? [];
    }


    private function pushQHistoryStack(string $tag, float $time): self
    {
        $this->qHistoryStack[$tag][] = $time;
        return $this;
    }
}