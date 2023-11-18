<?php
declare(strict_types=1);

namespace App\Exception;

use Cake\Core\Exception\CakeException;

class NotificationException extends CakeException
{
    protected $_defaultCode = 500;
}
