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
			line1.push(key,value);
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