<?php
/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Andreas Gohr <andi@splitbrain.org>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_fontsize2 extends DokuWiki_Action_Plugin {

    /**
     * return some info
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     */
    public function getInfo(){
        return array_merge(confToHash(dirname(__FILE__).'/README'), array('name' => 'Toolbar Component'));
    }

    /**
     * register the eventhandlers
     *
     * @author Andreas Gohr <andi@splitbrain.org>
     */
    public function register(Doku_Event_Handler $controller){
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'fontsize2_toolbar', array ());
    }

    public function fontsize2_toolbar(&$event, $param) {
        $event->data[] = array (
            'type' => 'picker',
            'title' => $this->getLang('fs_picker'),
            'icon' => '../../plugins/fontsize2/images/toolbar/picker.png',
            'list' => array(
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_xxs'),
                    'sample' => $this->getLang('fs_xxs_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/xxs.png',
                    'open'   => '<fs xx-small>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_xs'),
                    'sample' => $this->getLang('fs_xs_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/xs.png',
                    'open'   => '<fs x-small>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_s'),
                    'sample' => $this->getLang('fs_s_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/s.png',
                    'open'   => '<fs small>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_m'),
                    'sample' => $this->getLang('fs_m_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/m.png',
                    'open'   => '<fs medium>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_l'),
                    'sample' => $this->getLang('fs_l_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/l.png',
                    'open'   => '<fs large>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_xl'),
                    'sample' => $this->getLang('fs_xl_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/xl.png',
                    'open'   => '<fs x-large>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_xxl'),
                    'sample' => $this->getLang('fs_xxl_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/xxl.png',
                    'open'   => '<fs xx-large>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_smaller'),
                    'sample' => $this->getLang('fs_smaller_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/smaller.png',
                    'open'   => '<fs smaller>',
                    'close'  => '</fs>',
                ),
                array(
                    'type'   => 'format',
                    'title'  => $this->getLang('fs_larger'),
                    'sample' => $this->getLang('fs_larger_sample'),
                    'icon'   => '../../plugins/fontsize2/images/toolbar/larger.png',
                    'open'   => '<fs larger>',
                    'close'  => '</fs>',
                ),
            )
        );
    }
}

