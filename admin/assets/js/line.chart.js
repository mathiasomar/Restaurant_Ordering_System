const ctx = document.getElementById('barChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Income in Ksh.',
            data: [2000, 2500, 1500, 3000, 2200, 4500, 2100],
            backgroundColor: [
                '#800080'
                /*'rgba(255, 99, 132, 0.2)',
                '#00ff00',
                '#00ff',
                '#042331',
                '#808000',
                'aqua',
                'orange'*/
            ],
            borderColor: [
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});