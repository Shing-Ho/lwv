<?php namespace Lwv\NewsModule\Type\Command;

use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Config\Repository;

/**
 * Class CreateTypeStream
 */
class CreateTypeStream
{

    /**
     * The post type instance.
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * Create a new CreateTypeStream instance.
     *
     * @param TypeInterface $type
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * @param StreamRepositoryInterface $streams
     * @param Repository                $config
     */
    public function handle(StreamRepositoryInterface $streams, Repository $config)
    {
        $streams->create(
            [
                $config->get('app.fallback_locale') => [
                    'name'        => $this->type->getName(),
                    'description' => $this->type->getDescription()
                ],
                'namespace'                         => 'news',
                'slug'                              => $this->type->getSlug() . '_posts',
                'locked'                            => false,
                'translatable'                      => true,
                'trashable'                         => false,
                'hidden'                            => true
            ]
        );
    }
}
