// var items = [];
// var i = 0, id, data, hora, dado, cod, dados = [], j;
// function addItem() {
// 	if (i == 0) {
//   	dados.push({
//   		// "id" : i,
//   		"data" : getData(),
//   		"hora" : getHora(),
//   		"dado" : (Math.random()*2.14) + 0.1,
//   		"cod" : "UL0",
//   	});
// 	} else {
// 		dados.pop();
// 		dados.push({
//   		// "id" : i,
//   		"data" : getData(),
//   		"hora" : getHora(),
//   		"dado" : (Math.random()*2.14) + 0.1,
//   		"cod" : "UL0",
//   	});
// 	}
//   console.log(dados);
//   // console.log(i);
//   j = JSON.stringify(dados);
//   // console.log(j);
// 	i++;
// 	// return j;
// }

// function getData() {
// 	var today = new Date();
// 	var d = today.getDate();
// 	var m = today.getMonth()+1; //January is 0!
// 	var y = today.getFullYear();

// 	if (d < 10) {
//     d = '0' + d;
// 	} 

// 	if (m < 10) {
//     m = '0' + m;
// 	} 

// 	return (y+'-'+m+'-'+d);
// }

// function getHora() {
// 	var today = new Date();
// 	var h = today.getHours();
// 	var m = today.getMinutes();
// 	var s = today.getSeconds();

// 	if (h < 10) {
// 	  h = '0' + h;
// 	} 

// 	return (h+':'+m+':'+s);
// }

// function pegarDados() {
// 	addItem();
//   $.ajax({
//     url: "get_post.php",
//     data: {"dados": dados},
//     type: "post",
//     success: function(data) {
//       $("#postedItems").append(data);
//     }
//   });
// }






