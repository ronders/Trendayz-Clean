<?php 
	$this->load->language('catalog/fancy_design/editorbox');
	$this->data['header_canvas_error']=$this->language->get('header_canvas_error');
	$this->data['text_download']=$this->language->get('text_download');
	$this->data['firefox']=$this->language->get('firefox');
	$this->data['chrome']=$this->language->get('chrome');
	$this->data['opera']=$this->language->get('opera');	
?>
<div class="fpd-browser-alert">
	<p><?php echo $header_canvas_error;?></p>
	<span><a href="http://www.mozilla.org/firefox/new/" title="<?php echo $text_download;?>" class="firefox"><?php echo $firefox;?></a><a href="http://www.google.com/Chrome" title="Download Chrome" class="chrome"><?php echo $chrome;?></a><a href="http://www.opera.com/download/" title="Download Opera" class="opera"><?php echo $opera;?></a></span>
</div>