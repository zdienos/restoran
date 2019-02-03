<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('user/add')?>" method="post" id="form-add">
				<div class="form-group">
					<label class="control-label mb-10 text-left">Nama User</label>
					<input type="text" class="form-control" id="input-nama_user" placeholder="Irfan Hakim"  name="nama_user">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Username</label>
					<input type="text" class="form-control" id="input-username" placeholder="Username"  name="username">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Password</label>
					<input type="password" class="form-control" id="input-password" placeholder="Password"  name="password">
					<div class="help-block with-errors" id="error">
					</div>
				</div>				
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Level</label>					
					<select name="id_level" id="input-id_level" class="form-control">
						<option value="" style="display:none;">Pilih Level</option>
						<?php foreach ($data_level as $level): ?>
							<option value="<?=$level->id_level?>"><?=$level->nama_level?></option>
						<?php endforeach ?>
					</select>
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">				
					<div class="input-group">
						<button type="submit" id="button-submit" class="btn cur-p btn-primary">Tambah</button>
					</div>
				</div>				
			</form>
			<br>
		</div>
	</div>	
	<div class="col-md-8">
		<div class="panel panel-default card-view">
			<table class="table">
				<tr>
					<th>No</th><th>Nama User</th><th>Username</th><th>Level</th><th>Status</th><th>Aksi</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_user" id="<?=$data->id_user?>"></td>
					<td><?=$i?></td>					
					<td><?=$data->nama_user?></td>
					<td><?=$data->username?></td>					
					<td><?=$data->nama_level?></td>		
					<td><?=$active[$data->active]?></td>	
					<td>
						<a href="#" onclick="edit('<?=$data->id_user?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
						<?php if ($data->id_user != 1): ?>
							<a href="<?=base_url('user/delete/'.$data->id_user)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>
</div>
<div id="responsive-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 17px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title">Edit</h5>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('user/ubah')?>" method="POST" id="form-edit">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">Nama User</label>
						<input type="text" class="form-control" id="edit-nama_user" placeholder="Irfan Hakim"  name="nama_user">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Username</label>
						<input type="text" class="form-control" id="edit-username" placeholder="Username"  name="username">
						<div class="help-block with-errors" id="error">
						</div>
					</div>				
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Level</label>					
						<select name="id_level" id="edit-id_level" class="form-control">
							<option value="" style="display:none;">Pilih Level</option>
							<?php foreach ($data_level as $level): ?>
								<option value="<?=$level->id_level?>"><?=$level->nama_level?></option>
							<?php endforeach ?>
						</select>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Status</label>					
						<select name="active" id="edit-active" class="form-control">
							<option value="" style="display:none;">Pilih Status</option>
							<option value="1">Active</option>
							<option value="0">Not Active</option>
						</select>
						<div class="help-block with-errors" id="error">
						</div>
					</div>				
					<div class="modal-footer">
						<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="hidden" name="id_user" id="edit-id_user">
						<button type="submit" class="btn btn-danger">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function edit(id) {
		$.ajax({
			type:"post",
			url:"<?=base_url()?>user/edit_data/"+id,
			dataType:"json",
			success:function (detail) {						
				$("#edit-id_user").val(id);
				$("#edit-nama_user").val(detail.nama_user);
				$("#edit-username").val(detail.username);				
				$("#edit-id_level").val(detail.id_level);
				$("#edit-active").val(detail.active);
			}
		});
	}

	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
	}
</script>