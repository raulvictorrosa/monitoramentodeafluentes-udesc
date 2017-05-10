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

      var dia, mes, ano, hora, min, seg, res = [], count = 0;
      for(var i in data) {
        console.log("\n" + data[i].data);
        ano = (data[i].data).substring(0,4); // console.log("Ano: " + ano);
        mes = (data[i].data).substring(5, 7); // console.log("Mês: " + mes);
        dia = (data[i].data).substring(8, 10); // console.log("Dia: " + dia);

        console.log("\n" + data[i].hora);
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
      console.log(profundidade);

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
    },
    error: function(data) {
      console.log(data);
    }
  });
});


google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Director (Year)',  'Rotten Tomatoes', 'IMDB'],
    ['Alfred Hitchcock (1935)', 8.4,         7.9],
    ['Ralph Thomas (1959)',     6.9,         6.5],
    ['Don Sharp (1978)',        6.5,         6.4],
    ['James Hawes (2008)',      4.4,         6.2]
  ]);

  var options = {
    title: 'The decline of \'The 39 Steps\'',
    vAxis: {title: 'Accumulated Rating'},
    isStacked: true
  };

  var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));

  chart.draw(data, options);
}
