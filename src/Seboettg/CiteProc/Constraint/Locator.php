<?php

namespace Seboettg\CiteProc\Constraint;


/**
 * Class Locator
 * @package Seboettg\CiteProc\Node\Choose\Constraint
 *
 * @author Sebastian Böttger <boettger@hebis.uni-frankfurt.de>
 */
class Locator implements ConstraintInterface
{

    public function validate($value)
    {
        return false;
    }
}