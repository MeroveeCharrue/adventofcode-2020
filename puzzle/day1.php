<?php

class day1 extends DayInALife
{
    public function getResultPartOne()
    {
        foreach ($this->fileAsArray as $i) {
            foreach ($this->fileAsArray as $j) {
                if (($i + $j) === 2020) {
                    return $i * $j;
                }
            }
        }
    }

    public function getResultPartTwo()
    {
        foreach ($this->fileAsArray as $i) {
            foreach ($this->fileAsArray as $j) {
                foreach ($this->fileAsArray as $k) {
                    if (($i + $j + $k) === 2020) {
                        return $i * $j * $k;
                    }
                }
            }
        }
    }
}
