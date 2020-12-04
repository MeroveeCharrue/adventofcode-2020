<?php

abstract class DayInALife
{
    protected $fileContent;

    protected $fileAsArray;

    protected $arrayLength;

    public function __construct(string $filename) {
        $this->fileContent = file_get_contents('puzzle/input/'.$filename);

        $this->fileAsArray = explode(PHP_EOL, $this->fileContent);
        // remove last empty newline.
        array_pop($this->fileAsArray);

        $this->arrayLength = count($this->fileAsArray);
    }

    abstract public function getResultPartOne();

    abstract public function getResultPartTwo();
}
