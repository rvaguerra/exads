<?php

namespace Rodrigo\Exads;

use Exads\ABTestData;

class ABTesting
{
    /**
     * Generate a random value.
     *
     * Main class can be inherited and the method for providing
     * a random value overridden.
     *
     * @return integer
     */
    protected function generateRandomValue() : int
    {
        return random_int(0, 100);
    }

    /**
     * Get available designs.
     *
     * @param integer $promoId
     * @return array
     */
    public function getDesigns(int $promoId) : array
    {
        return (new ABTestData($promoId))->getAllDesigns();
    }

    /**
     * Get a promotional design.
     *
     * @param integer $promoId
     * @return array
     */
    public function getDesign(int $promoId) : array
    {
        $designs = $this->getDesigns($promoId);

        if (count($designs) == 0) {
            throw new \Exception('No designs were found.');
        }

        $percentageSum = 0;
        $randomValue = $this->generateRandomValue();
        
        foreach ($designs as $design) {
            $percentageSum += $design['splitPercent'];

            if ($randomValue <= $percentageSum) {
                return $design;
            }
        }

        // protection for invalid split percentage distribution
        return $designs[count($designs) - 1];
    }

    /**
     * Redirects the user based on a design.
     *
     * Just a method to represent the redirect
     * process by given a design selected elsewhere.
     *
     * @param array $design
     * @return void
     */
    public static function redirect(array $design) : void
    {
        //
    }

    /**
     * Redirects end users based on designs provided by Exads\ABTestData library.
     *
     * @return void
     */
    public static function exercise() : void
    {
        echo "\n\nA/B Testing Exercise\n\n";

        $abTesting = new ABTesting();
        $promoId = 2;
        $design = $abTesting->getDesign($promoId);
        print_r($design);
        ABTesting::redirect($design);
    }
}
