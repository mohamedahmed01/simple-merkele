<?php
namespace Mohamedahmed01\SimpleMerkele\Types;

use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidHashException;
use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidHashTypeException;

final class HashValidation
{
    private function __construct()
    {
    }
    private const HASH_TYPES =[
        'md4'=> 32,
        'md5'=> 32,
        'sha1'=> 40,
        'sha224'=> 56,
        'sha256'=> 64,
        'sha384'=> 96,
        'sha512/224'=> 56,
        'sha512/256'=> 64,
        'sha512'=> 128,
        'sha3-224'=> 56,
        'sha3-256'=> 64,
        'sha3-384'=> 96,
        'sha3-512'=> 128,
        'ripemd128'=> 32,
        'ripemd160'=> 40,
        'ripemd256'=> 64,
        'ripemd320'=> 80,
        'whirlpool'=> 128,
        'tiger128,3'=> 32,
        'tiger160,3'=> 40,
        'tiger192,3'=> 48,
        'tiger128,4'=> 32,
        'tiger160,4'=> 40,
        'tiger192,4'=> 48,
        'snefru'=> 64,
        'snefru256'=> 64,
        'gost'=> 64,
        'gost-crypto'=> 64,
        'adler32'=> 8,
        'crc32'=> 8,
        'crc32b'=> 8,
        'crc32c'=> 8,
        'fnv132'=> 8,
        'fnv1a32'=> 8,
        'fnv164'=> 16,
        'fnv1a64'=> 16,
        'joaat'=> 8,
        'haval128,3'=> 32,
        'haval160,3'=> 40,
        'haval192,3'=> 48,
        'haval224,3'=> 56,
        'haval256,3'=> 64,
        'haval128,4'=> 32,
        'haval160,4'=> 40,
        'haval192,4'=> 48,
        'haval224,4'=> 56,
        'haval256,4'=> 64,
        'haval128,5'=> 32,
        'haval160,5'=> 40,
        'haval192,5'=> 48,
        'haval224,5'=> 56,
        'haval256,5'=> 64,
];
    private const HASH_REGEX= '/[0-9a-f]/i';

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function getHashLength(String $type)
    {
        if (!array_key_exists($type, self::HASH_TYPES)) {
            throw new InvalidHashTypeException();
        }
        return self::HASH_TYPES[$type];
    }
    
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function checkHashLength(String $hash, String $type)
    {
        if (self::getHashLength($type)!== strlen($hash)) {
            throw new InvalidHashException();
        }
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function validateHashString(String $hash)
    {
        if (!preg_match(self::HASH_REGEX, $hash)) {
            throw new InvalidHashException();
        }
    }
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public static function validHashingAlgo(String $algo)
    {
        if (!array_key_exists($algo, self::HASH_TYPES)) {
            throw new InvalidHashTypeException();
        }
    }
}
