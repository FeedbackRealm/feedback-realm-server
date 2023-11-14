<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\TextEmailContentHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\TextEmailContentHelper Test Case
 */
class TextEmailContentHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\TextEmailContentHelper
     */
    protected $TextEmailContent;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->TextEmailContent = new TextEmailContentHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TextEmailContent);

        parent::tearDown();
    }
}
