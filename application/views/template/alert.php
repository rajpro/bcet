<?php if($this->session->success): ?>
<div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
  <div class="icon"><span class="mdi mdi-check"></span></div>
  <div class="message">
    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><?=$this->session->success?>
  </div>
</div>
<?php elseif($this->session->warning): ?>
<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
  <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
  <div class="message">
    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><?=$this->session->warning?>
  </div>
</div>
<?php elseif(validation_errors()): ?>
<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
  <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
  <div class="message">
    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><?=validation_errors()?>
  </div>
</div>	
<?php endif; ?>