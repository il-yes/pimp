<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 23/01/18
 * Time: 23:42
 */

namespace PrestationBundle\Checker;


use PrestationBundle\Exception\Activity\BadActivityArgument;
use PrestationBundle\Exception\Prestation\MissingWorshopAssigned;

class WorkshopPresenceChecker
{
    public function isActivityValid($prestation)
    {
        $checkPoint = $prestation->isActivityValid();

        if (!$checkPoint['result'])
        {
            if ($checkPoint['type'] = 'error_activity')
            {
                throw new BadActivityArgument();
            }
            if ($checkPoint['type'] = 'error_workshop')
            {
                throw new MissingWorshopAssigned();
            }
        }
    }
}