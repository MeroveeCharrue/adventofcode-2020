<?php

class day3 extends DayInALife
{
    private const TREE = '#';

    private $lineLength;

    public function getResultPartOne()
    {
        return $this->tryThisSlope(3);
    }

    public function getResultPartTwo()
    {
        $totalTrees = $this->tryThisSlope(1);
        $totalTrees *= $this->tryThisSlope(3);
        $totalTrees *= $this->tryThisSlope(5);
        $totalTrees *= $this->tryThisSlope(7);
        $totalTrees *= $this->tryThisSlope(1, 2);

        return $totalTrees;
    }

    private function tryThisSlope(int $stepRight, int $stepDown = 1): int
    {
        $treeCount = 0;

        $this->lineLength = strlen($this->lines[0]);

        $x = 0;
        foreach ($this->lines as $row => $line) {
            if ($row % $stepDown === 0) {
                if ($this->isItTree($line[$x])) {
                    $treeCount++;
                }
                $x = $this->progressOneStep($x, $stepRight);
            }
        }

        return $treeCount;
    }

    private function progressOneStep(int $currentX, int $stepSize): int
    {
        $newX = $currentX + $stepSize;
        if ($newX >= $this->lineLength) {
            $newX -= $this->lineLength;
        }

        return $newX;
    }

    private function isItTree(string $position): bool
    {
        return $position === self::TREE;
    }
}
