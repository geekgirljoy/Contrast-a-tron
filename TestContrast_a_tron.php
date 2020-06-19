<?php

$train_file = (dirname(__FILE__) . "/Contrast_a_tron.net");
if (!is_file($train_file))
    die("Contrast_a_tron.net has not been created! Please run TrainContrast_a_tron.php to generate it" . PHP_EOL);

$ann = fann_create_from_file($train_file);

$results = array();


if ($ann) {
    
    foreach(range(1, -1, -0.2) as $test_input_value_a){
        foreach(range(-1, 1, -0.2) as $test_input_value_b){
        
            $input = array($test_input_value_a, $test_input_value_b);
            $result = fann_run($ann, $input);

            $a = number_format($result[0], 4);
            $b = number_format($result[1], 4);
            
            // What answer did the ANN give?
			
            $answer = NULL;
            $evaluation = '';
            if($a <= 0 && $b <= 0){
                $evaluation = 'Neutral/Same';
                $answer = 0;
            }
            elseif($a > $b){
                $evaluation = 'A is Brighter';
                $answer = -1;
            }
            elseif($b > $a){
                $evaluation = 'B is Brighter';
                $answer = 1;
            }
            else{ 
                $evaluation = ' OOPSIES!!!!!!!';
            }

            echo 'Contrast_a_tron(' . $input[0] . ', ' . $input[1] . ") -> [$a, $b] - $evaluation" . PHP_EOL; 
        }
    }
    fann_destroy($ann);
}
else {
    die("Invalid file format" . PHP_EOL);
}
