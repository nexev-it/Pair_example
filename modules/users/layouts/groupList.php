<?php

if (count($this->groups)) {

?><div class="row">
	<div class="col-lg-12">
		<div class="card">
	    	<div class="card-header">
				<h5 class="float-left">Elenco gruppi</h5>
				<a class="btn btn-primary btn-sm float-right" href="users/groupNew"><i class="fa fa-plus-circle"></i> Nuovo gruppo</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th><?php $this->_('NAME') ?></th>
								<th><?php $this->_('IS_DEFAULT') ?></th>
								<th><?php $this->_('USERS') ?></th>
								<th><?php $this->_('DEFAULT_MODULE') ?></th>
								<th><?php $this->_('ACCESS_LIST') ?></th>
								<th><?php $this->_('EDIT') ?></th>
							</tr>
						</thead>
						<tbody><?php

						foreach ($this->groups as $group) {
					
							?><tr<?php if (!$group->aclCount) print ' class="alert"' ?>>
								<td><?php print $group->name ?></td>
								<td class="text-center"><?php print ($group->default ? '<i class="fa fa-check fa-lg text-success"></i>' : '') ?></td>
								<td class="text-center"><?php print $group->userCount ?></td>
								<td class="text-center small"><?php print $group->moduleName ?></td>
								<td class="text-center">
									<div class="iconText">
										<?php print $group->aclCount ?>
										<a href="users/aclList/<?php print $group->id ?>" class="btn btn-secondary btn-sm"><i class="fa fa-unlock-alt"></i></a>
									</div>
								</td>
								<td class="text-center"><a class="btn btn-secondary btn-sm" href="users/groupEdit/<?php print $group->id ?>"><i class="fa fa-pencil-alt"></i> <?php $this->_('EDIT') ?></a></td>
							</tr><?php
					
						}
					
						?></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div><?php

	print $this->getPaginationBar();

} else {

	Pair\Utilities::printNoDataMessageBox();

}