<?php

class day6 extends DayInALife
{
    public function getResultPartOne()
    {
        $groups = $this->loadGroups();
        $groupSum = 0;

        foreach ($groups as $group) {
            $groupSum += $this->getGroupAnswerSum($group);
        }

        return $groupSum;
    }

    public function getResultPartTwo()
    {
    }

    private function getGroupAnswerSum(string $groupAnswers): int
    {
        $answerList = [];

        $length = strlen($groupAnswers);
        for ($i = 0; $i < $length; $i++) {
            $answer = $groupAnswers[$i];

            if (ctype_alpha($answer) &&
                !in_array($answer, $answerList)
            ) {
                $answerList[] = $answer;
            }
        }

        return count($answerList);
    }

    private function loadGroups(): array
    {
        return explode(PHP_EOL.PHP_EOL, $this->fileContent);
    }
}
