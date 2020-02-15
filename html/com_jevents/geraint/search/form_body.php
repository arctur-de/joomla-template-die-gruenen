<?php 
defined('_JEXEC') or die('Restricted access');
?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="j-search">
	<tr>
		<td align="center" width="100%">
			<?php //onsubmit="if (this.keyword.value.length<3) {alert('keyword is too short');return false;}" ?>
			<form action="<?php echo JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=search.results&Itemid=".$this->Itemid);?>" method="post" >
					<input type="search" name="keyword" maxlength="50" value="<?php echo $this->keyword;?>" />
					<input class="btn btn-primary" type="submit" name="push" value="<?php echo JText::_('JEV_SEARCH_TITLE'); ?>" />
					<label>
					<input type="checkbox" id="showpast" name="showpast" value="1" <?php echo JRequest::getInt('showpast',0)?'checked="checked"':''?> />
					<?php echo JText::_("JEV_SHOW_PAST");?></label>
			</form>
		</td>
	</tr>
</table>
