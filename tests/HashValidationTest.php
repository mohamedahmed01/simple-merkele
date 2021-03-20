<?php

namespace Mohamedahmed01\SimpleMerkele\Tests;

use PHPUnit\Framework\TestCase;
use Mohamedahmed01\SimpleMerkele\Types\HashValidation;
use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidHashException;
use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidHashTypeException;

class HashValidationTest extends TestCase
{

    /** @test */
    public function hashValidationHasGetHashLength()
    {
        $this->assertTrue(
            method_exists(HashValidation::class, 'getHashLength'),
            'Class does not have method getHashLength'
        );
    }

    /** @test
    * @SuppressWarnings(PHPMD.StaticAccess)
    */
    public function getHashLengthReturnsTheCorrectHashLength()
    {
        $this->assertEquals(HashValidation::getHashLength('md4'), 32);
        $this->assertEquals(HashValidation::getHashLength('md5'), 32);
        $this->assertEquals(HashValidation::getHashLength('sha1'), 40);
        $this->assertEquals(HashValidation::getHashLength('sha224'), 56);
        $this->assertEquals(HashValidation::getHashLength('sha256'), 64);
        $this->assertEquals(HashValidation::getHashLength('sha384'), 96);
        $this->assertEquals(HashValidation::getHashLength('sha512/224'), 56);
        $this->assertEquals(HashValidation::getHashLength('sha512/256'), 64);
        $this->assertEquals(HashValidation::getHashLength('sha512'), 128);
        $this->assertEquals(HashValidation::getHashLength('sha3-224'), 56);
        $this->assertEquals(HashValidation::getHashLength('sha3-256'), 64);
        $this->assertEquals(HashValidation::getHashLength('sha3-384'), 96);
        $this->assertEquals(HashValidation::getHashLength('sha3-512'), 128);
        $this->assertEquals(HashValidation::getHashLength('ripemd128'), 32);
        $this->assertEquals(HashValidation::getHashLength('ripemd160'), 40);
        $this->assertEquals(HashValidation::getHashLength('ripemd256'), 64);
        $this->assertEquals(HashValidation::getHashLength('ripemd320'), 80);
        $this->assertEquals(HashValidation::getHashLength('whirlpool'), 128);
        $this->assertEquals(HashValidation::getHashLength('tiger128,3'), 32);
        $this->assertEquals(HashValidation::getHashLength('tiger160,3'), 40);
        $this->assertEquals(HashValidation::getHashLength('tiger192,3'), 48);
        $this->assertEquals(HashValidation::getHashLength('tiger128,4'), 32);
        $this->assertEquals(HashValidation::getHashLength('tiger160,4'), 40);
        $this->assertEquals(HashValidation::getHashLength('tiger192,4'), 48);
        $this->assertEquals(HashValidation::getHashLength('snefru'), 64);
        $this->assertEquals(HashValidation::getHashLength('snefru256'), 64);
        $this->assertEquals(HashValidation::getHashLength('gost'), 64);
        $this->assertEquals(HashValidation::getHashLength('gost-crypto'), 64);
        $this->assertEquals(HashValidation::getHashLength('adler32'), 8);
        $this->assertEquals(HashValidation::getHashLength('crc32'), 8);
        $this->assertEquals(HashValidation::getHashLength('crc32b'), 8);
        $this->assertEquals(HashValidation::getHashLength('crc32c'), 8);
        $this->assertEquals(HashValidation::getHashLength('fnv132'), 8);
        $this->assertEquals(HashValidation::getHashLength('fnv1a32'), 8);
        $this->assertEquals(HashValidation::getHashLength('fnv164'), 16);
        $this->assertEquals(HashValidation::getHashLength('fnv1a64'), 16);
        $this->assertEquals(HashValidation::getHashLength('joaat'), 8);
        $this->assertEquals(HashValidation::getHashLength('haval128,3'), 32);
        $this->assertEquals(HashValidation::getHashLength('haval160,3'), 40);
        $this->assertEquals(HashValidation::getHashLength('haval192,3'), 48);
        $this->assertEquals(HashValidation::getHashLength('haval224,3'), 56);
        $this->assertEquals(HashValidation::getHashLength('haval256,3'), 64);
        $this->assertEquals(HashValidation::getHashLength('haval128,4'), 32);
        $this->assertEquals(HashValidation::getHashLength('haval160,4'), 40);
        $this->assertEquals(HashValidation::getHashLength('haval192,4'), 48);
        $this->assertEquals(HashValidation::getHashLength('haval224,4'), 56);
        $this->assertEquals(HashValidation::getHashLength('haval256,4'), 64);
        $this->assertEquals(HashValidation::getHashLength('haval128,5'), 32);
        $this->assertEquals(HashValidation::getHashLength('haval160,5'), 40);
        $this->assertEquals(HashValidation::getHashLength('haval192,5'), 48);
        $this->assertEquals(HashValidation::getHashLength('haval224,5'), 56);
        $this->assertEquals(HashValidation::getHashLength('haval256,5'), 64);
    }


    /** @test
    * @SuppressWarnings(PHPMD.StaticAccess)
    */
    public function getHashLengthReturnsExceptionForInvalidTypes()
    {
        $this->expectException(InvalidHashTypeException::class);
        $this->assertEquals(HashValidation::getHashLength('banana'), 32);
    }

    /** @test */
    public function hashValidationHascheckHashLength()
    {
        $this->assertTrue(
            method_exists(HashValidation::class, 'checkHashLength'),
            'Class does not have method checkHashLength'
        );
    }

    /** @test */
    public function hashValidationHasValidateHashString()
    {
        $this->assertTrue(
            method_exists(HashValidation::class, 'validateHashString'),
            'Class does not have method validateHashString'
        );
    }

    /** @test
    * @SuppressWarnings(PHPMD.StaticAccess)
    */
    public function hashValidationDontRaiseExceptionOnValidString()
    {
        $this->assertNull(
            HashValidation::validateHashString('146a7492719b3564094efe7abbd40a7416fd900179d02773')
        );
    }

    /** @test
    * @SuppressWarnings(PHPMD.StaticAccess)
    */
    public function hashValidationDontRaiseExceptionOnInValidString()
    {
        $this->expectException(InvalidHashException::class);
        $this->assertNull(
            HashValidation::validateHashString('الكلب قفز فوق الثعلب')
        );
    }

    /** @test */
    public function hashValidationHasValidHashingAlgo()
    {
        $this->assertTrue(
            method_exists(HashValidation::class, 'validHashingAlgo'),
            'Class does not have method getHashLength'
        );
    }

    /** @test
    * @SuppressWarnings(PHPMD.StaticAccess)
    */
    public function validHashingAlgothrowsExceptionForInvalidTypes()
    {
        $this->expectException(InvalidHashTypeException::class);
        $this->assertNull(HashValidation::validHashingAlgo('banana'));
    }
}
