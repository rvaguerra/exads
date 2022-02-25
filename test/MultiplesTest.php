<?php

use PHPUnit\Framework\TestCase;
use Rodrigo\Exads\Multiples;

class MultiplesTest extends TestCase
{
    public function testItReturnsEmptyArrayForInvalidNumbers() : void
    {
        $this->assertEmpty(Multiples::compute(-10));
        $this->assertEmpty(Multiples::compute(-1));
        $this->assertEmpty(Multiples::compute(0));
        $this->assertEmpty(Multiples::compute(1));
    }

    public function testItComputesNumberDivisors() : void
    {
        $this->assertEquals(Multiples::compute(-1), []);
        $this->assertEquals(Multiples::compute(0), []);
        $this->assertEquals(Multiples::compute(1), []);
        $this->assertEquals(Multiples::compute(2), [2]);
        $this->assertEquals(Multiples::compute(2 * 3 * 5 * 5), [2, 3, 5, 5]);
        $this->assertEquals(Multiples::compute(2 * 3 * 7 * 3 * 2), [2, 2, 3, 3, 7]);
    }

    public function testItsPrimeByDivisors() : void
    {
        $this->assertTrue(Multiples::isPrimeByDivisors([2]));
        $this->assertTrue(Multiples::isPrimeByDivisors([3]));
    }

    public function testItsNotPrimeIfHasNoDivisors()
    {
        $this->assertFalse(Multiples::isPrimeByDivisors([]));
    }
    
    public function testItsNotPrimeIfHasManyDivisors()
    {
        $this->assertFalse(Multiples::isPrimeByDivisors([2, 3, 4, 5]));
    }

    public function testItChecksIfIsPrime() : void
    {
        $this->assertTrue(Multiples::isPrime(2));
        $this->assertTrue(Multiples::isPrime(3));
        $this->assertTrue(Multiples::isPrime(5));
        $this->assertTrue(Multiples::isPrime(7));
        $this->assertTrue(Multiples::isPrime(13));
        $this->assertTrue(Multiples::isPrime(19));
        $this->assertTrue(Multiples::isPrime(23));
        $this->assertTrue(Multiples::isPrime(97));
    }

    public function testItsNotPrimeIfConsistsOfMultiples()
    {
        $this->assertFalse(Multiples::isPrime(3 * 3));
        $this->assertFalse(Multiples::isPrime(2 * 5));
        $this->assertFalse(Multiples::isPrime(2 * 2 * 3));
    }
}
