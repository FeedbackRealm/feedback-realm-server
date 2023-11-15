<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use App\View\Helper\HtmlEmailContentHelper;
use App\View\Helper\TextEmailContentHelper;
use BootstrapUI\View\Helper\BreadcrumbsHelper;
use BootstrapUI\View\Helper\FlashHelper;
use BootstrapUI\View\Helper\FormHelper;
use BootstrapUI\View\Helper\HtmlHelper;
use BootstrapUI\View\Helper\PaginatorHelper;
use BootstrapUI\View\UIViewTrait;
use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 * @property-read HtmlHelper $Html
 * @property-read FormHelper $Form
 * @property-read FlashHelper $Flash
 * @property-read PaginatorHelper $Paginator
 * @property-read BreadcrumbsHelper $Breadcrumbs
 *
 * @property-read HtmlEmailContentHelper $HtmlEmailContent
 * @property-read TextEmailContentHelper $TextEmailContent
 */
class AppView extends View
{
    use UIViewTrait;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->layout = 'twbo';
        $this->loadHelper('Html', [
            'className' => 'BootstrapUI.Html',
            'iconDefaults' => [
                'tag' => 'i',
                'namespace' => 'mdi',
                'prefix' => 'mdi',
                'size' => null,
            ],
        ]);
        $this->loadHelper('Form', ['className' => 'BootstrapUI.Form']);
        $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
        $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
        $this->loadHelper('Breadcrumbs', ['className' => 'BootstrapUI.Breadcrumbs']);
        $this->loadHelper('HtmlEmailContent');
        $this->loadHelper('TextEmailContent');
    }
}
