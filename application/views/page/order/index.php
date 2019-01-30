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
					<label class="control-label mb-10 text-left">Status Order</label>
					<select class="form-control" name="status_order" id="input-status_order">
						<option value="" style="display: none;">Pilih Status</option>						
						<option value="Baru Pesan">Baru Pesan</option>
						<option value="Proses">Proses</option>
					</select>
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
					<td><?=$data->status_order?></td>
					<td>
						<a href="#" onclick="edit('<?=$data->id_order?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
						<a href="<?=base_url('user/delete/'.$data->id_order)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>						
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
				<form action="<?=base_url('masakan/ubah')?>" method="POST" id="form-edit">					
				<div class="form-group">
					<label class="control-label mb-10 text-left">Nama Masakan</label>
					<input type="text" class="form-control" id="edit-nama_masakan" placeholder="Nasi Goreng"  name="nama_masakan">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Harga</label>
					<input type="text" class="form-control" id="edit-harga" placeholder="Harga"  name="harga">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Status</label>
					<select name="id_status_masakan" id="edit-id_status_masakan" class="form-control">
						<option value="" style="display:none;">Pilih Status</option>
						<?php foreach ($data_status as $status): ?>
							<option value="<?=$status->id_status_masakan?>"><?=$status->nama_status_masakan?></option>							
						<?php endforeach ?>
					</select>
					<div class="help-block with-errors" id="error">
					</div>
				</div>	
				<div class="modal-footer">
					<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="hidden" name="id_masakan" id="edit-id_masakan">
					<button type="submit" class="btn btn-danger">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function edit(id) {
		$.ajax({
			type:"post",
			url:"<?=base_url()?>masakan/edit_data/"+id,
			dataType:"json",
			success:function (detail) {		
				console.log(detail);
				$("#edit-id_masakan").val(id);
				$("#edit-nama_masakan").val(detail.nama_masakan);
				$("#edit-harga").val(detail.harga);				
				$("#edit-id_status_masakan").val(detail.id_status_masakan);
			}
		});
	}

	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
	}
</script>