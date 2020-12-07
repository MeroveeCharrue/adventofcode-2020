<?php

class day5 extends DayInALife
{
    private const FRONT_ROW = 127;
    private const FRONT_COLUMN = 7;

    public function getResultPartOne()
    {
        $highestId = 0;

        foreach ($this->lines as $boardingPass) {
            $row = $this->processRow($boardingPass);
            $column = $this->processColumn($boardingPass);
            $id = $this->getSeatId($row, $column);

            if ($id > $highestId) {
                $highestId = $id;
            }
        }

        return $highestId;
    }

    public function getResultPartTwo()
    {
        $allIds = [];

        foreach ($this->lines as $boardingPass) {
            $row = $this->processRow($boardingPass);
            $column = $this->processColumn($boardingPass);

            $allIds[] = $this->getSeatId($row, $column);
        }

        $highestId = $this->getResultPartOne();
        for ($i = 0; $i < $highestId; $i++) {
            if (in_array($i-1, $allIds) &&
                in_array($i+1, $allIds) &&
                !in_array($i, $allIds)
            ) {
                $mySeatId = $i;
                break;
            }
        }

        return $mySeatId;
    }

    private function processRow(string $boardingPass): int
    {
        $boundaries = new stdClass();
        $boundaries->back = 0;
        $boundaries->front = self::FRONT_ROW;

        for ($i = 0; $i < 7; $i++) {
            $keepUpperHalf = ($boardingPass[$i] === 'B');

            $boundaries = $this->splitSpaceInHalf($boundaries, $keepUpperHalf);
        }

        return $this->getSeatResult($boundaries);
    }

    private function processColumn(string $boardingPass): int
    {
        $boundaries = new stdClass();
        $boundaries->back = 0;
        $boundaries->front = self::FRONT_COLUMN;

        for ($i = 7; $i < 10; $i++) {
            $keepUpperHalf = ($boardingPass[$i] === 'R');

            $boundaries = $this->splitSpaceInHalf($boundaries, $keepUpperHalf);
        }

        return $this->getSeatResult($boundaries);
    }

    private function splitSpaceInHalf(stdClass $boundaries, bool $keepUpperHalf): stdClass
    {
        $step = (($boundaries->front - $boundaries->back) + 1) / 2;

        if ($keepUpperHalf) {
            $boundaries->back += $step;
        } else {
            $boundaries->front -= $step;
        }

        return $boundaries;
    }

    private function getSeatResult(stdClass $boundaries): int
    {
        if ($boundaries->front !== $boundaries->back) {
            throw new LogicException();
        }

        return $boundaries->back;
    }

    private function getSeatId($row, $column): int
    {
        return $row * 8 + $column;
    }
}

/*
                                     b = 0  f = 7

        (f - b) + 1 = 8     8/2 = 4

                           f -= 4         OR        b += 4
                           b = 0   f = 3  OR  b = 4  f = 7

        (f - b) + 1 = 4     4/2 = 2

               f -= 2   OR  b += 2        OR        f -= 2  OR  b += 2
        b = 0   f = 1   OR  b = 2  f = 3  OR  b = 4  f = 5  OR  b = 6  f = 7


             0         7            [0-7]
           0     3-4     7          [0-3][4-7]
         0  1-2  3-4  5-6  7        [0-1][2-3][4-5][6-7]
        0 1 2 3 4 5 6 7             [0-0][1-1][2-2][3-3][4-4][5-5][6-6][7-7]

*/
