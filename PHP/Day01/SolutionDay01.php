<?php declare(strict_types = 1);
/**
 * Created by Joey Overby
 * Repositories: https://github.com/JoeyOverby
 * Date: 12/2/19
 * Time: 10:38 AM
 */

namespace AdventOfCode2019\Day01;

require_once "./../../vendor/autoload.php";

use AdventOfCode2019\DailySolution;
use JoeyOverby\PHPHelpers\PHPHelpers;

/**
 *
 */
class SolutionDay01 extends DailySolution {
    public const PART_1_ARRAY_KEY = "Part1Total";
    public const PART_2_ARRAY_KEY = "Part2Total";
    
    /**
     * SolutionDay01 constructor.
     */
    public function __construct() {
        $this->setInputFilePath(static::INPUT_FILE_NAME);
    }
    
    
    /**
     * This is the entry point function to run and load up the solution
     *
     * @return mixed
     */
    public function run() {
        /** @var string[] $inputWeights */
        $inputWeights = PHPHelpers::readFileIntoArray($this->getInputFilePath());
        
        $toReturn = [];
        
        $part1Total = 0;
        $part2Total = 0;
        
        foreach($inputWeights as $moduleMass) {
            $part1Total += $this->calculateFuelRequired(intval($moduleMass));
            $part2Total += $this->calculateFuelRequiredIncludingItsFuel(intval($moduleMass));
        }
        $toReturn[self::PART_1_ARRAY_KEY] = $part1Total;
        $toReturn[self::PART_2_ARRAY_KEY] = $part2Total;
        
        
        
        return $toReturn;
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
        
        if($fuelRequired <= 0){
            return 0; //Base Case
        } else{
            return $fuelRequired + $this->calculateFuelRequiredIncludingItsFuel($fuelRequired);
        }
    }
    
    
    
}

/**
 * Run and Solve the problem
 */

$solver   = new SolutionDay01();
$solution = $solver->run();

foreach($solution as $key => $value){
    echo $key . ": " . $value . PHP_EOL;
}