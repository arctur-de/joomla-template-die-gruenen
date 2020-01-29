<?php 
defined('_JEXEC') or die('Restricted access');

$cfg	 = JEVConfig::getInstance();

if ($cfg->get("tooltiptype",'overlib')=='overlib'){
	JEVHelper::loadOverlib();
}

$view =  $this->getViewName();
echo $this->loadTemplate('cell' );
$eventCellClass = "EventCalendarCell_".$view;
    ?>
        <table width="100%" align="center" border="0" cellspacing="1" cellpadding="0" class="cal_table">
            <tr valign="top">
                <td width='15px' class="cal_td_daysnames"/></td>
                <td colspan="7"  align="center" class="cal_td_daysnames">
                    <?php echo $this->data['fieldsetText']; ?>
                </td>
            </tr>
            <tr valign="top">
            	<td width='2%' class="cal_td_daysnames_2"/>
                <?php foreach ($this->data["daynames"] as $dayname) { ?>
                    <td width="14%" align="center" class="cal_td_daysnames_2">
                        <?php 
                        echo $dayname;?>
                    </td>
                    <?php
                } ?>
            </tr>
            <?php
            $datacount = count($this->data["dates"]);
            $dn=0;
            for ($w=0;$w<6 && $dn<$datacount;$w++){
            ?>
			<tr class="vtop h80px">
                <?php
                echo "<td width='2%' class='cal_td_weeklink'>";
                list($week,$link) = each($this->data['weeks']);
                echo "<a href='".$link."'>$week</a></td>\n";
                for ($d=0;$d<7 && $dn<$datacount;$d++){
                	$currentDay = $this->data["dates"][$dn];
                	switch ($currentDay["monthType"]){
                		case "prior":
                		case "following":
                		?>
                    <td class="cal_td_daysoutofmonth">
                        <?php echo $currentDay["d"]; ?>
                    </td>
                    	<?php
                    	break;
                		case "current":
                			$cellclass = $currentDay["today"]?'class="cal_td_today"':(count($currentDay["events"])>0?'class="cal_td_dayshasevents"':'class="cal_td_daysnoevents"');
                			//$cellclass = $currentDay["today"]?'class="cal_td_today"':'class="cal_td_daysnoevents"';

						?>
                    <td <?php echo $cellclass;?>>
                     <?php   $this->_datecellAddEvent($this->year, $this->month, $currentDay["d"]);?>
                    	<a class="cal_daylink" href="<?php echo $currentDay["link"]; ?>" title="<?php echo JText::_('JEV_CLICK_TOSWITCH_DAY'); ?>"><?php echo $currentDay['d']; ?></a>
                        <?php

                        if (count($currentDay["events"])>0){
                        	foreach ($currentDay["events"] as $key=>$val){
                        		if( $currentDay['countDisplay'] < $cfg->get('com_calMaxDisplay',5)) {
                        			echo '<div class="b0 w100">';
                        		} else {
                        			// float small icons left
                        			echo '<div class="b0 fleft">';
                        		}
                        		echo "\n";
                        		$ecc = new $eventCellClass($val,$this->datamodel, $this);
                        		echo $ecc->calendarCell($currentDay,$this->year,$this->month,$key);
                        		echo '</div>' . "\n";
                        		$currentDay['countDisplay']++;
                        	}
                        }
                        echo "</td>\n";
                        break;
                	}
                	$dn++;
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
            $this->eventsLegend();

