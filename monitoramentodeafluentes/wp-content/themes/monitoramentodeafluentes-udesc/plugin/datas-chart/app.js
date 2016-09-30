$(function() {
	$.ajax({
		url: "<?php echo get_template_directory_uri(); ?>/plugin/datas-chart/data.php",
		method: "GET",
		success: function(data) {
			// console.log(data);
			var idEvento = []; // Id do Evento
			var date = []; // Data do Evento
			var hour = []; // Hora do Evento
			var temperature = []; // Temperatura do Evento
			var profundidade = []; // Temperatura do Evento

			var dia, mes, ano, hora, min, seg, res = [], count = 0;
			for(var i in data) {
				// console.log("\n" + data[i].data);
				ano = (data[i].data).substring(0,4); // console.log("Ano: " + ano);
				mes = (data[i].data).substring(5, 7); // console.log("Mês: " + mes);
				dia = (data[i].data).substring(8, 10); // console.log("Dia: " + dia);

				// console.log("\n" + data[i].hora);
				hora = (data[i].hora).substring(0,2); // console.log("Hora: " + hora);
				min = (data[i].hora).substring(3,5); // console.log("Minuto: " + min);
				seg = (data[i].hora).substring(6,8); // console.log("Segundo: " + seg);

				// res = Date.UTC(ano, mes, dia, hora, min, seg);
				convertData(ano, mes, dia, hora, min, seg);
				lessProfundidade()

				profundidade.push([(res[count][0]), parseFloat(data[i].dados)]);
				// idEvento.push([res[count][0], parseInt(data[i].idEvento_dad)/*, parseFloat(data[i].dados)*/]);
				// console.log(data[i].idEvento_dad);
				count++;
			}
			// console.log(profundidade);

			function convertData(ano, mes, dia, hora, min, seg) {
				var d = new timezoneJS.Date(ano, mes, dia, hora, min, seg);
				var dtC = d._timeProxy; // Data Convertida
				var dtP = d._dateProxy; // Data do Proxy
				var dtA = dtP.strftime('%d/%m/%Y - %H:%M:%S'); // Data personalizada
				res.push([dtC, dtP, dtA]);
			}

			function lessProfundidade(argument) {
				// body...
			}

			var placeholder = $("#placeholder");

			var data = [ // Dados
				// { data: oilPrices, label: "Temperatura" },
				// { data: exchangeRates, label: "USD/EUR exchange rate", yaxis: 2 }
				{ data: profundidade, label: "Profundidade" },
				// { data: idEvento, label: "Id" },
			];

			var options = {
				series: {
					lines: {
						show: true,
						steps: true,
						fill: true,
						// shadowSize: 0	// Drawing is faster without shadows
					},
					points: {
						show: true
					}
				},
				grid: {
					hoverable: true,
					clickable: true
				},
				// xaxis: {
				// 	show: false
				// },
				yaxis: {
					// min: 0,
					// max: 100,
					tickFormatter: function(value, axis) {
						// return value.toFixed(axis.tickDecimals) + "cm";
						return value.toFixed(axis.tickDecimals) + "cm";
					}
				},
				xaxes: [ {
					mode: "time",
					timeformat: "%d/%m/%Y \n %H:%M:%S"
				} ],
			};

			var plot = $.plot(placeholder, data, options);


			// Holver para o determinado valor
			$("<div id='tooltip'></div>").css({
				position: "absolute",
				display: "none",
				border: "1px solid #fdd",
				padding: "2px",
				"background-color": "#fee",
				opacity: 0.80
			}).appendTo("body");

			$("#placeholder").bind("plothover", function (event, pos, item) {
					if (item) {
						if (item.datapoint[0] == res[item.dataIndex][0]) {
							var r = res[item.dataIndex][2];
						} else {
							var r = "indefinida";
						}

						var x = item.datapoint[0].toFixed(2), y = item.datapoint[1].toFixed(2);

						$("#tooltip").html(item.series.label + ": " + y + " - Data: " + r)
							.css({top: item.pageY+5, left: item.pageX+5})
							.fadeIn(200);
					} else {
						$("#tooltip").hide();
					}
			});

			$("#placeholder").bind("plotclick", function (event, pos, item) {
				if (item) {
					if (item.datapoint[0] == res[item.dataIndex][0]) {
						var r = res[item.dataIndex][2];
					} else {
						var r = "indefinida";
					}
					$("#clickdata").text(/*" - ponto clicado " + */item.dataIndex +
						" com " + item.series.label + " de " + item.datapoint[1].toString().substring(0,5) +
						" - data: " + r);
					plot.highlight(item.series, item.datapoint);
					// console.log(item);
				}
			});
			// Fim do Holver para o determinado valor

			// Responsividade
			// placeholder.resize(function () {
			// 	$(".message").text("Placeholder is now " + $(this).width() + "x" + $(this).height() + " pixels");
			// });

			// $(".demo-container").resizable({
			// 	maxWidth: 900,
			// 	maxHeight: 500,
			// 	minWidth: 450,
			// 	minHeight: 250
			// });
			// Final Responsividade

			// Set up the control widget
			var updateInterval = 300000000;
			$("#updateInterval").val(updateInterval).change(function () {
				var v = $(this).val();
				if (v && !isNaN(+v)) {
					updateInterval = +v;
					if (updateInterval < 1) {
						updateInterval = 1;
					} else if (updateInterval > 2000) {
						updateInterval = 2000;
					}
					$(this).val("" + updateInterval);
				}
			});

			function update() {
				plot.setData([data]);
				// Since the axes don't change, we don't need to call plot.setupGrid()
				plot.draw();
				setTimeout(update, updateInterval);
			}

			//update();
			console.log(data);

			// Add the Flot version string to the footer

			$("#footer").prepend("Flot " + plot.version + " &ndash; ");

			// setTimeout(function() { reload(); }, 3000);
		},
		error: function(data) {
			console.log(data);
		}
	});
});