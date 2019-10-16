<?php namespace Lwv\NewsModule\Post\Form;

use Lwv\NewsModule\Entry\Form\EntryFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class PostEntryFormBuilder
 */
class PostEntryFormBuilder extends MultipleFormBuilder
{

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [
        'cancel',
        'view' => [
            'enabled' => 'edit',
            'target'  => '_blank',
            'href'    => 'admin/news/view/{request.route.parameters.id}',
        ],
    ];

    /**
     * Fired after the entry form is saved.
     *
     * After the entry form is saved take the
     * entry and use it to populate the post
     * before it saves directly after.
     *
     * @param EntryFormBuilder $builder
     */
    public function onSavedEntry(EntryFormBuilder $builder)
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('post');

        $post = $form->getFormEntry();

        $entry = $builder->getFormEntry();

        $post->entry_id   = $entry->getId();
        $post->entry_type = get_class($entry);
    }

    /**
     * Get the contextual entry ID.
     *
     * @return int|mixed|null
     */
    public function getContextualId()
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('post');

        return $form->getContextualId();
    }
}
