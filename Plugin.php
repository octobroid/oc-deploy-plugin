<?php namespace Octobro\Deploy;

use System\Classes\PluginBase;

/**
 * Deploy Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Deploy',
            'description' => 'Auto deploy plugin.',
            'author'      => 'Octobro',
            'icon'        => 'icon-flash'
        ];
    }
}
