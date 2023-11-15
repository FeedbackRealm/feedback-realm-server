<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\HtmlEmailContentHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\HtmlEmailContentHelper Test Case
 */
class HtmlEmailContentHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var HtmlEmailContentHelper
     */
    protected $HtmlEmailContent;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->HtmlEmailContent = new HtmlEmailContentHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->HtmlEmailContent);

        parent::tearDown();
    }
}
