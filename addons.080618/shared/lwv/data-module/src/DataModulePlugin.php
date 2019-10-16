<?php namespace Lwv\DataModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Lwv\DataModule\Contact\ContactModel;
use Lwv\DataModule\Floorplan\FloorplanModel;
use Lwv\DataModule\Education\EducationModel;
use Lwv\DataModule\Faq\FaqModel;

/**
 * Class DataModulePlugin
 */

class DataModulePlugin extends Plugin
{

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'contact_category_table',
                function ($category) {
                    if ($contacts = ContactModel::where('contact_category',$category)->orderBy('sort_order')->get()) {

                        return view('lwv.module.data::contact/contact_table', compact('contacts'))->render();
                    }
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'contact_list',
                function () {
                    $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');

                    $categories = array_filter(
                        explode("\r\n",trim($settings->value('lwv.module.data::contact_categories', ''))),
                        function ($line) {
                            return trim($line);
                        }
                    );

                    return view('lwv.module.data::contact/contact_accordion', compact('categories'))->render();
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'faqs',
                function () {
                    $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');

                    $categories = array_filter(
                        explode("\r\n",trim($settings->value('lwv.module.data::faq_categories', ''))),
                        function ($line) {
                            return trim($line);
                        }
                    );

                    return view('lwv.module.data::faq/faqs', compact('categories'))->render();
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'faq_category',
                function ($category,$id) {
                    if ($faqs = FaqModel::where('faq_category',$category)->orderBy('sort_order')->get()) {

                        return view('lwv.module.data::faq/faq_category', compact('faqs','category','id'))->render();
                    }
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'floorplans',
                function () {
                    if ($floorplans = FloorplanModel::orderBy('name')->get()) {
                        return view('lwv.module.data::floorplan/floorplans', compact('floorplans'))->render();
                    }
                }
                , ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'classes',
                function ($type) {

                    if ($classes = EducationModel::where('class_type',$type)->orderBy('sort_order')->get()) {
                        $locations = array_unique(
                            array_map(
                                function ($class) {
                                    return $class['clubhouse'];
                                },
                                $classes->toArray()
                            )
                        );

                        return view('lwv.module.data::education/classes', compact('classes','locations'))->render();
                    }
                }
                , ['is_safe' => ['html']]
            ),
        ];
    }
}
