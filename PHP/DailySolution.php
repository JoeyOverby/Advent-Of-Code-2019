<?php declare(strict_types = 1);

namespace AdventOfCode2019;

/**
 * Class DailySolution
 */
abstract class DailySolution {
    
    public const INPUT_FILE_NAME = "input.txt";
    
    public const PART_1_ARRAY_KEY = "Part1Total";
    public const PART_2_ARRAY_KEY = "Part2Total";
    
    /** Input file path */
    protected ?string $inputFilePath = null;
    
    /**
     * This is the entry point function to run and load up the solution
     * @return mixed
     */
    public abstract function run();
    
    
    
    /**
     * @return string|null
     */
    public function getInputFilePath() : ?string {
        return $this->inputFilePath;
    }
    
    /**
     * @param string|null $inputFilePath
     */
    public function setInputFilePath(?string $inputFilePath) : void {
        $this->inputFilePath = $inputFilePath;
    }
    
}
