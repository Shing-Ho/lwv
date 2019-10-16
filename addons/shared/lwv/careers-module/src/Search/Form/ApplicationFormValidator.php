<?php namespace Lwv\CareersModule\Search\Form;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Ui\Form\Command\SetErrorMessages;
use Anomaly\Streams\Platform\Ui\Form\Command\RepopulateFields;
use Lwv\FormsExtension\Command\AddCustomValidators;

/**
 * Class ApplicationFormValidator
 */
class ApplicationFormValidator
{

    use DispatchesJobs;

    /**
     * Validate a form's input.
     *
     * @param ApplicationFormBuilder $builder
     */
    public function handle(Request $request, ApplicationFormBuilder $builder)
    {
        $factory = app('validator');
        $builder->setFormErrors(new MessageBag());
        $this->dispatch(new AddCustomValidators($factory));

        // Collect and remove whitespace from input
        $input=array_map('trim',$request->input());

        // Rule groups
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|phone',
            'spam' => 'spam',
        );
        
        $validator = $factory->make($input, $rules, $this->getMessages());
        $this->setResponse($validator, $builder);
    }


    /**
     * Set the response based on validation.
     *
     * @param Validator $validator
     * @param ApplicationFormBuilder $builder
     */
    protected function setResponse(Validator $validator, ApplicationFormBuilder $builder)
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
            'name.required' => trans('lwv.module.careers::errors.form_invalid_name'),
            'email.required' => trans('lwv.module.careers::errors.form_invalid_email'),
            'email.email' => trans('lwv.module.careers::errors.form_invalid_email'),
            'phone.required' => trans('lwv.module.careers::errors.form_invalid_phone'),
        ];
    }
}
