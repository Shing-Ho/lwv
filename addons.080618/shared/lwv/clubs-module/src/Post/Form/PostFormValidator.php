<?php namespace Lwv\ClubsModule\Post\Form;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Ui\Form\Command\SetErrorMessages;
use Anomaly\Streams\Platform\Ui\Form\Command\RepopulateFields;

/**
 * Class PostFormValidator
 */
class PostFormValidator
{

    use DispatchesJobs;

    /**
     * Validate a form's input.
     *
     * @param PostFormBuilder $builder
     */
    public function handle(Request $request, PostFormBuilder $builder)
    {
        $factory = app('validator');
        $builder->setFormErrors(new MessageBag());

        // Collect and remove whitespace from input
        $input=array_map('trim',$request->input());

        // Rule groups
        $rules = array(
            'title' => 'required',
            'slug' => 'required|unique:clubs_posts,slug,'.$builder->getEntry(),
            'post_type' => 'required',
            'body' => 'required',
            'publish_at' => 'required',
        );
        
        $validator = $factory->make($input, $rules, $this->getMessages());
        $this->setResponse($validator, $builder);
    }


    /**
     * Set the response based on validation.
     *
     * @param Validator $validator
     * @param PostFormBuilder $builder
     */
    protected function setResponse(Validator $validator, PostFormBuilder $builder)
    {
        if (!$validator->passes()) {

            $builder->setSave(false);

            $bag = $validator->getMessageBag();

            foreach ($bag->getMessages() as $field => $messages) {
                foreach ($messages as $message) {
                    $builder->addFormError($field, $message);
                }
            }

            $this->dispatch(new SetErrorMessages($builder));
        }

        $this->dispatch(new RepopulateFields($builder));
    }

    /**
     * Set the custom messages
     */
    protected function getMessages() {
        return [
            'title.required' => 'The "Title" field is required.',
            'slug.required' => 'The "Slug" field is required.',
            'slug.unique' => '"Slug" must be unique.',
            'post_type.required' => 'The "Type" field is required.',
            'body.required' => 'The "Body" field is required.',
            'publish_at.required' => 'The "Publish Date/Time" field is required.',
        ];
    }
}
