<?php

namespace Mohamedahmed01\SimpleMerkele;

use Mohamedahmed01\SimpleMerkele\Types\HashValidation;
use Mohamedahmed01\SimpleMerkele\Exceptions\InvalidArrayModeException;
use Mohamedahmed01\SimpleMerkele\Exceptions\OddHashInventoryException;
use Mohamedahmed01\SimpleMerkele\Exceptions\HashInventoryEmptyException;

final class SimpleMerkele
{
    private $inventory = [];
    private $topHash = '';
    private $array_mode = 2;
    private $hashing_algo = 'sha256';
    public const ALLOW_ODD_ARRAYS = 1;
    public const DIS_ALLOW_ODD_ARRAYS = 2;

    public function __construct($array_mode=2, $hashing_algo='sha256')
    {
        $this->validateArrayMode($array_mode);
        $this->array_mode = $array_mode;
        HashValidation::validHashingAlgo($hashing_algo);
        $this->hashing_algo=$hashing_algo;
    }
    
    public function addHash(String $hash)
    {
        $this->validateHash($hash, $this->hashing_algo);
        $this->inventory[]=$hash;
    }

    public function calculateTree():string
    {
        $this->validateInventory();
        $this->reduceTree($this->inventory, []);
        return $this->topHash;
    }

    public function resetTree()
    {
        $this->inventory=[];
        $this->topHash = '';
    }

    private function reduceTree($treeInventory, $nodeHashesMemo=[])
    {
        $nodeHashes=$nodeHashesMemo;
        if (count($treeInventory)<=0) {
            $treeInventory=$nodeHashes;
            $nodeHashes=[];
            if (count($treeInventory) <= 1 &&empty($nodeHashes)) {
                $this->topHash=array_pop($treeInventory);
                return;
            }
            if (!(count($treeInventory)%2===0)) {
                $treeInventory[]=$treeInventory[count($treeInventory)-1];
            }
        }
        $nodeHashes[] = hash($this->hashing_algo, array_pop($treeInventory).array_pop($treeInventory));
        $this->reduceTree($treeInventory, $nodeHashes);
    }

    /**
    * @SuppressWarnings(PHPMD.StaticAccess)
    */
    private function validateHash(String $hash, String $type)
    {
        HashValidation::validateHashString($hash);
        HashValidation::checkHashLength($hash, $type);
    }

    private function validateInventory()
    {
        if (empty($this->inventory)) {
            throw new HashInventoryEmptyException();
        }
        $isOddArray = count($this->inventory)%2 !== 0;
        if ($this->array_mode === self::ALLOW_ODD_ARRAYS && $isOddArray) {
            $this->inventory[]=$this->inventory[count($this->inventory)-1];
        } elseif ($this->array_mode === self::DIS_ALLOW_ODD_ARRAYS && $isOddArray) {
            throw new OddHashInventoryException();
        }
    }

    private function validateArrayMode($array_mode)
    {
        if (!in_array(
            $array_mode,
            [self::ALLOW_ODD_ARRAYS,self::DIS_ALLOW_ODD_ARRAYS],
            true
        )) {
            throw new InvalidArrayModeException();
        }
    }
}
