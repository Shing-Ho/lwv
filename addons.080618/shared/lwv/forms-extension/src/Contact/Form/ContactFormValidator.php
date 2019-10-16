<?php namespace Lwv\FormsExtension\Contact\Form;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Ui\Form\Command\SetErrorMessages;
use Anomaly\Streams\Platform\Ui\Form\Command\RepopulateFields;
use Lwv\FormsExtension\Command\AddCustomValidators;
use Lwv\FormsExtension\FormsExtensionFunctions;

/**
 * Class ContactFormValidator
 */
class ContactFormValidator
{

    use DispatchesJobs;

    /**
     * Validate a form's input.
     *
     * @param Request $request
     * @param ContactFormBuilder $builder
     */
    public function handle(Request $request, ContactFormBuilder $builder)
    {
        $factory = app('validator');
        $builder->setFormErrors(new MessageBag());
        $this->dispatch(new AddCustomValidators($factory));
        $functions = new FormsExtensionFunctions();

        // Collect and remove whitespace from input
        $input = $request->input();

        foreach (array_keys($input) as $key) {
            $input[$key] = (is_array($input[$key])) ? $input[$key] : trim($input[$key]);
        }

        // Rule groups
        $rules = array_merge(
            $functions->setForm('contact')->getRules($input['interest']),
            ['spam' => 'spam']
        );

        $validator = $factory->make($input, $rules, $this->getMessages());
        $this->setResponse($validator, $builder);
    }


    /**
     * Set the response based on validation.
     *
     * @param Validator $validator
     * @param ContactFormBuilder $builder
     */
    protected function setResponse(Validator $validator, ContactFormBuilder $builder)
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
            'first_name.required' => trans('lwv.extension.forms::errors.form_invalid_name'),
            'last_name.required' => trans('lwv.extension.forms::errors.form_invalid_name'),
            'email.required' => trans('lwv.extension.forms::errors.form_invalid_email'),
            'email.email' => trans('lwv.extension.forms::errors.form_invalid_email'),
            'phone.required' => trans('lwv.extension.forms::errors.form_invalid_phone'),
            'message.required' => trans('lwv.extension.forms::errors.form_invalid_message'),
            'subscribe.required' => trans('lwv.extension.forms::errors.form_invalid_subscribe'),
            'service.required' => trans('lwv.extension.forms::errors.form_invalid_service'),
            'manor.required' => trans('lwv.extension.forms::errors.form_invalid_manor'),
            'address.required' => trans('lwv.extension.forms::errors.form_invalid_address'),
            'ad_phone.required' => trans('lwv.extension.forms::errors.form_invalid_phone'),
            'ad_type.required' => trans('lwv.extension.forms::errors.form_invalid_ad_type'),
            'ad_description.required' => trans('lwv.extension.forms::errors.form_invalid_ad_description'),
        ];
    }
}
