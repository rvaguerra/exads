<?php

use PHPUnit\Framework\TestCase;
use Rodrigo\Exads\AsciiArray;

class AsciiArrayTest extends TestCase
{
    public function testItCountsCharacterOccurrences() : void
    {
        $occurrences = AsciiArray::countCharacterOccurrences(['a', 'a', 'b', 'a', 'c']);

        $this->assertEquals($occurrences, [
            'a' => 3,
            'b' => 1,
            'c' => 1,
        ]);
    }

    public function testItCountsEmptySequences() : void
    {
        $this->assertEquals(AsciiArray::countCharacterOccurrences([]), []);
    }

    public function testItIdentifiesTheMissingCharacter() : void
    {
        $sequence = ['a', 'b', 'a', 'c'];
        $missingCharacterSequence = ['a', 'b', 'c'];
        $missingCharacter = 'a';

        $this->assertEquals(
            AsciiArray::findMissingCharacter(
                $sequence,
                $missingCharacterSequence
            ),
            $missingCharacter
        );
    }

    public function testItReturnsEmptyCharacterIfNoMissingCharacterIsFound() : void
    {
        $sequence = ['a', 'b', 'c', 'b', 'a'];

        $this->assertEquals(
            AsciiArray::findMissingCharacter(
                $sequence,
                $sequence
            ),
            ''
        );
    }

    public function testItGeneratesACharacterSequenceBetweenCommaAndPipe() : void
    {
        $sequenceString = 'before,123xyz|after';
        $expectedSequence = ['1', '2', '3', 'x', 'y', 'z'];

        $this->assertEquals(
            AsciiArray::generateCharacterSequence($sequenceString),
            $expectedSequence
        );
    }
}
