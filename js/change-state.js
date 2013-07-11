$(document).ready(function(){
	$(".terminate-state").click(function() {
		var confirmacion;
		bootbox.confirm("Esta seguro de FINALIZAR la venta?", function(result) {
			if (result) {
				$.ajax({
					type: "POST",
					url: "terminar_venta.php",
					data: "venta="+$(".terminate-state").attr("venta"),
					success: function(data) {
						if (data) {
							window.open("boleta.php","_blank");
							location.reload();
						}
					}
				});
			}
		});	
	});
	
	$(".cancel-state").click(function() {
		var confirmacion;
		bootbox.confirm("Esta seguro de CANCELAR la venta?", function(result) {
			if (result) {
				$.ajax({
					type: "POST",
					url: "cancelar_venta.php",
					data: "venta="+$(".cancel-state").attr("venta"),
					success: function(data) {
						if (data) {
						location.reload();
						}
					}
				});
			}
		});	
	});


	$(".delete-product").click(function() {
		bootbox.confirm("Esta seguro de ELIMINAR el Producto?", function(result) {
			if (result) {
				$.ajax({
					type: "POST",
					url: "eliminar_producto.php",
					data: "producto="+$(".delete-product").attr("producto"),
					success: function(data) {
						if (data) {
						location.reload();
						}
					}
				});
			}
		});	
	});
	$(".delete-ingrediente").click(function() {
		bootbox.confirm("Esta seguro de ELIMINAR el Ingrediente?", function(result) {
			if (result) {
				$.ajax({
					type: "POST",
					url: "eliminar_ingrediente.php",
					data: "ingrediente="+$(".delete-ingrediente").attr("ingrediente"),
					success: function(data) {
						if (data) {
						location.reload();
						}
					}
				});
			}
		});	
	});


	$("#mesa").change(function(){
		$(".mesa-id").html($(this).val());
	});

	$("#producto").change(function() {
		$(".totality").val(0);
		var ingredientes=new Array();
		var ingrediente_nombre=new Array();
		$("#producto option:selected").each(function() {
			ingredientes.push($(this).val());
			ingrediente_nombre.push($(this).text());
		});
		var html="<label for='cantidad' class='control-label'>Cantidades</label><div class='controls'>";
		$.each( ingredientes, function( key, value ) {
		  html+="<input type='text' name='cantidad[]' class='input-mini quantity-data' placeholder='0'/> "+ingrediente_nombre[key]+"<br>";
		});
		html+="</div>";
		$(".add-product").html(html);

	});
	//bootbox.alert("hola");
	$("#ingrediente").change(function() {
		var ingredientes=new Array();
		var ingrediente_nombre=new Array();
		$("#ingrediente option:selected").each(function() {
			ingredientes.push($(this).val());
			ingrediente_nombre.push($(this).text());
		});
		var html="<label for='cantidad' class='control-label'>Cantidades</label><div class='controls'>";
		$.each( ingredientes, function( key, value ) {
		  html+="<input type='text' name='cantidad[]' class='input-mini quantity-data' placeholder='0'/> "+ingrediente_nombre[key]+"<br>";
		});
		html+="</div>";
		$(".add-ingrediente").html(html);
	});

	$("#ingrediente-edit").change(function() {
		var ingredientes=new Array();
		var ingrediente_nombre=new Array();
		$("#ingrediente-edit option:selected").each(function() {
			ingredientes.push($(this).val());
			ingrediente_nombre.push($(this).text());
		});
		var html="<label for='cantidad' class='control-label'>Cantidades</label><div class='controls'>";
		$.each( ingredientes, function( key, value ) {
		  html+="<input type='text' name='cantidad[]' class='input-mini quantity-data' placeholder='0'/> "+ingrediente_nombre[key]+"<br>";
		});
		html+="</div>";
		$(".add-ingrediente-edit").html(html);
	});


	

	//bootbox.alert($(this).val());
});