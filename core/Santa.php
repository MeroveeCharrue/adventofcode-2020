<?php

class Santa
{
    /**
     * @return DayInALife[]
     */
    public function getDays(): array
    {
        $files = glob('puzzle/*.php');

        $days = [];
        foreach ($files as $file) {
            $class = pathinfo($file, PATHINFO_FILENAME);
            $days[] = new $class($class);
        }

        return $days;
    }
}
