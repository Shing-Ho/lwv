<?php namespace Lwv\BlockTextExtension\Block\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class BlockFormBuilder extends FormBuilder
{

    protected $pid;

    public function setPage($pid) {
        $this->pid = $pid;
        $this->fields['page']['value'] = $pid;
    }

    public function getPage() {
        return $this->pid;
    }

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [
        'title',
        'block_id',
        'layout',
        'alignment',
        'block_title',
        'body',
        'css',
        'cache_enabled',
        'page' => [
            'hidden' => true
        ],
    ];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

}
