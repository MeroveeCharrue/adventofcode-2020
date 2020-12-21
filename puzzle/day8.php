<?php

class day8 extends DayInALife
{
    /**
     * @var int
     */
    private $accumulator;

    /**
     * @var int
     */
    private $head;

    /**
     * @var int[]
     */
    private $placeVisited;

    public function getResultPartOne()
    {
        $this->accumulator = 0;
        $this->head = 0;
        $this->placeVisited = [];

        $this->processOperation();

        return $this->accumulator;
    }

    public function getResultPartTwo()
    {
        // TODO: Implement getResultPartTwo() method.
    }

    private function processOperation(): bool
    {
        $this->markThisOperationLineAsVisited();

        $operation = $this->getCurrentOperation();

        switch ($operation->operand) {
            case 'acc':
                $this->acc($operation->value);
                break;
            case 'jmp':
                $this->jmp($operation->value);
                break;
            case 'nop':
                $this->nop();
                break;
        }

        if ($this->isEnteringInfiniteLoop()) {
            return false;
        }

        if (!$this->hasReachedEndOfFile()) {
            $this->processOperation();
        }

        return true;
    }

    private function getCurrentOperation(): stdClass
    {
        $operationLine = $this->lines[$this->head];
        $operation = explode(' ', $operationLine);

        return (object) [
            'operand' => $operation[0],
            'value' => $operation[1]
        ];
    }

    private function markThisOperationLineAsVisited(): void
    {
        $this->placeVisited[] = $this->head;
    }

    private function isEnteringInfiniteLoop(): bool
    {
        return in_array($this->head, $this->placeVisited);
    }

    private function hasReachedEndOfFile(): bool
    {
        return $this->head >= count($this->lines);
    }

    private function acc($value): void
    {
        $this->accumulator += $value;
        $this->head++;
    }

    private function jmp($value): void
    {
        $this->head += $value;
    }

    private function nop(): void
    {
        $this->head++;
    }
}
