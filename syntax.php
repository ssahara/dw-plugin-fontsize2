<?php
/**
 * FontSize2 Plugin: control the size of your text
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author      Thorsten Stratmann <thorsten.stratmann@web.de>
 * @link          https://wiki.splitbrain.org/plugin:fontsize2
 * @version    0.2
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_fontsize2 extends DokuWiki_Syntax_Plugin {

    // What kind of syntax are we?
    public function getType(){ return 'formatting'; }

    // What kind of syntax do we allow (optional)
    public function getAllowedTypes() {
        return array('formatting', 'substition', 'disabled');
    }

    // What about paragraphs? (optional)
    public function getPType(){ return 'normal'; }

    // Where to sort in?
    public function getSort(){ return 91; }


    // Connect pattern to lexer
    public function connectTo($mode) {
        $this->Lexer->addEntryPattern('(?i)<fs(?: .+?)?>(?=.+</fs>)',$mode,'plugin_fontsize2');
    }
    public function postConnect() {
        $this->Lexer->addExitPattern('(?i)</fs>','plugin_fontsize2');
    }


    // Handle the match
    public function handle($match, $state, $pos, &$handler) {
        switch ($state) {
          case DOKU_LEXER_ENTER : 
            preg_match("/(?i)<fs (.+?)>/", $match, $fs);   // get the fontsize
            if ( $this->_isValid($fs[1]) ) return array($state, $fs[1]);
            break;
          case DOKU_LEXER_MATCHED :
            break;
          case DOKU_LEXER_UNMATCHED :
            return array($state, $match);
            break;
          case DOKU_LEXER_EXIT :
            break;
          case DOKU_LEXER_SPECIAL :
            break;
        }
        return array($state, "1em");
    }

    // Create output
    public function render($mode, &$renderer, $data) {
        if($mode == 'xhtml'){
            list($state, $fs) = $data;
            switch ($state) {
              case DOKU_LEXER_ENTER : 
                $renderer->doc .= "<span style=\"font-size: $fs\">";
                break;
              case DOKU_LEXER_MATCHED :
                break;
              case DOKU_LEXER_UNMATCHED :
                $renderer->doc .= $renderer->_xmlEntities($fs);
                break;
              case DOKU_LEXER_EXIT :
                $renderer->doc .= "</span>";
                break;
              case DOKU_LEXER_SPECIAL :
                break;
            }
            return true;
        }
        return false;
    }

    protected function _isValid($c) {
        $c = trim($c);
        $pattern = "/
          ^([0-9]{1,4})\.[0-9](em|ex|px|%)|^([0-9]{1,4}(em|ex|px|%))|^(xx-small|x-small|small|medium|large|x-large|xx-large)
                              /x";
        if (preg_match($pattern, $c)) return true;
    }
}
