<div class="ibox float-e-margins">
	<div class="card-header">
		<h5><?php $this->_('NEW_GROUP') ?></h5>
	</div>
	<div class="card-body">
		<form action="users/groupAdd" method="post" class="form-horizontal">
			<fieldset>
				<div class="form-group row">
					<label class="col-sm-2"><?php $this->_('NAME') ?></label>
					<div class="col-sm-10"><?php $this->form->printControl('name') ?></div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2"><?php $this->_('IS_DEFAULT') ?></label>
					<div class="col-sm-10"><?php $this->form->printControl('default') ?></div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2"><?php $this->_('DEFAULT_MODULE') ?></label>
					<div class="col-sm-10"><?php $this->form->printControl('defaultAclId') ?></div>
				</div>
				<div class="buttonBar">
					<button type="submit" class="btn btn-primary" value="add" name="action"><i class="fa fa-asterisk"></i> <?php $this->_('INSERT') ?></button>
					<a href="groups" class="btn btn-secondary"><i class="fa fa-times"></i> <?php $this->_('CANCEL') ?></a>
				</div>
			</fieldset>
		</form>
	</div>
</div>