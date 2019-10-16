<?php namespace Lwv\BlocksModule\Block;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlocksModule\Block\Command\BuildBlocks;
use Lwv\BlocksModule\Block\Command\HydrateBlocks;
use Lwv\BlocksModule\Block\Command\RenderBlocks;
use App;
use Auth;
use Cache;

class BlockService
{
    use DispatchesJobs;

    /**
     * Installed Block Types
     *
     * @var ExtensionCollection
     */
    protected $types;

    /**
     * The View Template
     *
     * @var ViewTemplate
     */
    protected $template;

    /**
     * Page
     *
     * @var PageModel
     */
    protected $page;

    /**
     * Blocks
     *
     * @var array
     */
    protected $blocks;

    /**
     * Cache Key
     *
     * @var string
     */
    protected $cacheKey;


    protected $eloquent;


    public function __construct()
    {
        $this->setTypes();
    }


    /**
     * Set installed block types
     *
     * @param ExtensionCollection $extensions
     */
    public function setTypes()
    {
        $extensions = app('Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection');
        $this->types = $extensions->search('lwv.module.blocks::block.*')->installed();
    }

    /**
     * Get installed block types
     *
     * @return ExtensionCollection
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Get block type by slug
     */
    public function getTypeBySlug($slug)
    {
        foreach ($this->getTypes() as $type) {
            if ($type->slug == $slug) {
                return($type);
            }
        }

        return false;
    }


    /**
     * Build blocks for page
     *
     * @param PageModel $page
     */
    public function build(PageModel $page) {
        $this->page = $page;
        $this->cacheKey = 'page_'.$page->id.'-'.strtotime($page->updated_at ?: $page->created_at);
        $this->dispatch(new BuildBlocks($this));
    }

    /**
     * Copy block
     *
     * @param $type
     * @param $id
     * @param PageModel $page
     * @return bool
     */
    public function copy($block_type, $id, PageModel $page) {
        $extension = $this->getTypeBySlug($block_type);
        $blockModel = new $extension->model();
        $model = new BlockModel();

        if ($block=$model->setTable($blockModel->getTableName())->find($id)) {
            // Copy block entry
            $copy = $block->replicate();
            $copy->page = $page->id;
            $copy->weight = 0;
            $copy->setTable($blockModel->getTableName())->save();

            if (isset($copy->css)) {
                $copy->block_id = $copy->block_id.'-'.$copy->id;
                $copy->css = str_replace($block->block_id,$copy->block_id,$copy->css);
            }

            $copy->setTable($blockModel->getTableName())->save();

            // Copy Translations
            if ($blockModel->isTranslatable()) {
                foreach ($model->setTable($blockModel->getTranslationTableName())->where('entry_id','=',$block->id)->get() as $translation) {
                    $tcopy = $translation->replicate();
                    $tcopy->entry_id = $copy->id;
                    $tcopy->setTable($blockModel->getTranslationTableName())->save();
                }
            }

            // Copy related stream entries
            if (!isset($extension->related)) {
                return true;
            }

            foreach ($extension->related as $relatedModel) {
                $blockModel = new $relatedModel();

                foreach ($model->setTable($blockModel->getTableName())->where('block',$block->id)->get() as $related) {
                    // Copy related entry
                    $copyRelated = $related->replicate();
                    $copyRelated->block = $copy->id;
                    $copyRelated->setTable($blockModel->getTableName())->save();

                    if ($blockModel->isTranslatable()) {
                        foreach ($model->setTable($blockModel->getTranslationTableName())->where('entry_id','=',$related->id)->get() as $translation) {
                            $tcopyRelated = $translation->replicate();
                            $tcopyRelated->entry_id = $copyRelated->id;
                            $tcopyRelated->setTable($blockModel->getTranslationTableName())->save();
                        }
                    }
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Get Page
     *
     * @return null|PageModel
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * Get blocks
     *
     * @return array
     */
    public function getBlocks() {
        return $this->blocks;
    }

    /**
     * Set blocks
     *
     * @param array $blocks
     */
    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * Get cache key
     *
     * @return string
     */
    public function getCacheKey()
    {
        return $this->cacheKey;
    }

    /**
     * Set cache key
     * @param string $cacheKey
     */
    public function setCacheKey($cacheKey)
    {
        $this->cacheKey = $cacheKey;
    }

    public function setBlockValues($key, array $values) {
        $this->blocks[$key] = array_merge($this->blocks[$key],$values);
    }

    public function allowCache() {
        $authorizer = app('Anomaly\Streams\Platform\Support\Authorizer');
        return (App::runningInConsole() || $authorizer->authorize('anomaly.module.pages::pages.write') || preg_match('/admin/',$_SERVER['SERVER_NAME']))? false : true;
    }

    /**
     * Hydrate blocks
     */
    public function hydrate() {
        $this->dispatch(new HydrateBlocks($this));
    }

    /**
     * Render blocks
     */
    public function render() {
        $this->dispatch(new RenderBlocks($this));
    }
}