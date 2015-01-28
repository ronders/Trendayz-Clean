<?php echo $header; ?>
<div class="frame_content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <h1><?php echo $heading_title; ?></h1>
  <?php if($customer_ideas){?>
	  <?php foreach ($customer_ideas as $customer_idea) { ?>
		  <div class="content">
			<table style="width: 100%;">
			  <tr>
				<td>
					<a href="<?php echo $customer_idea['href'];?>" title="<?php echo $customer_idea['name'];?>"><?php echo $customer_idea['name'];?></a>
					<p><b><?php echo $text_date_added;?>: </b><?php echo $customer_idea['date_added'];?></p>
					<!--<p><b><?php echo $text_status;?>: </b><?php echo $customer_idea['status'];?></p>-->
				</td>
				<td style="text-align: right;"><a href="<?php echo $customer_idea['href'];?>" class="button"><span><?php echo $button_edit; ?></span></a> &nbsp; <a href="<?php echo $customer_idea['delete']; ?>" class="button"><span><?php echo $button_delete; ?></span></a></td>
			  </tr>
			</table>
		  </div>
	  <?php } ?>
	   <div class="pagination"><?php echo $pagination; ?></div>
  <?php }?>
  <div class="buttons">
    <div class="left"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </div>
  <?php echo $content_bottom; ?></div></div>
<?php echo $footer; ?>