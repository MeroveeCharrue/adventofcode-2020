<?php

class day2 extends DayInALife
{
    private function splitInputString(string $line): stdClass
    {
        $input = explode(' ', $line);
        // Example of one line:
        // "7-13 c: cxccxcccglccs"

        $rules = new stdClass();
        $rules->password = $input[2];
        $rules->character = substr($input[1], 0, -1);

        $limit = explode('-', $input[0]);
        $rules->minOccurrence = $limit[0];
        $rules->maxOccurrence = $limit[1];

        return $rules;
    }

    private function countOccurrence(string $char, string $password): int
    {
        return substr_count($password, $char);
    }

    public function getResultPartOne()
    {
        $goodPassword = 0;

        foreach ($this->lines as $line) {
            $rules = $this->splitInputString($line);
            $count = $this->countOccurrence($rules->character, $rules->password);

            if ($count <= $rules->maxOccurrence && $count >= $rules->minOccurrence) {
                $goodPassword++;
            }
        }

        return $goodPassword;
    }

    private function verifyOccurrence(int $position1, int $position2, string $char,string $password): bool
    {
        // Account for non-zero index.
        $position1--;
        $position2--;

        return ($password[$position1] === $char xor $password[$position2] === $char);
    }

    public function getResultPartTwo()
    {
        $goodPassword = 0;

        foreach ($this->lines as $line) {
            $rules = $this->splitInputString($line);
            if ($this->verifyOccurrence($rules->minOccurrence, $rules->maxOccurrence, $rules->character, $rules->password)) {
                $goodPassword++;
            }
        }

        return $goodPassword;
    }
}
