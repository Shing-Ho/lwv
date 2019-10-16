<?php namespace Lwv\FormsExtension\Command;

use Illuminate\Validation\Factory;

class AddCustomValidators
{
    protected $validator;

    /**
     * SpamValidator constructor.
     *
     * @param Factory $validator
     */
    function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        // Elapsed Time Check
        $this->validator->extend('spam', function($attribute, $value, $parameters) {
            $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');
            $window = $settings->value('lwv.extension.forms::elapsed', 0);

            if ($window == 0) {
                return true;
            }

            $timestamp = base64_decode($value);

            return ((string) (int) $timestamp === $timestamp)
                && ($timestamp <= PHP_INT_MAX)
                && ($timestamp >= ~PHP_INT_MAX)
                && (time()-$timestamp >= $window);

        }, trans('lwv.extension.forms::errors.form_spam_detected'));

        // Phone Number
        $this->validator->extend('phone', function($attribute, $value, $parameters) {
            $digits=preg_replace("/[^0-9]/", "", $value);
            $special=preg_replace("/[0-9+()-]/i", "", $value);

            if (strlen($digits) < 10 || strlen($digits) > 20 || strlen($special)) {
                return FALSE;
            }

            return true;
        }, trans('lwv.extension.forms::errors.form_invalid_phone'));
    }
}
