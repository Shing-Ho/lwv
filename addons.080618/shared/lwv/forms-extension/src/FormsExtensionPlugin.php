<?php namespace Lwv\FormsExtension;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;


/**
 * Class FormsExtensionPlugin
 */

class FormsExtensionPlugin extends Plugin
{

    public function __construct()
    {
    }

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'form_json',
                function ($form) {
                    $functions = new FormsExtensionFunctions();
                    $json = $functions->setForm($form)->getJSON();

                    return view('lwv.extension.forms::partials/json', compact('form','json'))->render();
                }, ['is_safe' => ['html']]
            ),
        ];
    }
}
