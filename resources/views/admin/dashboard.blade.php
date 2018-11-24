@extends ('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $title }}
        
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h4>{{ $totalSaldo }}</h4>

              <p>Saldo</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Saldo <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h4>{{ $totalPengeluaran }}</h4>

              <p>Pengeluaran</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            @if ($isSuperAdmin != 'hidden')
                <a href="{{ url('/admin/pengeluaran') }}" class="small-box-footer">Detail Pengeluaran <i class="fa fa-arrow-circle-right"></i></a>
            @else
                <a href="#" class="small-box-footer">Detail Pengeluaran <i class="fa fa-arrow-circle-right"></i></a>
            @endif
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4>{{ $totalCrewPayment }}</h4>

              <p>Total Crew Salary</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            @if ($isSuperAdmin != 'hidden')
                <a href="{{ url('/admin/crewSalary') }}" class="small-box-footer">Detail Crew Salary <i class="fa fa-arrow-circle-right"></i></a>
            @else
                <a href="#" class="small-box-footer">Detail Crew Salary <i class="fa fa-arrow-circle-right"></i></a>
            @endif
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4>{{ $usersRegistration }}</h4>

              <p>Customer Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('/admin/allUser') }}" class="small-box-footer">Detail User <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      
      <!-- AREA CHART -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Area Chart</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body" style="overflow-x:auto;">
          <div id="chart-container">FusionCharts will render here</div>
        </div>

        <!-- /.box-body -->
      </div>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Area Chart</h3>

          <div class="box-tools pull-right">
            
          </div>
        </div>
        <div class="box-body" style="overflow-x:auto;">
          <div id="chart-container2">FusionCharts will render here</div>
        </div>
        
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

        
    </section>
@endsection

@section('js')

<script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script src="https://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
<script type="text/javascript">

    FusionCharts.ready(function () {
        var revenueChart = new FusionCharts({
            type: 'column3d',
            renderAt: 'chart-container',
            width: '1400',
            height: '450',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                    "theme": "fusion",
            "caption": "AMC payable",
            "subcaption": "For cooling units",
            "xaxisname": "Unit",
            "yaxisname": "Amount payable (In USD)",
            "rotateValues": "0",
            "placeValuesInside": "0",
            "valueFontColor": "#000000",
            "valueBgColor": "#FFFFFF",
            "valueBgAlpha": "50",
            //Adding a suffix to a number
            "numberSuffix": "",
            //Adding a prefix to a number
            "numberPrefix": ""

                },

                "data": [
                    {
                        "label": "Jan 2018",
                        "value": "1"
                    },
                    {
                        "label": "Feb 2018",
                        "value": "2"
                    },
                    {
                        "label": "Mar 2018",
                        "value": "15"
                    }
                ]
            }
        });
        revenueChart.render();
    });

    FusionCharts.ready(function () {
        var revenueChart = new FusionCharts({
            type: 'column3d',
            renderAt: 'chart-container2',
            width: '1400',
            height: '450',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                        "caption": "Monthly revenue for last year",
                        "subCaption": "Harry's SuperMart",
                        "xAxisName": "Month",
                        "paletteColors": "#0075c2",
                        "valueFontColor": "#000000",
                        "baseFont": "Helvetica Neue,Arial",
                        "captionFontSize": "14",
                        "subcaptionFontSize": "14",
                        "subcaptionFontBold": "0",
                        "placeValuesInside": "1",
                        "rotateValues": "1",
                        "showShadow": "0",
                        "divlineColor": "#999999",               
                        "divLineIsDashed": "1",
                        "divlineThickness": "1",
                        "divLineDashLen": "1",
                        "divLineGapLen": "1",
                        "canvasBgColor": "#ffffff",

                },

                "data": [
                    {
                        "label": "Jan 2018",
                        "value": "1"
                    },
                    {
                        "label": "Feb 2018",
                        "value": "2"
                    },
                    {
                        "label": "Mar 2018",
                        "value": "15"
                    }
                ]
            }
        });
        revenueChart.render();
    });

</script>


@endsection

