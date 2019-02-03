<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('order/add')?>" method="post" id="form-add">
				<div class="form-group">
					<label class="control-label mb-10 text-left">No Meja</label>
					<select class="form-control" name="id_meja" id="input-id_meja">
						<option value="" style="display: none;">Pilih Meja</option>
						<?php foreach ($data_meja as $meja): ?>
							<option value="<?=$meja->id_meja?>"><?=$meja->no_meja?> - (Kapasitas : <?=$meja->kapasitas?> orang)</option>
						<?php endforeach ?>
					</select>
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Id User</label>
					<select class="form-control" name="id_user" id="input-id_user">
						<option value="" style="display: none;">Pilih User</option>
						<?php foreach ($data_user as $user): ?>
							<option value="<?=$user->id_user?>"><?=$user->nama_user?></option>
						<?php endforeach ?>
					</select>
					<div class="help-block with-errors" id="error"></div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Tanggal</label>
					<input type="date" name="tanggal" id="input-tanggal" class="form-control"> 
					<div class="help-block with-errors" id="error"></div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Keterangan</label>
					<textarea name="keterangan" id="input-keterangan" class="form-control"></textarea>
					<div class="help-block with-errors" id="error"></div>
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
			<?php if (!$dataAll): ?>
				<center>
					<h5>Data tidak ditemukan</h5>
				</center>
				<br>
			<?php else: ?>
			<table class="table">
					<tr>
						<th>No</th><th>No Meja</th><th>Nama User</th><th>Tanggal</th><th>Status</th>
					</tr>
					<?php $i=0; foreach ($dataAll as $data): $i++; ?>
					<tr>
						<td hidden name="id_order" id="<?=$data->id_order?>"></td>
						<td><?=$i?></td>					
						<td><?=$data->no_meja?></td>
						<td><?=$data->nama_user?></td>					
						<td><?=$data->tanggal?></td>
						<td><?=$status_order[$data->status_order]?></td>
						<td>
							<a href="#" onclick="edit('<?=$data->id_order?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
							<a href="<?=base_url('order/delete/'.$data->id_order)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>						
						</td>
					</tr>
				<?php endforeach ?>
			</table>
			<?php endif ?>
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
				<form action="<?=base_url('order/ubah')?>" method="POST" id="form-edit">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">No Meja</label>
						<?php if (!$data_meja): ?>
							<input type="text" class="form-control" id="edit-id_meja" disabled="" name="id_meja">
						<?php else: ?>
						<select class="form-control" name="id_meja" id="edit-id_meja">
							<option value="" style="display: none;">Pilih Meja</option>
							<?php foreach ($data_meja as $meja): ?>
								<option value="<?=$meja->id_meja?>"><?=$meja->no_meja?> - (<?=$meja->kapasitas?> orang) <?=$meja->status_meja?>
								</option>
							<?php endforeach ?>
						</select>
						<?php endif ?>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Tanggal</label>
						<input type="date" class="form-control" id="edit-tanggal" placeholder="Harga"  name="tanggal">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
						<div class="form-group">
						<label class="control-label mb-10 text-left">Keterangan</label>
						<textarea name="keterangan" id="edit-keterangan" class="form-control"></textarea>
						<div class="help-block with-errors" id="error"></div>
					</div>			
					<div class="modal-footer">
						<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="hidden" name="id_order" id="edit-id_order">
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
			url:"<?=base_url()?>order/edit_data/"+id,
			dataType:"json",
			success:function (detail) {		
				console.log(detail);
				$("#edit-id_order").val(id);
				$("#edit-id_user").val(detail.data.id_user);	
				$("#edit-id_meja").val(detail.data.id_meja);	
				$("#edit-id_meja").append(detail.data_meja);				
				$("#edit-tanggal").val(detail.data.tanggal);		
				$("#edit-keterangan").val(detail.data.keterangan);		
			}
		});
	}

	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
	}
</script>