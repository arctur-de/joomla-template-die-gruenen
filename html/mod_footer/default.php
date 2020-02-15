<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_footer
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="module">
	<small><?php echo $lineone; ?> Designed by <a href="http://www.arctur.de/" title="Besuche Arctur.de!" <?php echo method_exists('T3', 'isHome') && T3::isHome() ? '' : 'rel="nofollow"' ?>>Arctur.de</a>.</small>
	<small><?php echo JText::_( 'MOD_FOOTER_LINE2' ); ?></small>
</div>