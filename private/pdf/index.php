<?php
?>

<DOCTYPE html>

<html>
    <head>
        <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
        <script src="http://localhost:81/private/PDF/printjs/printjs.js" charset="utf-8"></script>
        <link rel="stylesheet" href="http://localhost:81/private/PDF/printjs/printjs.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
        <script>

            const globalUrl = 'http://localhost:81/';
            async function getData(uri){
                const url = globalUrl + uri ;
                try {
                    const response = await axios.get(url);
                    return response.data ;
                } catch (error) {
                    console.error(error);
                }
            }


            async function print() {
                const filename  = 'ThisIsYourPDFFilename.pdf';
                 const data = await getData('private/demo.php');
                // document.getElementById('deneme').innerHTML = data ;

                html2canvas(document.getElementById('deneme'), {
                    onrendered: function(canvas) {
                        let pdf = new jsPDF('p', 'mm', 'a4');
                        pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
                        pdf.save(filename);
                    }
                });

            }


        </script>

    </head>
    <body>
    <div id="deneme" style="max-width: 400px ; max-height: 600px">

        <canvas id="myChart" width="400" height="600"></canvas>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </div>
    <button onclick="print()">Tikla</button>


    </body>
</html>