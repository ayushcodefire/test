<?php
// Initialize Variables here
/*
 * $sum value i.e to be calculated
 * $arr Array contail all the positive integers
 * $size size of the array
 * 
 */

$sum = 30;
$arr = array(2,4,6,8,10,12,14,16,18); 
$size = sizeof($arr); 

echo '<h3>Current PHP version: ' . phpversion().'</h3>';

//Execution Time Start
$time_start = microtime(true); 
// Check for required values
if($size == 0 || $sum == ""){
    echo '<h2>Please define the required values.</h2>';
    exit;
}

// Loop to get all the possible subset of $sum 
for($i = 1; $i <= count($arr); $i ++) {
    $final[] = get_subset($arr, $size, $i, $sum); 
}
// Print the Output
if(empty(array_filter($final))){
    echo '<h2>There is no possible combination for this sum.</h2>';
} else {
    echo '<h2>Possible Combination of Array</h2>';
    echo '<pre>';
    print_r(array_values(array_filter($final)));
    echo '</pre>';
}

// Execution Stop time
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);

//Total execution time of the script
echo '<h2>Total Execution Time: '.$execution_time.' Seconds</h2> ';
/**
 * Function to get the subset 
 * @param type $arr Defined Array
 * @param type $n Size of the array
 * @param type $length length of the Combination
 * @param type $sum Defined Sum
 * @return type array
 */
function get_subset($arr, $n, $length, $sum) {
    $data = array();
    $result = find_all_combination($arr, $data, 0, $n - 1, 0, $length);
    $_temp = [];
    foreach( $result as $val){
        if(check_for_sum($val, $sum)){
            $_temp[] = $val;
        }
    }
    return $_temp;
}

/**
 * Check for sum
 * @param type $val Combination values
 * @param type $sum Defined Value
 * @return boolean True if equal to sum else False
 */
function check_for_sum($val, $sum){
    $temp = explode(',', $val);
    $temp = array_sum($temp);
    if($temp == $sum){
        return True;
    } else {
        return False;
    }
}

/**
 * All the Possible combination of length $length
 * @param type $arr Defined array
 * @param type $data Enpty array to get the peocess values
 * @param type $start Starting index
 * @param type $end End Index
 * @param type $index Index to start
 * @param type $length length of the Combination
 * @param type $result Result array to return
 * @return type Array
 */
function find_all_combination($arr, $data, $start, $end, $index, $length, $result = array()) {
    if ($index == $length) {
        $temp = '';
        for ($j = 0; $j < $length; $j++)
            $temp .= $data[$j] . ',';
        $result[] = $temp;
    }
    for ($i = $start; $i <= $end && $end - $i + 1 >= $length - $index; $i++) {
        $data[$index] = $arr[$i];
        $result = find_all_combination($arr, $data, $i + 1, $end, $index + 1, $length, $result);
    }
    return $result;
}

?>