$(function() {
  $.ajax({
    url: "data.php",
    method: "GET",
    success: function(data) {
      // console.log(data);
      var idEvento = []; // Id do Evento
      var date = []; // Data do Evento
      var hour = []; // Hora do Evento
      var temperature = []; // Temperatura do Evento
      var profundidade = []; // Temperatura do Evento

      var dia, mes, ano, hora, min, seg, resData = [], profu, altu = 2.14, resProfu = [], count = 0;
      for(var i in data) {
        // console.log("\n" + data[i].data);
        ano = (data[i].data).substring(0,4); // console.log("Ano: " + ano);
        mes = (data[i].data).substring(5, 7); // console.log("Mês: " + mes);
        dia = (data[i].data).substring(8, 10); // console.log("Dia: " + dia);

        // console.log("\n" + data[i].hora);
        hora = (data[i].hora).substring(0,2); // console.log("Hora: " + hora);
        min = (data[i].hora).substring(3,5); // console.log("Minuto: " + min);
        seg = (data[i].hora).substring(6,8); // console.log("Segundo: " + seg);

        // resData = Date.UTC(ano, mes, dia, hora, min, seg);
        convertData(ano, mes, dia, hora, min, seg);
        profu = (data[i].dados).substring(0,4);
        // alert(profu);
        lessProfundidade(profu)
        // console.log(data[i].dados);

        profundidade.push([(resData[count][0]), parseFloat(data[i].dados)]);
        // idEvento.push([resData[count][0], parseInt(data[i].idEvento_dad)/*, parseFloat(data[i].dados)*/]);
        // console.log(data[i].idEvento_dad);
        count++;
      }
      // console.log(profundidade);
      console.log(resProfu);

      function convertData(ano, mes, dia, hora, min, seg) {
        var d = new timezoneJS.Date(ano, mes, dia, hora, min, seg);
        var dtC = d._timeProxy; // Data Convertida
        var dtP = d._dateProxy; // Data do Proxy
        var dtA = dtP.strftime('%d/%m/%Y - %H:%M:%S'); // Data personalizada
        resData.push([dtC, dtP, dtA]);
      }

      function lessProfundidade(profu) {
      	var subt = altu - profu;
        resProfu.push([subt]);
      }

      var teste = [], totalPoints = 300;

			function getRandomData() {
				if (teste.length > 0) {
					teste = teste.slice(1);
				}

				// Do a random walk
				while (teste.length < totalPoints) {
					var prev = teste.length > 0 ? teste[teste.length - 1] : 50, y = prev + Math.random() * 10 - 5;
					if (y < 0) {
						y = 0;
					} else if (y > 100) {
						y = 100;
					}

					teste.push(y);
				}

				// Zip the generated y values with the x values
				var res = [];
				for (var i = 0; i < teste.length; ++i) {
					res.push([i, teste[i]])
				}

				return res;
			}


			var updateInterval = 30;
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


      var placeholder = $("#placeholder");

			var data = [ // Dados
				// { data: oilPrices, label: "Temperatura" },
				// { data: exchangeRates, label: "USD/EUR exchange rate", yaxis: 2 }
				{ data: getRandomData(), label: "Profundidade" },
				// { data: idEvento, label: "Id" },
			];

			var options = {
				series: {
					lines: {
						show: true,
						// steps: true,
						// fill: true,
						// shadowSize: 0	// Drawing is faster without shadows
					},
					// points: {
					// 	// show: true
					// }
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
				} ]
			};

			var plot = $.plot(placeholder, data, options);

			// Holver para o determinado valor
			// $("<div id='tooltip'></div>").css({
			// 	position: "absolute",
			// 	display: "none",
			// 	border: "1px solid #fdd",
			// 	padding: "2px",
			// 	"background-color": "#fee",
			// 	opacity: 0.80
			// }).appendTo("body");

			// $("#placeholder").bind("plothover", function (event, pos, item) {
			// 	if (item) {
			// 		if (item.datapoint[0] == resData[item.dataIndex][0]) {
			// 			var r = resData[item.dataIndex][2];
			// 		} else {
			// 			var r = "indefinida";
			// 		}

			// 		var x = item.datapoint[0].toFixed(2), y = item.datapoint[1].toFixed(2);

			// 		$("#tooltip").html(item.series.label + ": " + y + " - Data: " + r)
			// 			.css({top: item.pageY+5, left: item.pageX+5})
			// 			.fadeIn(200);
			// 	} else {
			// 		$("#tooltip").hide();
			// 	}
			// });

			// $("#placeholder").bind("plotclick", function (event, pos, item) {
			// 	if (item) {
			// 		if (item.datapoint[0] == resData[item.dataIndex][0]) {
			// 			var r = resData[item.dataIndex][2];
			// 		} else {
			// 			var r = "indefinida";
			// 		}
			// 		$("#clickdata").text(/*" - ponto clicado " + */item.dataIndex +
			// 			" com " + item.series.label + " de " + item.datapoint[1].toString().substring(0,5) +
			// 			" - data: " + r);
			// 		plot.highlight(item.series, item.datapoint);
			// 		// console.log(item);
			// 	}
			// });
			// Fim do Holver para o determinado valor

			var i = 0, v;
			function update() {
				plot.setData(data);

				// Since the axes don't change, we don't need to call plot.setupGrid()
				plot.draw();
				// v = setTimeout("pegarDados()", 6000);
				setTimeout(update, updateInterval);
				console.log(i++);
			}
			update();

			// var v = setInterval("pegarDados()", 3000);
			// $("#post").click(function(){
			// 	// clearInterval(v);
			// 	pegarDados();
			// 	// profundidade.shift();
			// });
			// setTimeout('profundidade.shift()', 3000);
			// setTimeout('pegarDados()', updateInterval);
			// setTimeout('$("#placeholder").load("index.php")', updateInterval);
    },
    error: function(data) {
      console.log(data);
    }
  });
});

	// // We use an inline data source in the example, usually data would
	// // be fetched from a server

	// var data = [], totalPoints = 300;

	// function getRandomData() {
	// 	if (data.length > 0) {
	// 		data = data.slice(1);
	// 	}

	// 	// Do a random walk
	// 	while (data.length < totalPoints) {
	// 		var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
	// 		if (y < 0) {
	// 			y = 0;
	// 		} else if (y > 100) {
	// 			y = 100;
	// 		}

	// 		data.push(y);
	// 	}

	// 	// Zip the generated y values with the x values
	// 	var res = [];
	// 	for (var i = 0; i < data.length; ++i) {
	// 		res.push([i, data[i]])
	// 	}

	// 	return res;
	// }

	// // Set up the control widget

	// var updateInterval = 30;
	// $("#updateInterval").val(updateInterval).change(function () {
	// 	var v = $(this).val();
	// 	if (v && !isNaN(+v)) {
	// 		updateInterval = +v;
	// 		if (updateInterval < 1) {
	// 			updateInterval = 1;
	// 		} else if (updateInterval > 2000) {
	// 			updateInterval = 2000;
	// 		}
	// 		$(this).val("" + updateInterval);
	// 	}
	// });

	// var plot = $.plot("#placeholder", [ getRandomData() ], {
	// 	series: {
	// 		shadowSize: 0	// Drawing is faster without shadows
	// 	},
	// 	yaxis: {
	// 		min: 0,
	// 		max: 100
	// 	},
	// 	xaxis: {
	// 		show: false
	// 	}
	// });

	// function update() {
	// 	plot.setData([getRandomData()]);

	// 	// Since the axes don't change, we don't need to call plot.setupGrid()
	// 	plot.draw();
	// 	setTimeout(update, updateInterval);
	// }

	// update();

	// // Add the Flot version string to the footer
	// $("#footer").prepend("Flot " + $.plot.version + " &ndash; ");

