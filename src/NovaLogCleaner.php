<?php

namespace Amidesfahani\NovaLogCleaner;

use Laravel\Nova\Card;

class NovaLogCleaner extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Sets the default driver to the card meta.
     *
     * @return $this
     */
    public function setLogMeta()
    {
        return $this->withMeta([
            'logSize' => CleanerHelpers::getFileLogSize()
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        $this->setLogMeta();
        return 'nova-log-cleaner';
    }
}
