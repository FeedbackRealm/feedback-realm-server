<?php
declare(strict_types=1);

namespace App\View\Helper;

/**
 * EmailContent helper interface
 */
interface EmailContentHelperInterface
{
    /**
     * Creates Links
     *
     * @param string $title the title
     * @param string|array $url the url
     * @param array $options options
     * @return string
     */
    public function link(string $title, $url = null, array $options = []): string;

    /**
     * Creates Horizontal Lines
     *
     * @return string
     */
    public function horizontalLine(): string;
}
