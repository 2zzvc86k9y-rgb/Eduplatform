$(function() {
     // chart3
     var ctx = document.getElementById('chart3').getContext('2d');
     var myChart = new Chart(ctx, {
         type: 'pie',
         data: {
             labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
             datasets: [{
                 data: [12, 19, 3, 5, 2, 3],
                 backgroundColor: [
                     '#0d6efd',
                     '#6f42c1',
                     '#d63384',
                     '#fd7e14',
                     '#15ca20',
                     '#0dcaf0'
                 ],
                 borderWidth: 1.5
             }]
         },
         options: {
            maintainAspectRatio: false,
            plugins: {
				legend: {
					position:'bottom',
					display: true,
				}
			},
            
         }
     });
    


      






  


    






  
    
});