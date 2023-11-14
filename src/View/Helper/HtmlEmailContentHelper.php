<?php
declare(strict_types=1);

namespace App\View\Helper;

/**
 * HtmlEmailContent helper
 * Creates HTML based content for emails
 */
class HtmlEmailContentHelper extends EmailContentHelperBase
{
    /**
     * Creates HTML based links
     *
     * @param string $title the title
     * @param string|array $url the url
     * @param array $options options
     * @return string
     */
    public function link(string $title, $url = null, array $options = []): string
    {
        $options['fullBase'] = true;

        return $this->Html->link($title, $url, $options);
    }

    /**
     * Creates HTML based HR
     *
     * @return string
     */
    public function horizontalLine(): string
    {
        return '<hr/>';
    }
}
