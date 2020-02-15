<?php 
defined('_JEXEC') or die('Restricted access');

function DefaultViewEventRowNew($view,$row,$args="") {

	$cfg = JEVConfig::getInstance();
	$jinput = JFactory::getApplication()->input;
	$rowlink = $row->viewDetailLink($row->yup(),$row->mup(),$row->dup(),false);
	$rowlink = JRoute::_($rowlink.$view->datamodel->getCatidsOutLink());

	// I choost not to use $row->fgcolor
	$fgcolor="inherit";
	$tmpTitle = $row->title();

	/*
	// [mic] if title is too long, cut 'em for display
	if( JString::strlen( $row->title() ) >= 50 ){
		$tmpTitle = JString::substr( $row->title(), 0, 50 ) . ' ...';
	}
	*/

	$jevtask  = $jinput->getString("jevtask");
	$jevtask = str_replace(".listevents","",$jevtask);

	$showyeardate = $cfg->get("showyeardate",0);

	$times = "";
	if (($showyeardate && $jevtask=="year") || $jevtask=="search.results" || $jevtask=="cat"  || $jevtask=="range"){

		$start_publish  = $row->getUnixStartDate();
		$stop_publish  = $row->getUnixEndDate();

		$start_date	= JEventsHTML::getDateFormat( $row->yup(), $row->mup(), $row->dup(), 0 );
		$start_time = JEVHelper::getTime($row->getUnixStartTime(),$row->hup(),$row->minup());

		$stop_date	= JEventsHTML::getDateFormat(  $row->ydn(), $row->mdn(), $row->ddn(), 0 );
		$stop_time	= JEVHelper::getTime($row->getUnixEndTime(),$row->hdn(),$row->mindn());
		
		if( $stop_publish == $start_publish ){
			if ($row->noendtime()){
				$times = $start_time. ' Uhr';
			}
			else if ($row->alldayevent()){
				$times = "ganztägig";
			}
			else if($start_time != $stop_time ){
				$times = $start_time . ' - ' . $stop_time. ' Uhr';
			}
			else {
				$times = $start_time. ' Uhr';
			}

			$times = $row->dup(). '.' . $row->mup() . ". <span> ". $times."</span>";
		} else {
			if ($row->noendtime()){
				$times = $start_time;
			}
			else if($start_time != $stop_time && !$row->alldayevent()){
				$times = $start_time . ' - ' . $stop_time;
			}				
			$times = $row->dup() . '.' . $row->mup(). '. <span> bis </span> ' . $row->ddn() . '.' . $row->mdn(). '.' . " <span>". $times." Uhr</span>";
		}
	}
	else if (($jevtask=="day" || $jevtask=="week" )  && ($row->starttime() != $row->endtime()) && !($row->alldayevent())){
		$starttime = JEVHelper::getTime($row->getUnixStartTime(),$row->hup(),$row->minup());
		$endtime	= JEVHelper::getTime($row->getUnixEndTime(),$row->hdn(),$row->mindn());
		
		if ($row->noendtime()){
			if ($showyeardate && $jevtask=="year"){
				$times = "<span>" . $starttime. ' - ;' . $endtime . ' Uhr</span>';
			}
			else {
				$times = "<span>" . $starttime. ' Uhr</span>';
			}
		}
		else {
			$times = "<span>" . $starttime. ' - ' . $endtime . ' Uhr</span>';
		}
	}

		?>
		<table class="col_events_table" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tbody>
				<tr>
					<td class="col_events_date" style="color:<?php echo $row->fgcolor();?>; background: <?php echo $row->bgcolor(); ?>;">
						<?php echo $times; ?>
					</td>
					<td class="col_events_content">
						<a class="ev_link_row" href="<?php echo $rowlink; ?>" <?php echo $args;?> title="<?php echo JEventsHTML::special($row->title()) ;?>"><h4><?php echo $tmpTitle ;?></h4></a>
						<?php echo $row->location ?>
					</td>
				</tr>
			</tbody>
		</table>
			<?php
			if( $cfg->get('com_byview') == '1' ) {
				echo JText::_('JEV_BY') . '&nbsp;<i>'. $row->contactlink() .'</i>';
			}
			?>
		<?php
}