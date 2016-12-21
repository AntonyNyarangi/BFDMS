$(document).ready(function(){
  $.ajax({
    url: "http://localhost/BFDMS/mortalityDataforgraph.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var days = [];
      var values = [];

      for(var i in data){
        days.push(data[i].day);
        values.push(data[i].number);
      }

      var chartdata = {
        labels: days,
        datasets: [
          {
            label: 'Combined House Mortality - per day',
            backgroundColor: '#373737',
            borderColor: '#373737',
            hoverBackgroundColor: 'black',
            hoverBorderColor: 'black',
            data: values
          }
        ]
      };
      var ctx = $("#mortalitycanvas");
      var barGraph = new Chart(ctx,{
        type: 'bar',
        data: chartdata
      })
    },
    error: function(data) {
      console.log(data);
    }

  })
});
