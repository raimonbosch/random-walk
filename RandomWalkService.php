<?php

class RandomWalkService
{
    private $arr;
    private $number;
    private $parts;

    public function __construct(int $number, int $parts)
    {
        $this->number = $number;
        $this->parts = $parts;
        $this->arr = [];
        for ($i = 0; $i < $parts; $i++) {
            $this->arr []= (int) floor($number/$parts);
        }
    }

    public function next($step, $deep = 1)
    {
        $arrNext = $this->arr;
        list($element1, $element2) = $this->calculateRandomIndexes();

        $arrNext[$element1] += $step;
        $arrNext[$element2] -= $step;

        if ($this->hasNegativeNumbers($arrNext, $deep + 1)) {
            return $this->next($step);
        }

        return $arrNext;
    }

    public function reinforce($arrNext)
    {
        $this->arr = $arrNext;
    }

    private function hasNegativeNumbers($arrNext, $deep = 1)
    {
        if ($deep > 100) {
            throw new Exception('There are no more combinations available!');
        }

        foreach ($arrNext as $element) {
            if ($element < 0) {
                return true;
            }
        }

        return false;
    }

    private function calculateRandomIndexes()
    {
        while (true) {
            $element1 = rand(0, $this->parts - 1);
            $element2 = rand(0, $this->parts - 1);

            if ($element1 != $element2) {
                break;
            }
        }

        return [$element1, $element2];
    }
}

$accuracy = 0;
$numIterations = 100;
$randomWalkService = new RandomWalkService(100, 5);

for ($i = 0; $i < $numIterations; $i++) {
    $combination = $randomWalkService->next(5);
    $newAccuracy = runYourMachineLearningAlgorithm($combination, $i);

    if ($newAccuracy > $accuracy) {
        echo json_encode($combination) . "\n";
        $randomWalkService->reinforce($combination);
        $accuracy = $newAccuracy;
    }
}

echo "Accuracy accomplished: " . $accuracy . '%' . "\n";

function runYourMachineLearningAlgorithm($combination, $currentIteration)
{
    //TODO: Here you would call to your algorithm with this numeric parameters
    $accuracy = rand(0, $currentIteration + 1); //Just a small example to make the algorithm run

    return $accuracy;
}
