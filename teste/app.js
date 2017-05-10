$(function() {
	  $.ajax({
    url: "data.php",
    method: "GET",
    success: function(data) {
      // // console.log(data);
      // var idEvento = []; // Id do Evento
      // var date = []; // Data do Evento
      // var hour = []; // Hora do Evento
      // var temperature = []; // Temperatura do Evento
      // var profundidade = []; // Temperatura do Evento

      // var dia, mes, ano, hora, min, seg, res = [], count = 0;
      // for(var i in data) {
      //   console.log("\n" + data[i].data);
      //   ano = (data[i].data).substring(0,4); // console.log("Ano: " + ano);
      //   mes = (data[i].data).substring(5, 7); // console.log("Mês: " + mes);
      //   dia = (data[i].data).substring(8, 10); // console.log("Dia: " + dia);

      //   console.log("\n" + data[i].hora);
      //   hora = (data[i].hora).substring(0,2); // console.log("Hora: " + hora);
      //   min = (data[i].hora).substring(3,5); // console.log("Minuto: " + min);
      //   seg = (data[i].hora).substring(6,8); // console.log("Segundo: " + seg);

      //   // res = Date.UTC(ano, mes, dia, hora, min, seg);
      //   convertData(ano, mes, dia, hora, min, seg);
      //   lessProfundidade()

      //   profundidade.push([(res[count][0]), parseFloat(data[i].dados)]);
      //   // idEvento.push([res[count][0], parseInt(data[i].idEvento_dad)/*, parseFloat(data[i].dados)*/]);
      //   // console.log(data[i].idEvento_dad);
      //   count++;
      // }
      // console.log(profundidade);

      // function convertData(ano, mes, dia, hora, min, seg) {
      //   var d = new timezoneJS.Date(ano, mes, dia, hora, min, seg);
      //   var dtC = d._timeProxy; // Data Convertida
      //   var dtP = d._dateProxy; // Data do Proxy
      //   var dtA = dtP.strftime('%d/%m/%Y - %H:%M:%S'); // Data personalizada
      //   res.push([dtC, dtP, dtA]);
      // }

      // function lessProfundidade(argument) {
      //   // body...
      // }
    },
    error: function(data) {
      console.log(data);
    }
  });

	// We use an inline data source in the example, usually data would
	// be fetched from a server

	var data = [], totalPoints = 300;

	function getRandomData() {
		if (data.length > 0) {
			data = data.slice(1);
		}

		// Do a random walk
		while (data.length < totalPoints) {
			var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
			if (y < 0) {
				y = 0;
			} else if (y > 100) {
				y = 100;
			}

			data.push(y);
		}

		// Zip the generated y values with the x values
		var res = [];
		for (var i = 0; i < data.length; ++i) {
			res.push([i, data[i]])
		}

		return res;
	}

	// Set up the control widget

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

	var plot = $.plot("#placeholder", [ getRandomData() ], {
		series: {
			shadowSize: 0	// Drawing is faster without shadows
		},
		yaxis: {
			min: 0,
			max: 100
		},
		xaxis: {
			show: false
		}
	});

	function update() {
		plot.setData([getRandomData()]);

		// Since the axes don't change, we don't need to call plot.setupGrid()
		plot.draw();
		setTimeout(update, updateInterval);
	}

	update();

	// Add the Flot version string to the footer
	$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
});
