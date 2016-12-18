$(document).ready(function(){
  $.ajax({
    url: "http://localhost/BFMS/feedconsumptiondataforgraph.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var days = [];
      var bags = [];

      for(var i in data){
        days.push(data[i].day);
        bags.push(data[i].amount);
      }

      var chartdata = {
        labels: days,
        datasets: [
          {
            label: 'Combined house consumption - per day',
            backgroundColor: '#373737',
            borderColor: '#373737',
            hoverBackgroundColor: 'black',
            hoverBorderColor: 'black',
            data: bags
          }
        ]
      };
      var ctx = $("#feedconsumptioncanvas");
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
