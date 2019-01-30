<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('masakan/add')?>" method="post" id="form-add">
				<div class="form-group">
					<label class="control-label mb-10 text-left">Nama Masakan</label>
					<input type="text" class="form-control" id="input-nama_masakan" placeholder="Nasi Goreng"  name="nama_masakan">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Harga</label>
					<input type="text" class="form-control" id="input-harga" placeholder="Harga"  name="harga">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Status</label>
					<input type="text" class="form-control" id="input-status" placeholder="Status"  name="status">
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
					<th>No</th><th>Nama Masakan</th><th>Harga</th><th>Status</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_masakan" id="<?=$data->id_masakan?>"></td>
					<td><?=$i?></td>					
					<td><?=$data->nama_masakan?></td>
					<td><?=$data->harga?></td>					
					<td><?=$data->status?></td>		
					<td>
						<a href="#" onclick="edit('<?=$data->id_masakan?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
						<a href="<?=base_url('user/delete/'.$data->id_masakan)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>						
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
					<input type="text" class="form-control" id="edit-status" placeholder="Status"  name="status">
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
				$("#edit-status").val(detail.status);
			}
		});
	}

	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
	}
</script>