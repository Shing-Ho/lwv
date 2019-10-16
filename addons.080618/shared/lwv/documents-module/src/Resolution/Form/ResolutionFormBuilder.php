<?php namespace Lwv\DocumentsModule\Resolution\Form;

use Lwv\DocumentsModule\Document\Contract\DocumentInterface;
use Lwv\DocumentsModule\Resolution\Contract\ResolutionInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class ResolutionFormBuilder extends FormBuilder
{
    /**
     * The parent document.
     *
     * @var null|ResolutionInterface
     */
    protected $document = null;

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [
        'minutes'
    ];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [
        'save_exit'
    ];

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

    /**
     * Get the parent document.
     *
     * @return null|DocumentInterface
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set the parent document.
     *
     * @param  DocumentInterface $document
     * @return $this
     */
    public function setDocument(DocumentInterface $document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Fired when form is ready to build.
     */
    public function onReady()
    {
        $this->setOption('redirect', 'admin/documents/resolutions/{request.route.parameters.document}');
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving()
    {
        $entry  = $this->getFormEntry();
        $document = $this->getDocument();

        if ($document) {
            $entry->minutes_id = $document->getId();
        }
    }
}
