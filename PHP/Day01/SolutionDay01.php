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
        
        $runningTotal = 0;
        foreach($inputWeights as $moduleMass) {
            $runningTotal += $this->calculateFuelRequired(intval($moduleMass));
        }
        
        //For Part 2
        
        
        return $runningTotal;
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
        return $fuelRequired;
    }
    
    
    
}

/**
 * Run and Solve the problem
 */

$solver   = new SolutionDay01();
$solution = $solver->run();
echo "Solution: " . $solution;