<?php declare(strict_types = 1);
/**
 * Created by Joey Overby
 * Repositories: https://github.com/JoeyOverby
 * Date: 12/2/19
 * Time: 10:38 AM
 */

namespace AdventOfCode2019\Day02;

require_once "./../../vendor/autoload.php";

use AdventOfCode2019\DailySolution;
use JoeyOverby\PHPHelpers\PHPHelpers;

/**
 *
 */
class SolutionDay02 extends DailySolution {
    
    
    public const OP_CODE_STOP     = 99;
    
    public const OP_CODE_ADD      = 1;
    
    public const OP_CODE_MULTIPLY = 2;
    
    
    /**
     * SolutionDay01 constructor.
     */
    public function __construct() {
        $this->setInputFilePath(self::INPUT_FILE_NAME);
    }
    
    
    /**
     * This is the entry point function to run and load up the solution
     *
     * @return mixed
     * @throws \Exception
     */
    public function run() {
        /** @var string[] $inputWeights */
        $input = PHPHelpers::readFileIntoArray($this->getInputFilePath(), ",");
        
        $opCodeArray = $input[0]; //Since there was only one line.
        $opCodeArray = array_map("intval", $opCodeArray); //Turn all of the strings into integers.
        
        $part1Total = $this->runComputerProgram(array_values($opCodeArray), 12, 2);
        
        //Part 2 - Figure out what answer gives us 19690720
        $targetAnswer = 19690720;
        
        //Instantiate to avoid warnings below in calculating part 2 total
        $verb = 0;
        $noun = 0;
        
        for($noun = 0; $noun <= 99; $noun++) {
            for($verb = 0; $verb <= 99; $verb++) {
                $answer = $this->runComputerProgram(array_values($opCodeArray), $noun, $verb);
                
                if($answer === $targetAnswer) {
                    break(2);
                }
            }
            
        }
        
        //Noun 98, Verb 20
        
        $part2Total = 100 * $noun + $verb;
        
        $toReturn[self::PART_1_ARRAY_KEY] = $part1Total;
        $toReturn[self::PART_2_ARRAY_KEY] = $part2Total;
        
        
        return $toReturn;
    }
    
    
    /**
     * @param array $opCodeArray - Input (in memory setup) of computer program/instructions
     * @param int   $noun        - First Parameter to program $input[1] value
     * @param int   $verb        - Second Parameter to program $input[2] value
     *
     * @return int
     * @throws \Exception
     */
    protected function runComputerProgram(array $opCodeArray, int $noun, int $verb) : int {
        // Replace the two values (problem description)
        $opCodeArray[1] = $noun;
        $opCodeArray[2] = $verb;
        
        $pointer = 0;
        
        while($opCodeArray[$pointer] !== self::OP_CODE_STOP) {
            $opCode          = $opCodeArray[$pointer];
            $leftValue       = $opCodeArray[$opCodeArray[$pointer + 1]];
            $rightValue      = $opCodeArray[$opCodeArray[$pointer + 2]];
            $storageLocation = $opCodeArray[$pointer + 3];
            $nextPointer     = $pointer + 4;
            
            switch($opCode) {
                
                case self::OP_CODE_ADD:
                    $value = $leftValue + $rightValue;
                    break;
                
                case self::OP_CODE_MULTIPLY:
                    $value = $leftValue * $rightValue;
                    break;
                
                default:
                    throw new \Exception("Unknown Instruction Code: '" . $opCode . "'");
            }
            
            //Store the computed sum
            $opCodeArray[$storageLocation] = $value;
            $pointer                       = $nextPointer;
            
        }
        
        
        return $opCodeArray[0];
    }
    
    
    /**
     * According to problem description we take the "mass, divide by three, round down, and subtract 2"
     *
     * @param int $moduleMass
     *
     * @return int
     */
    protected function calculateFuelRequired(int $moduleMass) : int {
        $fuelRequired = intval(floor($moduleMass / 3) - 2);
        return $fuelRequired;
    }
    
    /**
     * According to problem description we take the "mass, divide by three, round down, and subtract 2",
     * but since this fuel requires fuel, we need to recursively keep doing this until the additional fuel required
     * is 0 or negative.
     *
     * @param int $moduleMass
     *
     * @return int
     */
    protected function calculateFuelRequiredIncludingItsFuel(int $moduleMass) : int {
        $fuelRequired = intval(floor($moduleMass / 3) - 2);
        
        if($fuelRequired <= 0) {
            return 0; //Base Case
        } else {
            return $fuelRequired + $this->calculateFuelRequiredIncludingItsFuel($fuelRequired);
        }
    }
    
    
}

/**
 * Run and Solve the problem
 */

$solver = new SolutionDay02();
/** @noinspection PhpUnhandledExceptionInspection */
$solution = $solver->run();

foreach($solution as $key => $value) {
    echo $key . ": " . $value . PHP_EOL;
}