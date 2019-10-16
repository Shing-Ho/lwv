<?php namespace Lwv\FormsExtension;


/**
 * Class FormsExtensionFunctions
 */
class FormsExtensionFunctions
{
    /**
     * The form
     */
    protected $form;

    /**
     * Create a new FormsExtensionFunctions instance.
     */
    function __construct() {

    }

    /**
     * Get the form.
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set the form.
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    public function getJSON() {
        $paths = app('Anomaly\Streams\Platform\Asset\AssetPaths');
        $json = file_get_contents($paths->realPath("lwv.extension.forms::js/".$this->form.".json"));

        return ($json);
    }

    public function getConfig() {
        $paths = app('Anomaly\Streams\Platform\Asset\AssetPaths');
        $json = file_get_contents($paths->realPath("lwv.extension.forms::js/".$this->form.".json"));

        return (json_decode($json,true));
    }

    public function getCategory($category) {
        $config = $this->getConfig();

        return (isset($config[$category])) ? $config[$category] : false;
    }

    public function getFields($category) {
        $config = $this->getConfig();

        return (isset($config[$category]['fields'])) ? $config[$category]['fields'] : [];
    }

    public function getRequired($category) {
        $config = $this->getConfig();

        return (isset($config[$category]['required'])) ? $config[$category]['required'] : [];
    }

    public function getRules($category) {
        $config = $this->getConfig();

        return (isset($config[$category]['rules'])) ? $config[$category]['rules'] : [];
    }

    public function getFieldConfig($category, $field = null) {
        $config = $this->getCategory($category);

        // Check return for valid data
        if (!isset($config['config'])) { return false; }

        if ($field && !isset($config['config'][$field])) { return false; }

        return ($field) ? $config['config'][$field] : $config['config'];
    }


}