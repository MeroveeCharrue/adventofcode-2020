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

    private function processOperation()
    {
        $this->placeVisited[] = $this->head;
        $operationLine = $this->lines[$this->head];

        $operation = explode(' ', $operationLine);
        switch ($operation[0]) {
            case 'acc':
                $this->acc($operation[1]);
                break;
            case 'jmp':
                $this->jmp($operation[1]);
                break;
            case 'nop':
                $this->nop();
                break;
        }

        if (in_array($this->head, $this->placeVisited)) {
            return;
        }

        if ($this->head < count($this->lines)) {
            $this->processOperation();
        }
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
