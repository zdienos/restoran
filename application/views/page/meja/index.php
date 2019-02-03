<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('meja/add')?>" method="post" id="form-add">
				<div class="form-group">
					<label class="control-label mb-10 text-left">No Meja</label>
					<input type="text" class="form-control" id="input-no_meja" placeholder="No Meja"  name="no_meja">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Kapasitas</label>
					<input type="text" class="form-control" id="input-kapasitas" placeholder="Kapasitas"  name="kapasitas">
					<div class="help-block with-errors" id="error">
					</div>
				</div>				
				<input type="hidden" class="form-control" id="input-status_meja" value="Kosong" name="status_meja">				
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
					<th>No</th><th>No Meja</th><th>Kapasitas</th><th>Status</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_meja" id="<?=$data->id_meja?>"></td>
					<td><?=$i?></td>					
					<td><?=$data->no_meja?></td>
					<td><?=$data->kapasitas?></td>					
					<td><?=$data->status_meja?></td>		
					<td>
						<a href="#" onclick="edit('<?=$data->id_meja?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
						<a href="<?=base_url('meja/delete/'.$data->id_meja)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>						
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
				<form action="<?=base_url('meja/ubah')?>" method="POST" id="form-edit">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">No Meja</label>
						<input type="text" class="form-control" id="edit-no_meja" placeholder="No Meja"  name="no_meja">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Kapasitas</label>
						<input type="text" class="form-control" id="edit-kapasitas" placeholder="Kapasitas"  name="kapasitas">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Status Meja</label>
						<select class="form-control" name="status_meja" id="edit-status_meja">
							<?php for($i=0;$i<count($data_status_meja);$i++){ ?>
								<option><?=$data_status_meja[$i]?></option>
							<?php } ?>
						</select>
							<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="hidden" name="id_meja" id="edit-id_meja">
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
			url:"<?=base_url()?>meja/edit_data/"+id,
			dataType:"json",
			success:function (detail) {		
				console.log(detail);
				$("#edit-id_meja").val(id);
				$("#edit-no_meja").val(detail.no_meja);
				$("#edit-kapasitas").val(detail.kapasitas);						
				$("#edit-status_meja").val(detail.status_meja);		
			}
		});
	}

	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
	}
</script>
