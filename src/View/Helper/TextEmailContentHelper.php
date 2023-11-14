<?php
declare(strict_types=1);

namespace App\View\Helper;

/**
 * TextEmailContent helper
 */
class TextEmailContentHelper extends EmailContentHelperBase
{
    /**
     * Creates Text based links
     *
     * @param string $title the title
     * @param string|array $url the url
     * @param array $options options
     * @return string
     */
    public function link(string $title, $url = null, array $options = []): string
    {
        $options['fullBase'] = true;

        return sprintf('%s ==> %s', $title, $this->Url->build($url, $options));
    }

    /**
     * Creates Text based HR
     *
     * @return string
     */
    public function horizontalLine(): string
    {
        return "\n" . str_repeat('=', 32) . "\n";
    }
}
