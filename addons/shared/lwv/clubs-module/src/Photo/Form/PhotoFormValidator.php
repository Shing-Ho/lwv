<?php namespace Lwv\ClubsModule\Photo\Form;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Ui\Form\Command\SetErrorMessages;
use Anomaly\Streams\Platform\Ui\Form\Command\RepopulateFields;

/**
 * Class PhotoFormValidator
 */
class PhotoFormValidator
{

    use DispatchesJobs;

    /**
     * Validate a form's input.
     *
     * @param PhotoFormBuilder $builder
     */
    public function handle(Request $request, PhotoFormBuilder $builder)
    {
        $factory = app('validator');
        $builder->setFormErrors(new MessageBag());

        // Collect and remove whitespace from input
        $input=array_map('trim',$request->input());

        // Rule groups
        $rules = array(
            'image' => 'required',
        );
        
        $validator = $factory->make($input, $rules, $this->getMessages());
        $this->setResponse($validator, $builder);
    }


    /**
     * Set the response based on validation.
     *
     * @param Validator $validator
     * @param PhotoFormBuilder $builder
     */
    protected function setResponse(Validator $validator, PhotoFormBuilder $builder)
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
            'photo.required' => 'The "Photo" field is required.',
        ];
    }
}
