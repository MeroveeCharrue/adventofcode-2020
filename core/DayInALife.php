<?php

abstract class DayInALife
{
    /**
     * @var string
     */
    protected $fileContent;

    /**
     * @var string[]
     */
    protected $lines;

    /**
     * @var int
     */
    protected $linesCount;

    public function __construct(string $filename) {
        $this->fileContent = file_get_contents('puzzle/input/'.$filename);

        $this->lines = explode(PHP_EOL, $this->fileContent);
        // remove last empty newline.
        array_pop($this->lines);

        $this->linesCount = count($this->lines);
    }

    abstract public function getResultPartOne();

    abstract public function getResultPartTwo();
}
