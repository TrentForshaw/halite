<?php
declare(strict_types=1);
namespace ParagonIE\Halite;

/**
 * This is just an abstract class that hosts some constants
 * 
 * Version Tag Info:
 * 
 *  \x31\x41 => 3.141 (approx. pi)
 *  \x31\x42 => 3.142 (approx. pi)
 *  Because pi is the symbol we use for Paragon Initiative Enterprises
 *  \x00\x07 => version 0.07
 */
abstract class Halite
{
    const VERSION             = '2.0.0';

    const HALITE_VERSION_KEYS = "\x31\x40\x02\x00";
    const HALITE_VERSION_FILE = "\x31\x41\x02\x00";
    const HALITE_VERSION      = "\x31\x42\x02\x00";
    
    const VERSION_TAG_LEN = 4;

    public static function isLibsodiumSetupCorrectly(bool $echo = false): bool
    {
        // Require libsodium 1.0.9
        $major = \Sodium\library_version_major();
        $minor = \Sodium\library_version_minor();
        if ($major < 9 || ($major === 9 && $minor < 2)) {
            if ($echo) {
                echo 'Halite needs libsodium 1.0.9 or higher. You have: ', \Sodium\version_string(), "\n";
            }
            return false;
        }

        // Added in version 1.0.3 of the PHP extension
        if (!\function_exists('\\Sodium\\crypto_pwhash_str')) {
            if ($echo) {
                echo 'Halite needs version 1.0.3 or higher of the PHP extension installed.', "\n";
            }
            return false;
        }

        return true;
    }
}
