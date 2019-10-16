<?php namespace Lwv\ClubsModule\Club;

use Lwv\ClubsModule\Club\Contract\ClubInterface;
use Anomaly\Streams\Platform\Model\Clubs\ClubsClubsEntryModel;

class ClubModel extends ClubsClubsEntryModel implements ClubInterface
{
    /**
     * Get the associated website for this club
     */
    public function microsite()
    {
        $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');
        $module    = $settings->value('lwv.module.clubs::module_root', 'clubs');
        return '/'.$module.'/'.$this->slug;
    }

    public function preview()
    {
        $settings = app('Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface');
        $module    = $settings->value('lwv.module.clubs::module_root', 'clubs');
        return '/'.$module.'/preview/'.$this->slug;
    }

    /**
     * Get the associated website for this club
     */
    public function website()
    {
        return $this->hasOne('Lwv\ClubsModule\Website\WebsiteModel','club_id','id');
    }

    /**
     * Get the associated documents for this club
     */
    public function documents()
    {
        return $this->hasMany('Lwv\ClubsModule\Document\DocumentModel','club_id','id');
    }

    /**
     * Get the associated photos for this club
     */
    public function photos()
    {
        return $this->hasMany('Lwv\ClubsModule\Photo\PhotoModel','club_id','id');
    }
}
