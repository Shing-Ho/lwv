<?php namespace Lwv\NewsModule\Type\Table;

use Lwv\NewsModule\Type\Contract\TypeInterface;

/**
 * Class TypeTableButtons
 */
class TypeTableButtons
{

    /**
     * Handle the buttons.
     *
     * @param TypeTableBuilder $builder
     */
    public function handle(TypeTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'edit',
                'assignments' => [
                    'href' => function (TypeInterface $entry) {
                        return '/admin/news/fields/assignments/' . $entry->getEntryStreamId();
                    },
                ],
            ]
        );
    }
}
