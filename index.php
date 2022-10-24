<?php
namespace andreterceiro;

require_once 'vendor/autoload.php';
require_once 'config.php';

define(PAPER, 1);
define(ROCK, 2);
define(SCISSORS, 3);

define(INTEGER_COMPUTER_WINS, -1);
define(INTEGER_DRAW, 0);
define(INTEGER_USER_WINS, 1);

$Smarty = new \Smarty();

$integerWinner = null;
$integerComputerOption = null;

if (hasValidOption($_POST['option'])) {
    $integerComputerOption = getIntegerComputerOption();
    $integerWinner = getIntegerWinner($_POST['option'], $integerComputerOption);
}

showTemplate(
    $Smarty, 
    getStringWinner($integerWinner, $integerComputerOption)
);

/**
 * Return true if the option is valid
 * 
 * @access public
 * 
 * @param string $option Option informed
 * 
 * @return boolean
 */
function hasValidOption($option) {
    return $option == "1" || $option == "2" || $option == "3";
}

/**
 * Returns the random INTEGER computer option
 *
 * @access public
 * 
 * @return int
 */
function getIntegerComputerOption() {
    return random_int(1, 3);
}

/**
 * Show the form to user select the option and the response (e=who is the winner)
 * 
 * @access public
 * 
 * @return null
 */
function showTemplate($Smarty, $stringWinner) {
    $stringWinner = $Smarty->assign("stringWinner", $stringWinner);
    $Smarty->display("template.tpl");
}

/**
 * Returns the winner
 * 
 * @access public
 *
 * @throws \RangeException If any parameter is > 3 or < 1
 *  
 * @param int $integerUserOption     The user option
 * @param int $integerComputerOption The computer option, ideally a random option
 *
 * @return int
 */
function getIntegerWinner($integerUserOption, $integerComputerOption) {
    if ($integerUserOption < 1 || $integerUserOption > 3) {
        throw new \RangeException("The user option is invalid");
    }
    if ($integerComputerOption < 1 || $integerComputerOption > 3) {
        throw new \RangeException("The computer option is invalid");
    }

    $dataToReturn = INTEGER_DRAW; 
    if (($integerUserOption == PAPER && $integerComputerOption == ROCK) || ($integerUserOption == ROCK && $integerComputerOption == SCISSORS) || ($integerUserOption == SCISSORS && $integerComputerOption == PAPER)) {
        return INTEGER_USER_WINS;
    } else if ($integerUserOption != $integerComputerOption) {
        return INTEGER_COMPUTER_WINS;
    }

    return $dataToReturn;
}

/**
 * Returns the string who informs the winner
 * 
 * @access public
 * 
 * @param integer
 * 
 * @return string
 */
function getStringWinner($integerWinner, $integerComputerOption) {    
    if ($integerWinner == INTEGER_DRAW && !empty($integerComputerOption)) {
        return "Draw. Computer selected " . getStringComputerOption($integerComputerOption);
    } elseif ($integerWinner == INTEGER_COMPUTER_WINS) {
        return "Computer wins. Computer selected " . getStringComputerOption($integerComputerOption);
    } elseif ($integerWinner == INTEGER_USER_WINS) {
        return "User wins. Computer selected " . getStringComputerOption($integerComputerOption);
    }
    return "";
}

/** 
 * Return a string related to the informed (parameter) $integerComputerOption
 * 
 * @access public
 * 
 * @throws \RangeException If the $integerComputerOption is invaid an non empty
 * 
 * @param int $integerComputerOption The integer computer option
 * 
 * @return string Return an empty string if the $integerComputerOption is empty
 *                or a string related to the parameter $integerComputerOption
 */
function getStringComputerOption($integerComputerOption) {
    if ($integerComputerOption == PAPER) {
        return "Paper";
    } elseif ($integerComputerOption == ROCK) {
        return "Rock";
    } elseif ($integerComputerOption == SCISSORS) {
        return "Scissors";
    } elseif (is_null($integerComputerOption)) {
        return "";
    }

    throw new \RangeException("Unknown integer computer option: '" . print_r($integerComputerOption, TRUE) . "'");     
}