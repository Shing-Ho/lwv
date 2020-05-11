<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Search
 */

namespace ZendSearch\Lucene\Analysis\Analyzer\Common;

use ZendSearch\Lucene\Analysis;

/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage Analysis
 */
class TextNum extends AbstractCommon
{
    /**
     * Current position in a stream
     *
     * @var integer
     */
    private $_position;

    /**
     * Reset token stream
     */
    public function reset()
    {
        $this->_position = 0;

        if ($this->_input === null) {
            return;
        }

        if($this->_encoding == "UTF-8")
        {
            $this->_input = mb_convert_encoding($this->_input, 'UTF-8', 'UTF-8');    
        }


        // convert input into ascii
        if (PHP_OS != 'AIX') {
            $this->_input = iconv(mb_detect_encoding($this->_input, mb_detect_order(), false), 'UTF-8//IGNORE', $this->_input);
        }
        $this->_encoding = 'UTF-8';
    }

    /**
     * Tokenization stream API
     * Get next token
     * Returns null at the end of stream
     *
     * @return \ZendSearch\Lucene\Analysis\Token|null
     */
    public function nextToken()
    {
        if ($this->_input === null) {
            return null;
        }

        do {
            // ITInnovative.  Allow plus and dash characters in search
            if (! preg_match('/[a-zA-Z0-9-+]+/', $this->_input, $match, PREG_OFFSET_CAPTURE, $this->_position)) {
                // It covers both cases a) there are no matches (preg_match(...) === 0)
                // b) error occured (preg_match(...) === FALSE)
                return null;
            }

            $str = $match[0][0];
            $pos = $match[0][1];
            $endpos = $pos + strlen($str);

            $this->_position = $endpos;

            $token = $this->normalize(new Analysis\Token($str, $pos, $endpos));
        } while ($token === null); // try again if token is skipped

        return $token;
    }
}

