<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


	<!-- NAV HELPER -->
	<nav class="wrap t3-topnav navbar-top <?php $this->_c('topnav') ?>">
		<div class="container">
			<div class="row">

				<?php if ($this->countModules('topnav')) : ?>
					<div class="col-xs-8 col-sm-8">
						<jdoc:include type="modules" name="<?php $this->_p('topnav') ?>" />
					</div>
				<?php endif ?>

				<?php if ($this->countModules('head-search')) : ?>
					<!-- HEAD SEARCH -->
					<div class="col-xs-4 col-sm-4">
						<div class="head-search <?php $this->_c('head-search') ?>">
							<jdoc:include type="modules" name="<?php $this->_p('head-search') ?>" style="raw" />
						</div>
					</div>
					<!-- //HEAD SEARCH -->
				<?php endif ?>

			</div>
		</div>
	</nav>
	<!-- //NAV HELPER -->

