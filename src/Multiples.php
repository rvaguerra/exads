<?php

namespace Rodrigo\Exads;

class Multiples
{
    /**
     * Compute the list of divisors for a given number.
     *
     * By definition, only integers above 1 can be prime.
     *
     * If the given number is outside the valid range,
     * an empty list would be the result.
     *
     * @param integer $number
     * @return array
     */
    public static function compute(int $number) : array
    {
        if ($number <= 1) {
            return [];
        }

        $primes = [];
        $dividend = $number;
        $divisor = 2;

        while ($dividend > 1 && $dividend >= $divisor) {
            if ($dividend % $divisor == 0) {
                $primes[] = $divisor;
                $dividend /= $divisor;
            } else {
                $divisor++;
            }
        }

        return $primes;
    }
    
    /**
     * Check if a number is prime by its divisors.
     *
     * This is a faster method to identify a prime number
     * when the divisors were already computed.
     *
     * @param int[] $divisors
     * @return boolean
     */
    public static function isPrimeByDivisors(array $divisors) : bool
    {
        return count($divisors) == 1;
    }
    
    /**
     * Check if a number is prime.
     *
     * @param integer $number
     * @return boolean
     */
    public static function isPrime(int $number) : bool
    {
        if ($number <= 1) {
            return false;
        }

        return Multiples::isPrimeByDivisors(Multiples::compute($number));
    }

    /**
     * Print the divisors of numbers from 1 to 100 between brackets ("[]")
     * joined by commas (",").
     *
     * If prime, print "PRIME" instead.
     *
     * @return void
     */
    public static function exercise()
    {
        echo "\n\nPrime Number Exercise\n\n";

        for ($number = 1; $number <= 100; $number++) {
            $divisors = Multiples::compute($number);
            $isPrime = Multiples::isPrimeByDivisors($divisors);

            echo $number;
    
            if ($isPrime) {
                echo "[PRIME]";
            } else {
                echo "[", implode(',', $divisors), "]";
            }

            echo "\n";
        }
    }
}
