<?= $this->extend('layouts/layout_trab') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-12">
			<div class="card">
				<div class="card-body">
					<ul class="nav nav-tabs mb-3">
						<li class="nav-item">
							<a href="#tabs1" data-toggle="tab" aria-expanded="true" class="nav-link active">
								<i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
								<span class="d-none d-lg-block">Propias</span>
							</a>
						</li>
						<li class="nav-item" style="display: <?=($rol == 1?"none":"true")?>;">
							<a href="#tabs2" data-toggle="tab" aria-expanded="false" class="nav-link">
								<i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
								<span class="d-none d-lg-block">Trabajadores</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane show active" id="tabs1">
							<a style="color: white;" href="<?=base_url("ctrl_fej/nueva")?>" class="btn btn-primary mb-2" ><i class="fas fa-plus"></i>&nbsp; Nueva</a>
							<table id="tliq" class="table table-striped table-bordered display" style="width:100%"></table>
						</div>
						<div class="tab-pane" id="tabs2">
							<table id="tliqr" class="table table-striped table-bordered display" style="width:100%"></table>
						</div>
					</div>
				</div> <!-- end card-body-->
			</div> <!-- end card-->
		</div>

	</div>
</div>






<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
	var tliq,tliqr
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();

	var fd = <?php echo (session()->getFlashdata() ? json_encode(session()->getFlashdata()) : json_encode("")) ?>;
	if (fd != "") {
		console.log(fd.msg);
		//Mostrar toast
		if (fd.r) toastr.success(fd.msg, 'Éxito');
		else toastr.error(fd.msg, 'Error');
	}

	function ajaxeli(id) { //Eliminar liquidacion
		confirm((dt)=>{sajax("ajaxeli",dt,false)}, {id: id}) //eliminar y recargar la actual
	}

	var cols = JSON.parse('<?php echo $cols ?>');
	var colsr = JSON.parse('<?php echo $colsr ?>');
	// console.log(cols);
	tliq = $("#tliq").DataTable({
      ajax:{
        url: cadenaurl + '/' + ctrl + "/ajaxlliq",
        type: "POST"
      },
      order: [[ 2, 'asc' ]],
      columns: cols,
      columnDefs: [
        
        { //Acciones
            render: function ( data, type, row ) {
                // console.log("ROW>",data,type,row);
                return '<a href="'+cadenaurl+ctrl+"/editar/"+row.IdFej+'" title="Editar Liquidacion" class="btn waves-effect btn-circle waves-light"><i class="ti-pencil-alt text-success"></i></a>'
                + '<a onclick="ajaxeli('+row.IdFej+')" title="Eliminar Liquidacion" class="btn waves-effect btn-circle waves-light"><i class="ti-close text-danger"></i></a>';
            },
            targets: cols.length-1 //Column Acciones
        },
      ],
      // Atributos comprimidos
      "scrollX": true,"autoWidth": true,"scrollCollapse": true,"pagingType": "full_numbers","lengthMenu": [ [15, 25, 50, -1], [15, 25, 50, "All"] ],language: { paginate: { previous: "<", next: ">" } },"paging": true,"processing": true,"searching": true,"lengthChange": true,"ordering": false,"info": false,"bProcessing": true,"pageLength": 15,"oLanguage": {"sUrl": cadenaurl + "resources/spanish.json"},pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
      "fnInitComplete": function () {
        const ps = new PerfectScrollbar('.dataTables_scrollBody')
        $(".selectAll").on( "click", function(e) {
          if ($(this).is( ":checked" )) {
              tabasis.rows().select();        
          } else {
              tabasis.rows().deselect(); 
          }
        })
      },
      "fnDrawCallback": function (oSettings) {const ps = new PerfectScrollbar('.dataTables_scrollBody');},
    })
	if(rol != 1){
		tliqr = $("#tliqr").DataTable({
		  ajax:{
			url: cadenaurl + '/' + ctrl + "/ajaxlliqr",
			type: "POST"
		  },
		  order: [[ 2, 'asc' ]],
		  columns: colsr,
		  columnDefs: [
			{//Estado
			  render: function ( data, type, row ) {
				l = {"0": "<a class='btn btn-rounded btn-danger' title='Por Revisar'></a>",
					"1": "<a class='btn btn-rounded btn-primary' title='Completo'></a>", 
					"2": "<a class='btn btn-rounded btn-success' title='Aceptado'></a>"}
				return l[row.EstLiq];
			  },
			  targets: colsr.length-2 //Column Estado
			},
			{ //Acciones
				render: function ( data, type, row ) {
					// console.log("ROW>",data,type,row);
					return '<a href="'+cadenaurl+ctrl+"/ver/"+row.IdLiq+'" title="Ver Liquidacion" class="btn btn-icon btn-info waves-effect btn-circle waves-light"><i class="ti-file" style="color: white;"></i></a>';
				},
				targets: colsr.length-1 //Column Acciones
			},
		  ],
		  // Atributos comprimidos
		  "scrollX": true,"autoWidth": true,"scrollCollapse": true,"pagingType": "full_numbers","lengthMenu": [ [15, 25, 50, -1], [15, 25, 50, "All"] ],language: { paginate: { previous: "<", next: ">" } },"paging": true,"processing": true,"searching": true,"lengthChange": true,"ordering": false,"info": false,"bProcessing": true,"pageLength": 15,"oLanguage": {"sUrl": cadenaurl + "resources/spanish.json"},pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
		  "fnInitComplete": function () {
			const ps = new PerfectScrollbar('.dataTables_scrollBody')
			$(".selectAll").on( "click", function(e) {
			  if ($(this).is( ":checked" )) {
				  tabasis.rows().select();        
			  } else {
				  tabasis.rows().deselect(); 
			  }
			})
		  },
		  "fnDrawCallback": function (oSettings) {const ps = new PerfectScrollbar('.dataTables_scrollBody');},
		})
	}

	// $(document).ready(function() {
	// 	$(".nav-toggler").on('click', function () {
	// 		$("#main-wrapper").toggleClass("show-sidebar");
	// 		$(".nav-toggler i").toggleClass("ti-menu");
	// 	});
	// })
</script>

<?= $this->endSection() ?>