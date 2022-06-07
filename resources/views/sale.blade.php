<x-layout>
    <div class="row">
        <div class="col-lg">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h4 class="m-0 d-flex align-items-center">Sale {{ $date->isToday() ? 'Today' : "({$date->format('d M Y')})"  }}</h4>
                            <h4>Total(mmk) : {{ $total }}</h4>
                        </div>
                        <form method="get" class="col-7 col-lg-5">
                            <div class="input-group">
                                <input type="date" name="date" class="form-control">
                                <div class="input-group-prepend">
                                    <button class="btn btn-success">
                                        <i class="mdi mdi-checkbox-marked-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Invoice No.</th>
                          <th>Customer</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sales as $sale)
                        <tr>
                          <td><a href="/sale/print/{{$sale->id}}">{{ $sale->invoice_no }}</a></td>
                          <td>{{ $sale->customer }}</td>
                          <td>{{ $sale->total }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <x-paginator :type="$sales" />
                  </div>
                </div>
            </div>
        </div>

        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Weekly Sale Rates </h4>
                  <canvas id="barChart" style="height:230px"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script src="/js/Chart.min.js"></script>
<script>
    $(function() {
        'use strict';
        var data = {
            labels: {!! json_encode($dates) !!},
            datasets: [{
            label: 'Total Price',
            data: {!! json_encode($weeklyDailySales) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(10, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(10, 159, 64, 1)',
            ],
            borderWidth: 1,
            fill: false
            }]
        };

        var options = {
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true
                },
                gridLines: {
                color: "rgba(204, 204, 204,0.1)"
                }
            }],
            xAxes: [{
                gridLines: {
                color: "rgba(204, 204, 204,0.1)"
                }
            }]
            },
            legend: {
            display: false
            },
            elements: {
            point: {
                radius: 0
            }
            }
        };

        // Get context with jQuery - using jQuery's .get() method.
        if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: data,
            options: options
            });
        }
    });
</script>