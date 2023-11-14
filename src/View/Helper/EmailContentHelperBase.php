<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * EmailContent helper
 *
 * @property-read Helper\HtmlHelper $Html
 * @property-read Helper\UrlHelper $Url
 */
abstract class EmailContentHelperBase extends Helper implements EmailContentHelperInterface
{
    protected $helpers = ['Html', 'Url'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];
}
