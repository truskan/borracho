$(document).ready(function() {
	if ($("#add-report-type-buttons").val()==1) {
		tipo=1;
		$.ajax({
			type: "POST",
			url: "data_report.php",
			data: "tipo="+tipo,
			success: function(data) {
			}
		});
		la_variable=data.split("/");
		line1=new Array();
		$.each(la_variable, function(key, value) {
			datos=line1[key].split("*");
			line1.push(datos[0],datos[1]);
		});

		$('#barra').jqplot([line1], {
			title:'Reporte Diario ',
			seriesDefaults:{
				renderer:$.jqplot.BarRenderer
			},
			axes:{
				xaxis:{
					renderer: $.jqplot.CategoryAxisRenderer
				}
			}
		});
	}
});