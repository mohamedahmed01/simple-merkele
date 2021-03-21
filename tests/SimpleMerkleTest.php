<?php

namespace Mohamedahmed01\SimpleMerkele\Tests;

use Mohamedahmed01\SimpleMerkele\Exceptions\HashInventoryEmptyException;
use PHPUnit\Framework\TestCase;
use Mohamedahmed01\SimpleMerkele\SimpleMerkele;
use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidHashException;
use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidHashTypeException;
use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidArrayModeException;
use Mohamedahmed01\SimpleMerkele\Exceptions\OddHashInventoryException;

class SimpleMerkleTest extends TestCase
{
    /** @test */
    public function createSimpleMerkele()
    {
        $this->assertInstanceOf(SimpleMerkele::class, new SimpleMerkele());
    }

    /** @test */
    public function simpleMerkleThrowsExceptionOnInvalidArrayMode()
    {
        $this->expectException(InvalidArrayModeException::class);
        $this->assertInstanceOf(SimpleMerkele::class, new SimpleMerkele(5));
    }

    /** @test */
    public function simpleMerkleThrowsExceptionOnInvalidHashType()
    {
        $this->expectException(InvalidHashTypeException::class);
        $this->assertInstanceOf(SimpleMerkele::class, new SimpleMerkele(2, 'banana'));
    }

    /** @test */
    public function simpleMerkeleHasAddHash()
    {
        $this->assertTrue(
            method_exists(new SimpleMerkele(), 'addHash'),
            'Class does not have method addHash'
        );
    }

    /** @test */
    public function addHashThrowsExceptionOnInvalidHashLength()
    {
        $this->expectException(InvalidHashException::class);
        (new SimpleMerkele())->addHash('AAAA');
    }

    /** @test */
    public function addHashThrowsExceptionOnInvalidHashCharachter()
    {
        $this->expectException(InvalidHashException::class);
        (new SimpleMerkele())->addHash('وادع الصخور لترحم العظم المُهشم');
    }

    /** @test */
    public function simpleMerkeleHasCalulateTree()
    {
        $this->assertTrue(
            method_exists(new SimpleMerkele(), 'calculateTree'),
            'Class does not have method calculateTree'
        );
    }

    /** @test */
    public function calulateTreeThrowsExceptionOnEmptyInventory()
    {
        $this->expectException(HashInventoryEmptyException::class);
        (new SimpleMerkele())->calculateTree();
    }

    /** @test */
    public function calulateTreeThrowsExceptionOnInvalidInventoryUsingDisallowODDInventory()
    {
        $this->expectException(OddHashInventoryException::class);
        $merkele = new SimpleMerkele(SimpleMerkele::DIS_ALLOW_ODD_ARRAYS);
        $merkele->addHash(hash('sha256', 'hello'));
        $merkele->calculateTree();
    }

    /** @test */
    public function calulateTreeReturnsExpectedHash()
    {
        $hashsArray=[
                hash('sha256', 'hello'),
                hash('sha256', 'goodbye'),
                hash('sha256', 'topofthemorning'),
                hash('sha256', 'sionara'),
                hash('sha256', 'areviditche'),
                hash('sha256', 'arregato'),
            ];
        $merkele = new SimpleMerkele();
        foreach ($hashsArray as $hash) {
            $merkele->addHash($hash);
        }
        $this->assertEquals(
            '9b8dd5dd1f56d5fa17a67c10b8891c57e51f5fd36fe3a2d7e290d605840332d8',
            $merkele->calculateTree()
        );
    }

        /** @test */
        public function calulateTreeReturnsExpectedHashOnUsingOddArrays()
        {
            $hashsArray=[
                    hash('sha256', 'hello'),
                    hash('sha256', 'goodbye'),
                    hash('sha256', 'topofthemorning'),
                    hash('sha256', 'sionara'),
                    hash('sha256', 'areviditche'),
                ];
            $merkele = new SimpleMerkele(SimpleMerkele::ALLOW_ODD_ARRAYS);
            foreach ($hashsArray as $hash) {
                $merkele->addHash($hash);
            }
            $this->assertEquals(
                '77894a7ac0f394835a304b53023bd25bf6c645eab0b1ef81e6636cab971f47e4',
                $merkele->calculateTree()
            );
        }
    /** @test */
    public function simpleMerkeleHasResetTree()
    {
        $this->assertTrue(
            method_exists(new SimpleMerkele(), 'resetTree'),
            'Class does not have method resetTree'
        );
    }
    /** @test */
    public function resetTreeEmptiesTheInventory()
    {
        $this->expectException(HashInventoryEmptyException::class);
        $hashsArray=[
                hash('sha256', 'hello'),
                hash('sha256', 'goodbye'),
                hash('sha256', 'topofthemorning'),
                hash('sha256', 'sionara'),
                hash('sha256', 'areviditche'),
                hash('sha256', 'arregato'),
            ];
        $merkele = new SimpleMerkele();
        foreach ($hashsArray as $hash) {
            $merkele->addHash($hash);
        }

        $merkele->calculateTree();
        $merkele->resetTree();
        $merkele->calculateTree();
    }
}
