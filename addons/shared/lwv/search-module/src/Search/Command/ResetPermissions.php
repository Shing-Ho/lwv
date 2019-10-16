<?php namespace Lwv\SearchModule\Search\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class ResetPermissions
 */
class ResetPermissions
{
    use DispatchesJobs;

    /**
     * The index.
     */
    protected $index;

    /**
     * Create a new ResetPermissions instance.
     */
    public function __construct($index)
    {
        $this->index = $index;
    }

    /**
     * Handle the command.
     */
    public function handle(Application $pyro)
    {
        // Reset index permissions
        if (is_dir($path = storage_path())) {
            system('/bin/chown -R nginx:nginx '.$path);
        }

        if (is_dir($path = $pyro->getStoragePath('search/zend/'.$this->index))) {
            chmod($pyro->getStoragePath('search/zend/'.$this->index), 0777);
        }
    }
}
