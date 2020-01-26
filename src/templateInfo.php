<?php
/** 
 *------------------------------------------------------------------------------
 * @package       T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       JoomlArt, JoomlaBamboo, (contribute to this project at github 
 *                & Google group to become co-author)
 * @Google group: https://groups.google.com/forum/#!forum/t3fw
 * @Link:         http://t3-framework.org 
 *------------------------------------------------------------------------------
 */

 
// no direct access
defined('_JEXEC') or die;
?>

<div class="span4 col-md-4">
	<div class="tpl-preview">
		<img src="<?php echo T3_TEMPLATE_URL ?>/template_preview.png" alt="Template Preview"/>
	</div>
</div>
<div class="span8 col-md-8">
	<div class="t3-admin-overview-header">
		<h2>
			<?php echo JText::_('B\'90/DIE GRÜNEN T3 Template') ?>
			<small><?php echo JText::_('Das Joomla Template für GRÜNE Websiten') ?></small>
		</h2>
		<p><?php echo JText::_('powered by ') ?><a href="http://www.arctur.de/cms/">Arctur</a></p>
	</div>
	<div class="t3-admin-overview-body">
		<h4><?php echo JText::_('Features') ?></h4>
	    <ul class="t3-admin-overview-features">
	      <li><?php echo JText::_('Aktuell') ?></li>
	      <li><?php echo JText::_('Responsiv') ?></li>
	      <li><?php echo JText::_('GRÜN!') ?></li>
	    </ul>
	</div>
</div>