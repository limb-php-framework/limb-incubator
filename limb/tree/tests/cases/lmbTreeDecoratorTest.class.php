<?php
/**
 * Limb Web Application Framework
 *
 * @link http://limb-project.com
 *
 * @copyright  Copyright &copy; 2004-2007 BIT
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 * @version    $Id: lmbTreeDecoratorTest.class.php 5732 2007-04-20 20:07:28Z pachanga $
 * @package    tree
 */
lmb_require('limb/tree/src/lmbTreeDecorator.class.php');
lmb_require('limb/tree/src/lmbMPTree.class.php');
lmb_require(dirname(__FILE__) . '/lmbTreeTestBase.class.php');

class TreeTestVersionForDecorator extends lmbMPTree
{
  function __construct()
  {
    parent :: __construct('test_materialized_path_tree');
  }
}

class lmbTreeDecoratorTest extends lmbTreeTestBase
{
  protected $_node_table = 'test_materialized_path_tree';

  function _createTreeImp()
  {
    return new lmbTreeDecorator(new TreeTestVersionForDecorator());
  }

  function _cleanUp()
  {
    $this->db->delete($this->_node_table);
  }
}
?>