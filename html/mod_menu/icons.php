<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.

$class_sfx = htmlspecialchars($params->get('class_sfx'));

$is_navbar = strpos(' ' . $class_sfx . ' ', ' navbar-nav ') !== false;

?>
<ul class="nav nav-icon <?php echo ($is_navbar ? '' : ' nav-stacked '), $class_sfx;?>"<?php
	$tag = '';
	if ($params->get('tag_id') != null)
	{
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
if (is_array($list)) :
	foreach ($list as $i => &$item) :
        $class = 'item-'.$item->id;
        $class .= ' fa '.$item->anchor_css.' fa-stack-1x fa-inverse';
		if ($item->id == $active_id) {
			$class .= ' current';
		}

		if (in_array($item->id, $path)) {
			$class .= ' active';
		}
		elseif ($item->type == 'alias') {
			$aliasToId = $item->params->get('aliasoptions');
			if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
				$class .= ' active';
			}
			elseif (in_array($aliasToId, $path)) {
				$class .= ' alias-parent-active';
			}
        }

		if (!empty($class)) {
			$class = ' class="'.trim($class) .'"';
		}

        echo '<li>';
        $target = $item->browserNav ? 'target="_blank"' : "";
        echo '<a href="'.$item->link.'" '.$target.'><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i'.$class.' title="'.$item->title.'"></i></a>';

        echo '</li>';
	endforeach;
endif;
?></ul>
