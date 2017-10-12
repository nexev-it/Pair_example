<?php

/**
 * @version	$Id$
 * @author	Viames Marino
 */

?><div class="col-lg-12">
	<div class="ibox">
		<div class="ibox-title">
			<h5><?php $this->_('EDIT_LANGUAGE_FILE', array($this->language->languageName, ucfirst($this->module))) ?></h5>
		</div>
		<div class="ibox-content">
			<form action="languages/change" method="post" class="form-horizontal"><?php
			
			print $this->form->renderControl('l');
			print $this->form->renderControl('m');
			
			foreach ($this->defStrings as $key=>$value) {
			
				?><div class="form-group">
					<label class="col-md-3 control-label"><?php print htmlspecialchars($value) ?></label>
					<div class="col-md-9"><?php print $this->form->renderControl($key) ?></div>
				</div><?php 
						
			}

				?>
				<div class="form-group">
					<div class="col-md-push-3 col-md-9">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php $this->_('CHANGE') ?></button>
						<a class="btn btn-default" href="<?php print $this->referer ?>"><i class="fa fa-times"></i> <?php $this->_('CANCEL') ?></a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>