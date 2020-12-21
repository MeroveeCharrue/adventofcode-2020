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
        return '';

//        $groups = $this->loadGroups();
//        $groupSum = 0;
//
//        foreach ($groups as $group) {
//            $groupSum += $this->getGroupCollectiveAnswerSum($group);
//        }
//
//        return $groupSum;
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

    private function getGroupCollectiveAnswerSum(string $groupAnswers): int
    {
        $answersPerPerson = explode(PHP_EOL, $groupAnswers);
        $answerList = [];

        foreach ($answersPerPerson as $answers) {
            $answers = trim($answers);

            $length = strlen($answers);
            for ($i = 0; $i < $length; $i++) {
                $answer = $answers[$i];

                if (!array_key_exists($answer, $answerList)) {
                    $answerList[$answer] = 1;
                } else {
                    $answerList[$answer]++;
                }
            }
        }

        $realzy = [];
        foreach ($answerList as $letter => $count) {
            if ($count === count($answersPerPerson)) {
                $realzy[] = $letter;
            }
        }

        return count($realzy);
    }

    private function loadGroups(): array
    {
        return explode(PHP_EOL.PHP_EOL, $this->fileContent);
    }
}
