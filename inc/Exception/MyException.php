<?php
namespace ContributorsPlugin\Exception;

/**
 * Class for handle plugins exception
 *
 * PHP version 5.6
 *
 * @package  Exception
 * @author   Evgeniy S.Zalevskiy <2600@ukr.net>
 * @license  MIT
 *
 */
class MyException extends \Exception
{
    /**
     * Original Exception instance.
     *
     * @var \Exception
     */
    protected $original;
    /**
     * Init function.
     *
     * @param string $msg error message
     * @param \Exception $e Original Exception instance.
     */
    public function __construct($msg, $e = null)
    {
        $this->original = $e;
        parent::__construct($msg);
    }
}
