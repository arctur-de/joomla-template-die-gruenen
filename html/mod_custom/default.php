<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php
	$imagedefined = "noimage";
	$modulelink = $params->get('module_link');
?>

<div class="sidebar-image custom<?php echo $moduleclass_sfx ?>">
	<?php if ($params->get('backgroundimage')) : ?>
		<?php if ($modulelink != "") : ?><a href="<?php echo $modulelink; ?>"><?php endif;?>
			<img src="<?php echo $params->get('backgroundimage');?>">
		<?php if ($modulelink != "") : ?></a><?php endif;?>
		<?php $imagedefined = "";?>
	<?php endif;?>
	<div class="module-text <?php echo $imagedefined;?>">
		<?php echo $module->content;?>
	</div>
</div>
