var ModalTemplates = function(){
	var getDanger = function(title, text){
		return '<div class="modal-dialog">\n' +
			'		<div class="modal-content animated fadeInDown">\n' +
			'       	<div class="modal-header">\n' +
			'           	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>\n' +
			'				<i class="fa fa-exclamation-triangle modal-icon"></i>\n' +
		'					<h4 class="modal-title">' + title + '</h4>\n' +
			'           </div>\n' +
			'           <div class="modal-body">\n' +
			'               <p class="text-center">' + text + '</p>\n' +
			'           </div>\n' +
			'           <div class="modal-footer">\n' +
			'           	<button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancelar</button>\n' +
			'           	<button type="button" class="btn btn-success submit-form" id="do-it"><i class="fa fa-check-square-o"></i>&nbsp;Confirmar</button>\n' +
			'           </div>\n' +
			'       </div>\n' +
			'   </div>';
	};

	var getCancel = function(title, text){
		return '<div class="modal-dialog">\n' +
			'		<div class="modal-content animated fadeInDown">\n' +
			'       	<div class="modal-header">\n' +
			'           	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>\n' +
			'				<i class="fa fa-exclamation-triangle modal-icon"></i>\n' +
		'					<h4 class="modal-title">' + title + '</h4>\n' +
			'           </div>\n' +
			'           <div class="modal-body">\n' +
			'               <p class="text-center">' + text + '</p>\n' +
			'           </div>\n' +
			'           <div class="modal-footer">\n' +
			'           	<button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancelar</button>\n' +
			'           	<button type="button" class="btn btn-success submit-form" id="do-it"><i class="fa fa-check-square-o"></i>&nbsp;Confirmar</button>\n' +
			'           </div>\n' +
			'       </div>\n' +
			'   </div>';
	};

	var getInfo = function(title, text){
		return '<div class="modal-dialog">\n' +
			'		<div class="modal-content animated fadeInDown">\n' +
			'       	<div class="modal-header">\n' +
			'           	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>\n' +
			'				<i class="fa fa-exclamation-circle modal-icon"></i>\n' +
		'					<h4 class="modal-title">' + title + '</h4>\n' +
			'           </div>\n' +
			'           <div class="modal-body">\n' +
			'               <p class="text-center">' + text + '</p>\n' +
			'           </div>\n' +
			'           <div class="modal-footer">\n' +
			'           	<button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fechar</button>\n' +
			'           </div>\n' +
			'       </div>\n' +
			'   </div>';
	};

	var getSuccess = function(title, text){
		return '<div class="modal-dialog">\n' +
			'		<div class="modal-content animated fadeInDown">\n' +
			'       	<div class="modal-header">\n' +
			'           	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>\n' +
			'				<i class="fa fa-check-circle modal-icon"></i>\n' +
		'					<h4 class="modal-title">' + title + '</h4>\n' +
			'           </div>\n' +
			'           <div class="modal-body">\n' +
			'               <p class="text-center">' + text + '</p>\n' +
			'           </div>\n' +
			'           <div class="modal-footer">\n' +
			'           	<button type="button" class="btn btn-white submit-form" id="do-it" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fechar</button>\n' +
			'           </div>\n' +
			'       </div>\n' +
			'   </div>';
	};

	var getConfirm = function(title, text){
		return '<div class="modal-dialog">\n' +
			'		<div class="modal-content animated fadeInDown">\n' +
			'       	<div class="modal-header">\n' +
			'           	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>\n' +
			'				<i class="fa fa-check-circle modal-icon"></i>\n' +
		'					<h4 class="modal-title">' + title + '</h4>\n' +
			'           </div>\n' +
			'           <div class="modal-body">\n' +
			'               <p class="text-center">' + text + '</p>\n' +
			'           </div>\n' +
			'           <div class="modal-footer">\n' +
			'           	<button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Fechar</button>\n' +
			'           	<button type="button" class="btn btn-primary submit-form" id="do-it"><i class="fa fa-check-square-o"></i>&nbsp;Confirmar</button>\n' +
			'           </div>\n' +
			'       </div>\n' +
			'   </div>';
	};

	var getConfirmSmall = function(title, text){
		return '<div class="modal-dialog modal-dialog-sm">\n' +
			'		<div class="modal-content animated fadeInDown">\n' +
			'       	<div class="modal-header">\n' +
			'           	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>\n' +
		'					<h4 class="modal-title">' + title + '</h4>\n' +
			'           </div>\n' +
			'           <div class="modal-body">\n' +
			'               <p class="text-center">' + text + '</p>\n' +
			'           </div>\n' +
			'           <div class="modal-footer">\n' +
			'           	<button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>\n' +
			'           	<button type="button" class="btn btn-primary submit-form" id="do-it">Confirmar</button>\n' +
			'           </div>\n' +
			'       </div>\n' +
			'   </div>';
	};

	return {
		getDanger: getDanger,
		getCancel: getCancel,
		getInfo: getInfo,
		getSuccess: getSuccess,
		getConfirm: getConfirm,
		getConfirmSmall: getConfirmSmall
	}
};
