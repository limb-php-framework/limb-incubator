<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: calendar.tag.php 5841 2007-05-08 16:34:34Z pachanga $
 * @package    calendar
 */
require_once('limb/wact/src/tags/form/input.tag.php');
require_once('limb/calendar/src/lmbCalendarWidget.class.php');

/**
* @tag datetime,limb:CALENDAR
* @forbid_end_tag
*/
class lmbCalendarTag extends WactInputTag
{
  function getRenderedTag()
  {
    return 'input';
  }

  function prepare()
  {
    $this->setAttribute('type', 'text');
    parent :: prepare();
  }

  function generateContents($code)
  {
    if(!$lang = $this->getAttribute('lang'))
      $lang = 'en';

    $widget = new lmbCalendarWidget($lang);

    if($format = $this->getAttribute('format'))
    {
      $widget->setOption('ifFormat', $format);
      $widget->setOption('daFormat', $format);
    }
    else
    {
      $widget->setOption('ifFormat', '%Y-%m-%d %H:%M');
      $widget->setOption('daFormat', '%Y-%m-%d %H:%M');
    }

    $code->writeHTML($widget->loadFiles() .
                     $widget->makeButton($this->getAttribute('id')));

    parent :: generateContents($code);
  }

}

?>