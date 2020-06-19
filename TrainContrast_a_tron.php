<?php

$num_input = 2;
$num_output = 2;
$layers = array($num_input, 2, 1, $num_output);
$ann = fann_create_standard_array(count($layers), $layers);

$desired_error = 0.0000000001;
$max_epochs = 900000;
$epochs_between_reports = 10;

if ($ann) {
    fann_set_activation_function_hidden($ann, FANN_SIGMOID_SYMMETRIC);
    fann_set_activation_function_output($ann, FANN_SIGMOID_SYMMETRIC);
    fann_set_training_algorithm($ann,FANN_TRAIN_INCREMENTAL);

    $filename = dirname(__FILE__) . "/Contrast_a_tron.data";
    if (fann_train_on_file($ann, $filename, $max_epochs, $epochs_between_reports, $desired_error)){
        echo 'Contrast_a_tron trained.' . PHP_EOL;
    }

    if (fann_save($ann, dirname(__FILE__) . "/Contrast_a_tron.net")){
        echo 'Contrast_a_tron.net saved.' . PHP_EOL;
    }
    
    fann_destroy($ann);
}
