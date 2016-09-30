// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['bar']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {
  // Create the data table.
  var data = google.visualization.arrayToDataTable([
    ['Year', 'Sales', 'Expenses', 'Profit'],
    ['2014', 1000, 400, 200],
    ['2015', 1170, 460, 250],
    ['2016', 660, 1120, 300],
    ['2017', 1030, 540, 350]
  ]);

  // Set chart options
  var options = {
    chart: {
      title: 'Company Performance',
      subtitle: 'Sales, Expenses, and Profit: 2014-2017',
    }
  };

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
  chart.draw(data, options);
}