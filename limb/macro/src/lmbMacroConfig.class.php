<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * class lmbMacroConfig.
 *
 * @package macro
 * @version $Id$
 */
class lmbMacroConfig
{
  protected $cache_dir;
  protected $is_force_scan;
  protected $is_force_compile;
  protected $tags_scan_dirs = array();
  protected $tpl_scan_dirs = array();

  function __construct($cache_dir = null, $is_force_compile = true, $is_force_scan = true,
                       $tpl_scan_dirs = null, $tags_scan_dirs = null, $filters_scan_dirs = null)
  {
    $this->cache_dir = $cache_dir ? $cache_dir : LIMB_VAR_DIR . '/compiled';
    $this->is_force_compile = $is_force_compile;
    $this->is_force_scan = $is_force_scan;
    $this->tpl_scan_dirs = $tpl_scan_dirs ? $tpl_scan_dirs : array('templates');
    $this->tags_scan_dirs = $tags_scan_dirs ? $tags_scan_dirs : array('limb/macro/src/tags');
    $this->filters_scan_dirs = $filters_scan_dirs ? $filters_scan_dirs : array('limb/macro/src/filters');
  }

  function getCacheDir()
  {
    return $this->cache_dir;
  }

  function isForceScan()
  {
    return $this->is_force_scan;
  }

  function isForceCompile()
  {
    return $this->is_force_compile;
  }

  function getTagsScanDirectories()
  {
    return $this->tags_scan_dirs;
  }

  function getFiltersScanDirectories()
  {
    return $this->filters_scan_dirs;
  }

  function getTemplateScanDirectories()
  {
    return $this->tpl_scan_dirs;
  }
}

