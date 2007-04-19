<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbCmsTools.class.php 5710 2007-04-19 22:10:58Z pachanga $
 * @package    cms
 */
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('limb/tree/src/tree/lmbMPTree.class.php');

class lmbCmsTools extends lmbAbstractTools
{
  protected $tree;

  function getCmsTree()
  {
    if(is_object($this->tree))
      return $this->tree;

    $this->tree = new lmbMPTree('node');

    return $this->tree;
  }

  function setCmsTree($tree)
  {
    $this->tree = $tree;
  }
}

?>
