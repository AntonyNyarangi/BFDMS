$(document).ready(function(){
  $.ajax({
    url: "http://localhost/BFDMS/feedconsumptiondataforgraph.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var housetotalperdate = [];
      var bags = [];

      for(var i in data){
        housetotalperdate.push(data[i].housetotalperdate);
        bags.push(data[i].amount);
      }

      var chartdata = {
        labels: housetotalperdate,
        datasets: [
          {
            label: 'Total number of bags consumed',
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
