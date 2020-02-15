<?php 
defined('_JEXEC') or die('Restricted access');

JLoader::register('DefaultViewNavTableBarIconic',JEV_VIEWS."/default/helpers/defaultviewnavtablebariconic.php");

class GeraintViewNavTableBarIconic extends DefaultViewNavTableBarIconic {

	var $view = null;
	
	function __construct($view, $today_date, $view_date, $dates, $alts, $option, $task, $Itemid ){
		//parent::DefaultViewNavTableBarIconic($view, $today_date, $view_date, $dates, $alts, $option, $task, $Itemid);
		$this->view = $view	;
		$this->transparentGif = JURI::root() . "components/".JEV_COM_COMPONENT."/views/".$this->view->getViewName()."/assets/images/transp.gif";
		$this->Itemid = JEVHelper::getItemid();
		$this->cat = $this->view->datamodel->getCatidsOutLink();
		$this->task = $task;
		
		$cfg = JEVConfig::getInstance();
                //Lets check if we should show the nav on event details 
                if ($task == "icalrepeat.detail" && $cfg->get('shownavbar_detail', 1) == 0) { return;}
		
		$this->iconstoshow = $cfg->get('iconstoshow', array('byyear', 'bymonth', 'byweek', 'byday', 'search'));
		
		if (JRequest::getInt( 'pop', 0 )) return;		

        $selected_day = ($this->view == "GeraintViewDay") ? "active" : "";
        $selected_week = ($this->view == "GeraintViewWeek") ? "active" : "";
        $selected_month = ($this->view == "GeraintViewMonth") ? "active" : "";
        $selected_year = ($this->view == "GeraintViewYear") ? "active" : "";
        $selected_today = ($view_date == $today_date) ? "active" : "";
    	?>

    	<div class="ev_navigation">
            <div class="btn-toolbar j-select-display">
                <div class="btn-group " role="group">
                    <?php
                        if (in_array("search", $this->iconstoshow)) echo $this->_viewSearchIcon($view_date);
                        if (in_array("bymonth", $this->iconstoshow)) echo $this->_viewJumptoIcon($view_date);
                    ?>
                </div>
                <div class="btn-group pull-right" role="group">
                    <?php
                        if (in_array("byday", $this->iconstoshow)) echo $this->_viewDayIcon($view_date, $selected_day);
                        if (in_array("byweek", $this->iconstoshow)) echo $this->_viewWeekIcon($view_date, $selected_week);
                        if (in_array("bymonth", $this->iconstoshow)) echo $this->_viewMonthIcon($view_date, $selected_month);
                        if (in_array("byyear", $this->iconstoshow)) echo $this->_viewYearIcon($view_date, $selected_year);
                    ?>
                </div>
            </div>
            <?php
                if (in_array("bymonth", $this->iconstoshow))   echo $this->_viewHiddenJumpto($view_date);
            ?>
            <div class="btn-toolbar j-navigate">
                <?php if($cfg->get('com_calUseIconic', 1) != 2  && $task!="range.listevents"): ?>
                    <div class="btn-group" role="group">
                        <?php 
                            echo $this->_lastYearIcon($dates, $alts);
                            echo $this->_lastMonthIcon($dates, $alts);
                            echo $this->_viewTodayIcon($today_date, $selected_today);
                            echo $this->_nextMonthIcon($dates, $alts);
                            echo $this->_nextYearIcon($dates, $alts);
                        ?> 
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready(function() {
              jQuery('[data-toggle="tooltip"]').tooltip();
            });
            //]]>
        </script>
		<?php    	
	}



    function _genericMonthNavigation($dates, $alts, $which, $icon){
        $cfg = JComponentHelper::getParams(JEV_COM_COMPONENT);
        $task = $this->task;
        $link = 'index.php?option=' . JEV_COM_COMPONENT . '&task=' . $task . $this->cat . '&Itemid=' . $this->Itemid. '&';
        
        $gg = '<i class="fa fa-'.$icon.'"></i>';

        $thelink = '<a class="btn btn-default" href="'.JRoute::_($link.$dates[$which]->toDateURL()).'" data-toggle="tooltip" data-placement="bottom" title="'.$alts[$which].'">'.$gg.'</a>';
        if ($dates[$which]->getYear()>=JEVHelper::getMinYear() && $dates[$which]->getYear()<=$cfg->get('com_latestyear')){
        ?>
        <?php echo $thelink; ?>
        <?php       
        }
    }
    
    function _lastYearIcon($dates, $alts){
        $this->_genericMonthNavigation($dates, $alts, "prev2","angle-double-left");
    }

