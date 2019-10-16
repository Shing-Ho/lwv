<?php namespace Lwv\BlocksModule\Block;

use Illuminate\Database\Eloquent\Model;
use Anomaly\PagesModule\Page\PageModel;
use Carbon\Carbon;

class BlockModel extends Model
{
    public function updateWeight($table,$id,$weight) {
        return $this->setTable($table)->where('id', $id)->update(['weight' => $weight]);
    }

    public function touchPage($id) {
        $pages = new PageModel();
        $page = $pages->find($id);
        $page->home = $page->isHome() ? 1 : 0;
        $page->updated_at = Carbon::now();
        $page->save();
        //return $this->setTable('pages_pages')->where('id', $id)->update(['updated_at' => Carbon::now()]);
    }
}
