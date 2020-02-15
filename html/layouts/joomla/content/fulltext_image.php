<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$params  = $displayData['params'];
$item  = $displayData['item'];
$images = json_decode($item->images);
if (empty($images->image_fulltext)) return ;

$imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext;
?>

	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image article-image article-image-full">
		<img
			<?php if ($images->image_fulltext_caption): ?>
				<?php echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_fulltext_caption) . '"'; ?>
			<?php endif; ?>
			src="<?php echo htmlspecialchars($images->image_fulltext); ?>"
			alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/>
	</div>