    function _lastMonthIcon($dates, $alts){
        $this->_genericMonthNavigation($dates, $alts,"prev1","angle-left");
    }

    function _nextMonthIcon($dates, $alts){
        $this->_genericMonthNavigation($dates, $alts,"next1","angle-right");
    }

    function _nextYearIcon($dates, $alts){
        $this->_genericMonthNavigation($dates, $alts,"next2","angle-double-right");
    }

    function _viewYearIcon($today_date,$selected) {
        ?>
            <a class="btn btn-default <?php echo $selected?>" href="<?php echo JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . $this->cat . '&task=year.listevents&'. $today_date->toDateURL() . '&Itemid=' . $this->Itemid );?>" title="<?php echo  JText::_('JEV_VIEWBYYEAR');?>"> 
                Jahr
            </a>
        <?php
    }

    function _viewMonthIcon($today_date,$selected) {
        ?>
            <a class="btn btn-default <?php echo $selected?>" href="<?php echo JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . $this->cat . '&task=month.calendar&'. $today_date->toDateURL() . '&Itemid=' . $this->Itemid );?>" title="<?php echo  JText::_('JEV_VIEWBYMONTH');?>">
                Monat
            </a>
        <?php
    }

    function _viewWeekIcon($today_date,$selected) {
        ?>
            <a class="btn btn-default <?php echo $selected?>" href="<?php echo JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . $this->cat . '&task=week.listevents&'. $today_date->toDateURL() . '&Itemid=' . $this->Itemid );?>" title="<?php echo  JText::_('JEV_VIEWBYWEEK');?>">
                Woche
            </a>
        <?php
    }

    function _viewDayIcon($today_date,$selected) {
        ?>
            <a class="btn btn-default <?php echo $selected?>" href="<?php echo JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . $this->cat . '&task=day.listevents&'. $today_date->toDateURL() . '&Itemid=' . $this->Itemid );?>" title="<?php echo  JText::_('JEV_VIEWTODAY');?>">
                Tag
            </a>
        <?php
    }

    function _viewTodayIcon($today_date,$selected) {
        ?>
            <a class="btn btn-default <?php echo $selected?>" href="<?php echo JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . $this->cat . '&task=day.listevents&'. $today_date->toDateURL() . '&Itemid=' . $this->Itemid );?>" title="<?php echo  JText::_('JEV_VIEWTODAY');?>">
                Heute
            </a>
        <?php
    }

    function _viewSearchIcon($today_date) {
        ?>
            <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom"  href="<?php echo JRoute::_( 'index.php?option=' . JEV_COM_COMPONENT . $this->cat . '&task=search.form&'. $today_date->toDateURL() . '&Itemid=' . $this->Itemid );?>" title="<?php echo  JText::_('JEV_SEARCH_TITLE');?>">
                <i class="fa fa-search"></i>
            </a>          
        <?php
    }

    function _viewJumptoIcon($today_date) {
        ?>
            <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom"  href="#" onclick="if ($('jumpto').hasClass('jev_none')) {$('jumpto').removeClass('jev_none');} else {$('jumpto').addClass('jev_none')};return false;" title="<?php echo   JText::_('JEV_JUMPTO');?>">
                <i class="fa fa-dot-circle-o"></i>
            </a>        
        <?php
    }

    function _viewHiddenJumpto($this_date){
        $cfg = JEVConfig::getInstance();
        $hiddencat  = "";
        if ($this->view->datamodel->catidsOut!=0){
            $hiddencat = '<input type="hidden" name="catids" value="'.$this->view->datamodel->catidsOut.'"/>';
        }
        ?>
            <?php 
            $index = JRoute::_("index.php");
            ?>
            <div id="jumpto"  class="jev_none row">
            <form name="BarNav" action="<?php echo $index;?>" method="get" class="form-inline">
                <input type="hidden" name="option" value="<?php echo JEV_COM_COMPONENT;?>"/>
                <input type="hidden" name="task" value="month.calendar" />
                <?php
                echo $hiddencat;
                /*Day Select*/
                // JEventsHTML::buildDaySelect( $this_date->getYear(1), $this_date->getMonth(1), $this_date->getDay(1), ' class="fs10px"' );
                /*Month Select*/
                JEventsHTML::buildMonthSelect( $this_date->getMonth(1), 'class=""');
                /*Year Select*/
                JEventsHTML::buildYearSelect( $this_date->getYear(1), 'class=""' ); ?>
                <button onclick="submit(this.form)" class="btn btn-primary"><?php echo   JText::_('JEV_JUMPTO');?></button>
                <input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
            </form>
            </div>
        <?php
    }

}