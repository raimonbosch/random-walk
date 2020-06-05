# random-walk
PHP class that generates random-walk combination arrays with numeric values. For instance, if you have 100 points to split into 5 parts, the algorithm will give you random combinations splitting this 100 points. A possible combination for number 100 and 5 parts would be [10, 20, 50, 5, 15]. For number 100 and 2 parts could be [50, 50] or [75, 20].

    $accuracy = 0;
    $iterations = 100;
    $randomWalkService = new RandomWalkService(100, 5);
    
    for ($i = 0; $i < $iterations; $i++) {
        $combination = $randomWalkService->next(5);
        echo json_encode($combination) . "\n";
        
        $accuracyNew = runYourMlAlgorithmWithTheseCombination(
            $combination
        );
        
        if ($accuracyNew > $accuracy) {
            $randomWalkService->reinforce($combinationOfParameters);
            $accuracy = $accuracyNew;
        }
    }

You will try each combination in your ML algorithm and in case the combination improves the accuracy you can call to reinforce() so it is persisted and reused for the next iteration. You can also adjust the amount to sum and subtract in the next() call.

## About

A random walk is a mathematical object, known as a stochastic or random process, that describes a path that consists of a succession of random steps on some mathematical space such as the integers... https://en.wikipedia.org/wiki/Random_walk
