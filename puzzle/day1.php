<?php

class day1 extends DayInALife
{
    public function getResultPartOne()
    {
        foreach ($this->lines as $i) {
            foreach ($this->lines as $j) {
                if (($i + $j) === 2020) {
                    return $i * $j;
                }
            }
        }
    }

    public function getResultPartTwo()
    {
        foreach ($this->lines as $i) {
            foreach ($this->lines as $j) {
                foreach ($this->lines as $k) {
                    if (($i + $j + $k) === 2020) {
                        return $i * $j * $k;
                    }
                }
            }
        }
    }
}
