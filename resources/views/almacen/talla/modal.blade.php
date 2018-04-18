<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$tallKey->idt_talla}}">
	{{Form::Open(array('action'=>array('TallaController@destroy',$tallKey->idt_talla),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>

				</button>
				<h4 class="modal-title">Eliminar Talla</h4>
			</div>
			<div class="modal-body">
			<p>Confirme si desea Eliminar la Talla</p>


			</div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
				<button class="btn btn-primary" type="submit">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>
