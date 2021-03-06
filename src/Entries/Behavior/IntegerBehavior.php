<?php

namespace Solis\Expressive\Schema\Entries\Behavior;

use Solis\Expressive\Schema\Contracts\Entries\Behavior\IntegerContract;
use Solis\Expressive\Schema\Contracts\Entries\Behavior\GenericContract;

/**
 * Class IntegerBehavior
 *
 * @package Solis\Expressive\Schema\Entries\Behavior
 */
class IntegerBehavior extends GenericBehavior implements IntegerContract
{

    /**
     * @var boolean
     */
    private $autoIncrement;

    /**
     * @var string
     */
    private $incrementalBehavior;

    /**
     * IntegerBehavior constructor.
     *
     * @param array $dados
     */
    public function __construct(array $dados = [])
    {
        parent::__construct($dados);

        $this->setAutoIncrement(
            array_key_exists(
                'autoIncrement',
                $dados
            ) ? $dados['autoIncrement'] : false
        );

        if (!empty($this->isAutoIncrement())) {
            $this->setIncrementalBehavior(
                array_key_exists(
                    'incrementalBehavior',
                    $dados
                ) ? $dados['incrementalBehavior'] : 'database'
            );
        }
    }

    /**
     * setAutoIncrement
     *
     * Atribui valor lógico indicando se o campo é auto incremental ou não
     *
     * @param boolean $autoIncrement
     */
    public function setAutoIncrement($autoIncrement)
    {
        $this->autoIncrement = $autoIncrement;
    }

    /**
     * isAutoIncrement
     *
     * Retorna valor lógico indicando se o campo é auto incremental ou não
     *
     * @return boolean
     */
    public function isAutoIncrement()
    {
        return $this->autoIncrement;
    }

    /**
     * setIncrementalBehavior
     *
     * Retorna o comportamento incremental do respectivo campo
     *
     * @param string $incrementalBehavior
     */
    public function setIncrementalBehavior($incrementalBehavior)
    {
        $this->incrementalBehavior = $incrementalBehavior;
    }

    /**
     * getIncrementalBehavior
     *
     * Retorna o comportamento incremental do respectivo campo
     *
     * @return string
     */
    public function getIncrementalBehavior()
    {
        return $this->incrementalBehavior;
    }

    /**
     * toArray
     *
     * Retorna representação em array do registro
     *
     * @return array
     */
    public function toArray()
    {
        $array = [
            'autoIncrement'       => $this->isAutoIncrement(),
            'incrementalBehavior' => $this->getIncrementalBehavior(),
        ];

        return array_merge(
            parent::toArray(),
            $array
        );
    }
}
