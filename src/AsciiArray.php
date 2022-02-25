<?php

namespace Rodrigo\Exads;

class AsciiArray
{
    /**
     * Count the number of occurrences of all characters in the given character array.
     *
     * Returns a key => value array, where key is the character and
     * value the number of occurrences.
     *
     * @param array $sequence
     * @return array
     */
    public static function countCharacterOccurrences(array $sequence): array
    {
        $occurrences = [];

        foreach ($sequence as $character) {
            if (!isset($occurrences[$character])) {
                $occurrences[$character] = 0;
            }

            $occurrences[$character]++;
        }

        return $occurrences;
    }

    /**
     * Compare two character sequences and find the first missing character.
     *
     * Returns the first missing character.
     *
     * @param array $sequence
     * @param array $missingCharacterSequence
     * @return string
     */
    public static function findMissingCharacter(array $sequence, array $missingCharacterSequence) : string
    {
        $reference = AsciiArray::countCharacterOccurrences($sequence);
        $missing = AsciiArray::countCharacterOccurrences($missingCharacterSequence);

        foreach ($reference as $character => $occurrences) {
            if (!isset($missing[$character])) {
                return $character;
            }

            if ($reference[$character] != $missing[$character]) {
                return $character;
            }
        }
        
        return '';
    }

    /**
     * Remove an arbitrary character from a character array.
     *
     * @param array $sequence
     * @return array
     */
    public static function removeCharacter(array $sequence) : array
    {
        array_pop($sequence);
        return $sequence;
    }

    /**
     * Generate a character array from a string.
     * The included characters must be between comma (",") and pipe ("|").
     *
     * The match is greedy!
     *
     * @param string $string
     * @return array
     */
    public static function generateCharacterSequence(string $string) : array
    {
        $matches = [];
        preg_match('/\,(?P<characters>.+)\|/', $string, $matches);

        if (!isset($matches['characters'])) {
            return [];
        }

        return str_split($matches['characters']);
    }

    /**
     * Generate a random character array from a string.
     * Remove a character arbitrarily.
     * Find the missing character efficiently.
     *
     * Considerations:
     * - Array is in random order;
     * - Array size not specified;
     * - Character repetition was not specified, but considered possible.
     *
     * @return string
     */
    public static function exercise() : string
    {
        echo "\n\nAscii Array Exercise\n\n";

        $string = ",abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-=~`';:,<.>/?{}[]\|";
        $sequence = AsciiArray::generateCharacterSequence($string);
        shuffle($sequence);
        $shortenedSequence = AsciiArray::removeCharacter($sequence);
        $missing = AsciiArray::findMissingCharacter($sequence, $shortenedSequence);

        echo "Original:  '", implode('', $sequence), "'\n";
        echo "Shortened: '", implode('', $shortenedSequence), "'\n";
        echo "Missing character: '{$missing}'";
     
        return $missing;
    }
}
