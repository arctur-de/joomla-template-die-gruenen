<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.html.html.bootstrap');

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->item->params;
?>

<div class="contact<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">
    <?php if ($tparams->get('show_page_heading')) : ?>
        <h1>
            <?php echo $this->escape($tparams->get('page_heading')); ?>
        </h1>
    <?php endif; ?>

    <?php if ($this->contact->image && $tparams->get('show_image')) : ?>
        <div class="item-image article-image-top">
            <?php echo JHtml::_('image', $this->contact->image, $this->contact->name, array('itemprop' => 'image')); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->contact->name && $tparams->get('show_name')) : ?>
        <h1>
            <?php if ($this->item->published == 0) : ?>
                <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
            <?php endif; ?>
            <span class="contact-name" itemprop="name"><?php echo $this->contact->name; ?></span>
        </h1>
    <?php endif; ?>
    <?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
        <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
        <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
    <?php endif; ?>

    <?php if (!empty($this->item->event)) echo $this->item->event->beforeDisplayContent; ?>

    <?php $presentation_style = $tparams->get('presentation_style'); ?>
    <?php $accordionStarted = false; ?>
    <?php $tabSetStarted = false; ?>

    <!-- Slider type -->
    <?php if ($presentation_style === 'sliders') : ?>
        <div class="panel-group" id="slide-contact">

            <?php if ($this->params->get('show_info', 1)) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#slide-contact" href="#basic-details">
                                <?php echo JText::_('COM_CONTACT_DETAILS'); ?>
                            </a>
                        </h4>
                    </div>

                    <div id="basic-details" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
                                <dl class="contact-position dl-horizontal">
                                    <dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
                                    <dd itemprop="jobTitle">
                                        <?php echo $this->contact->con_position; ?>
                                    </dd>
                                </dl>
                            <?php endif; ?>

                            <?php echo $this->loadTemplate('address'); ?>

                            <?php if ($tparams->get('allow_vcard')) : ?>
                                <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
                                    <?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

            <?php endif; ?>
            <!-- // Show info -->

            <?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#slide-contact" href="#display-form">
                                <?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?>
                            </a>
                        </h4>
                    </div>

                    <div id="display-form" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php echo $this->loadTemplate('form'); ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <!-- // Show email form -->

            <?php if ($tparams->get('show_links')) : ?>
                <?php echo $this->loadTemplate('links'); ?>
            <?php endif; ?>

            <?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#slide-contact" href="#display-articles">
                                <?php echo JText::_('JGLOBAL_ARTICLES'); ?>
                            </a>
                        </h4>
                    </div>

                    <div id="display-articles" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php echo $this->loadTemplate('articles'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- // Show articles -->

            <?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#slide-contact" href="#display-profile">
                                <?php echo JText::_('COM_CONTACT_PROFILE'); ?>
                            </a>
                        </h4>
                    </div>

                    <div id="display-profile" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php echo $this->loadTemplate('profile'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- // Show profile -->

            <?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
                <?php echo $this->loadTemplate('user_custom_fields'); ?>
            <?php endif; ?>

            <?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#slide-contact" href="#display-misc">
                                <?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?>
                            </a>
                        </h4>
                    </div>

                    <div id="display-misc" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="contact-miscinfo">
                                <dl class="dl-horizontal">
                                    <dt>
                                        <span class="<?php echo $tparams->get('marker_class'); ?>">
                                            <?php echo $tparams->get('marker_misc'); ?>
                                        </span>
                                    </dt>
                                    <dd>
                                        <span class="contact-misc">
                                            <?php echo $this->contact->misc; ?>
                                        </span>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- // Contact misc -->

        </div>
    <?php endif; ?>
    <!-- //Sliders type -->


    <!-- Tabs type -->
    <?php if ($presentation_style === 'tabs') : ?>

        <?php if ($this->params->get('show_info', 1)) : ?>
            <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'basic-details')); ?>
            <?php $tabSetStarted = true; ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'basic-details', JText::_('COM_CONTACT_DETAILS')); ?>

            <?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
                <dl class="contact-position dl-horizontal">
                    <dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
                    <dd itemprop="jobTitle">
                        <?php echo $this->contact->con_position; ?>
                    </dd>
                </dl>
            <?php endif; ?>

            <?php echo $this->loadTemplate('address'); ?>

            <?php if ($tparams->get('allow_vcard')) : ?>
                <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
                <a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
                    <?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
            <?php endif; ?>

            <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php endif; ?>
        <!-- // Show info -->

        <?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
            <?php if (!$tabSetStarted) {
                echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'display-form'));
                $tabSetStarted = true;
            }
            ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'display-form', JText::_('COM_CONTACT_EMAIL_FORM')); ?>

            <?php echo $this->loadTemplate('form'); ?>

            <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php endif; ?>
        <!-- // Show email form -->

        <?php if ($tparams->get('show_links')) : ?>
            <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>

        <?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
            <?php if (!$tabSetStarted) {
                echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'display-articles'));
                $tabSetStarted = true;
            }
            ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'display-articles', JText::_('JGLOBAL_ARTICLES')); ?>

            <?php echo $this->loadTemplate('articles'); ?>

            <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php endif; ?>
        <!-- // Show articles -->

        <?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
            <?php if (!$tabSetStarted) {
                echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'display-profile'));
                $tabSetStarted = true;
            }
            ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'display-profile', JText::_('COM_CONTACT_PROFILE')); ?>

            <?php echo $this->loadTemplate('profile'); ?>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php endif; ?>
        <!-- // Show profile -->

        <?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
            <?php echo $this->loadTemplate('user_custom_fields'); ?>
        <?php endif; ?>

        <?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
            <?php if (!$tabSetStarted) {
                echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'display-misc'));
                $tabSetStarted = true;
            }
            ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'display-misc', JText::_('COM_CONTACT_OTHER_INFORMATION')); ?>

            <div class="contact-miscinfo">
                <dl class="dl-horizontal">
                    <dt>
                        <span class="<?php echo $tparams->get('marker_class'); ?>">
                            <?php echo $tparams->get('marker_misc'); ?>
                        </span>
                    </dt>
                    <dd>
                        <span class="contact-misc">
                            <?php echo $this->contact->misc; ?>
                        </span>
                    </dd>
                </dl>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php endif; ?>
        <!-- // Contact misc -->

    <?php endif; ?>
    <!-- //Tabs type -->


    <!-- Plain type -->
    <?php if ($presentation_style === 'plain') : ?>

        <?php if ($this->params->get('show_info', 1)) : ?>
            <?php echo '<h3>' . JText::_('COM_CONTACT_DETAILS') . '</h3>'; ?>

            <?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
                <dl class="contact-position dl-horizontal">
                    <dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
                    <dd itemprop="jobTitle">
                        <?php echo $this->contact->con_position; ?>
                    </dd>
                </dl>
            <?php endif; ?>

            <?php echo $this->loadTemplate('address'); ?>

            <?php if ($tparams->get('allow_vcard')) : ?>
                <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
                <a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
                    <?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
            <?php endif; ?>


        <?php endif; ?>
        <!-- // Show info -->

        <?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
            <?php echo '<h3>' . JText::_('COM_CONTACT_EMAIL_FORM') . '</h3>'; ?>

            <?php echo $this->loadTemplate('form'); ?>
        <?php endif; ?>
        <!-- // Show email form -->

        <?php if ($tparams->get('show_links')) : ?>
            <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>

        <?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
            <?php echo '<h3>' . JText::_('JGLOBAL_ARTICLES') . '</h3>'; ?>

            <?php echo $this->loadTemplate('articles'); ?>
        <?php endif; ?>
        <!-- // Show articles -->

        <?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
            <?php echo '<h3>' . JText::_('COM_CONTACT_PROFILE') . '</h3>'; ?>
            <?php echo $this->loadTemplate('profile'); ?>
        <?php endif; ?>
        <!-- // Show profile -->

        <?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
            <?php echo $this->loadTemplate('user_custom_fields'); ?>
        <?php endif; ?>

        <?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
            <?php echo '<h3>' . JText::_('COM_CONTACT_OTHER_INFORMATION') . '</h3>'; ?>
            <div class="contact-miscinfo">
                <dl class="dl-horizontal">
                    <dt>
                        <span class="<?php echo $tparams->get('marker_class'); ?>">
                            <?php echo $tparams->get('marker_misc'); ?>
                        </span>
                    </dt>
                    <dd>
                        <span class="contact-misc">
                            <?php echo $this->contact->misc; ?>
                        </span>
                    </dd>
                </dl>
            </div>
        <?php endif; ?>
        <!-- // Contact misc -->

    <?php endif; ?>
    <!-- //Plain type -->

    <?php if ($accordionStarted) : ?>
        <?php echo JHtml::_('bootstrap.endAccordion'); ?>
    <?php elseif ($tabSetStarted) : ?>
        <?php echo JHtml::_('bootstrap.endTabSet'); ?>
    <?php endif; ?>


    <?php if (!empty($this->item->event)) echo $this->item->event->afterDisplayContent; ?>
</div>