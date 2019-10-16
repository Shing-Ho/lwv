<?php namespace Lwv\SearchModule;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\FilesModule\File\FileModel;
use League\Flysystem\File;

/**
 * Class SearchModuleFunctions
 */
class SearchModuleFunctions
{
    protected $index;

    /**
     * Create a new SearchModuleFunctions instance.
     */
    function __construct()
    {

    }

    /**
     * Create an excerpt based on a search term
     */
    public function excerpt($text, $phrase, $radius = 100, $ending = "...")
    {
        $phraseLen = strlen($phrase);
        if ($radius < $phraseLen) {
            $radius = $phraseLen;
        }

        $phrases = explode (' ',$phrase);

        foreach ($phrases as $phrase) {
            $pos = strpos(strtolower($text), strtolower(' '.$phrase.' '));
            if ($pos > -1) break;
        }

        $startPos = 0;
        if ($pos > $radius) {
            $startPos = $pos - $radius;
        }

        $textLen = strlen($text);

        $endPos = $pos + $phraseLen + $radius;
        if ($endPos >= $textLen) {
            $endPos = $textLen;
        }

        $excerpt = substr($text, $startPos, $endPos - $startPos);
        if ($startPos != 0) {
            $excerpt = substr_replace($excerpt, $ending, 0, $phraseLen);
        }

        if ($endPos != $textLen) {
            $excerpt = substr_replace($excerpt, $ending, -$phraseLen);
        }

        return $excerpt;
    }

    /**
     * Create an excerpt based on a search term
     */
    public function relevantExcerpt($words, $fulltext, $rellength=300, $prevcount=50, $indicator='...') {

        $textlength = strlen($fulltext);

        if($textlength <= $rellength) {
            return $fulltext;
        }

        $locations = $this->extractLocations($words, $fulltext);
        $startpos  = $this->determineSnipLocation($locations,$prevcount);

        if($textlength-$startpos < $rellength) {
            $startpos = $startpos - ($textlength-$startpos)/2;
        }

        $reltext = substr($fulltext, $startpos, $rellength);

        if( $startpos + $rellength < $textlength) {
            $reltext = substr($reltext, 0, strrpos($reltext, " ")).$indicator; // remove last word
        }

        if($startpos != 0) {
            $reltext = $indicator.substr($reltext, strpos($reltext, " ") + 1); // remove first word
        }

        return $reltext;
    }

    private function extractLocations($words, $fulltext) {
        $locations = array();
        foreach($words as $word) {
            $word = ' '.$word.' ';
            $wordlen = strlen($word);
            $loc = stripos($fulltext, $word);
            while($loc !== FALSE) {
                $locations[] = $loc;
                $loc = stripos($fulltext, $word, $loc + $wordlen);
            }
        }

        $locations = array_unique($locations);
        sort($locations);

        return $locations;
    }

    private function determineSnipLocation($locations, $prevcount) {
        // If we have no matches start the snip at the beginning
        if (!count($locations)) {
            return 0;
        }

        $startpos = $locations[0];
        $loccount = count($locations);
        $smallestdiff = PHP_INT_MAX;

        if(count($locations) > 2) {
            for($i=1; $i < $loccount; $i++) {
                if($i == $loccount-1) { // at the end
                    $diff = $locations[$i] - $locations[$i-1];
                }
                else {
                    $diff = $locations[$i+1] - $locations[$i];
                }

                if($smallestdiff > $diff) {
                    $smallestdiff = $diff;
                    $startpos = $locations[$i];
                }
            }
        }

        $startpos = $startpos > $prevcount ? $startpos - $prevcount : 0;
        return $startpos;
    }

}
