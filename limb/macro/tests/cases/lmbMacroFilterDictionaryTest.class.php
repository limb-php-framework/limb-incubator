<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

lmb_require('limb/fs/src/lmbFs.class.php');
lmb_require('limb/macro/src/lmbMacroFilter.class.php');
lmb_require('limb/macro/src/lmbMacroFilterInfo.class.php');
lmb_require('limb/macro/src/lmbMacroFilterDictionary.class.php');

class lmbMacroFilterDictionaryTest extends UnitTestCase
{
  function setUp()
  {
    lmbFs :: rm(LIMB_VAR_DIR . '/filters/');
    lmbFs :: mkdir(LIMB_VAR_DIR . '/filters/');
  }

  function testFindFilterInfo()
  {
    $filter_info = new lmbMacroFilterInfo('testtag', 'SomeFilterClass');
    $dictionary = new lmbMacroFilterDictionary();
    $dictionary->register($filter_info, $file = 'whatever');

    $this->assertIsA($dictionary->findFilterInfo('testtag'), 'lmbMacroFilterInfo');
  }

  function testFindFilterInfoByAlias()
  {
    $filter_info = new lmbMacroFilterInfo('testtag', 'SomeFilterClass');
    $filter_info->setAliases(array('testtag_alias', 'testtag_alias2'));
    $dictionary = new lmbMacroFilterDictionary();
    $dictionary->register($filter_info, $file = 'whatever');

    $this->assertIsA($dictionary->findFilterInfo('testtag'), 'lmbMacroFilterInfo');
    $this->assertIsA($dictionary->findFilterInfo('testtag_alias'), 'lmbMacroFilterInfo');
    $this->assertIsA($dictionary->findFilterInfo('testtag_alias2'), 'lmbMacroFilterInfo');
  }
  

  function testRegisterFilterInfoOnceOnly()
  {
    $dictionary = new lmbMacroFilterDictionary();
    $filter_info1 = new lmbMacroFilterInfo('some_filter', 'SomeFilterClass');
    $filter_info2 = new lmbMacroFilterInfo('some_filter', 'SomeFilterClass');
    $dictionary->register($filter_info1, $file1 = 'whatever1');
    $dictionary->register($filter_info2, $file2 = 'whatever2');

    $this->assertEqual($dictionary->findFilterInfo('some_filter'), $filter_info1);
  }

  function testFilterNotFound()
  {
    $filter_info = new lmbMacroFilterInfo('testtag', 'SomeFilterClass');
    $dictionary = new lmbMacroFilterDictionary();
    $dictionary->register($filter_info, $file = 'whatever');

    $this->assertFalse($dictionary->findFilterInfo('junk'));
  }

  function testRegisterFromFile()
  {
    $rnd = mt_rand();
    $contents = <<<EOD
<?php
/**
 * @filter foo_{$rnd}
 * @aliases foo1_{$rnd}, foo2_{$rnd} 
 */
class Foo{$rnd}Filter extends lmbMacroFilter{}

/**
 * @filter bar_{$rnd}
 */
class Bar{$rnd}Filter extends lmbMacroFilter{}
EOD;
    file_put_contents($file = LIMB_VAR_DIR . '/filters/' . $rnd . '.filter.php', $contents);

    $filter_info1 = new lmbMacroFilterInfo("foo_$rnd", "Foo{$rnd}Filter");
    $filter_info1->setAliases(array("foo1_$rnd", "foo2_$rnd"));
    $filter_info1->setFile($file);
    $filter_info2 = new lmbMacroFilterInfo("bar_$rnd", "Bar{$rnd}Filter");
    $filter_info2->setFile($file);

    $dictionary = new lmbMacroFilterDictionary();
    $dictionary->registerFromFile($file);

    $this->assertEqual($dictionary->findFilterInfo("foo_$rnd"), $filter_info1);
    $this->assertEqual($dictionary->findFilterInfo("foo1_$rnd"), $filter_info1);
    $this->assertEqual($dictionary->findFilterInfo("bar_$rnd"), $filter_info2);
  }
}

