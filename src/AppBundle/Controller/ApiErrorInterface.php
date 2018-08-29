<?php

namespace AppBundle\Controller;

/**
 *
 * @author dan
 */
interface ApiErrorInterface {

    const ERROR_NOT_FOUND = 'NOT FOUND';
    const ERROR_NOT_CREATED = 'NOT CREATED';
    const ERROR_NOT_UPDATED = 'NOT UPDATED';
    const ERROR_NOT_DELETED = 'NOT DELETED';
    const ERROR_NOT_VALID_PARAMS = 'NOT VALID PARAMETERS';

}
