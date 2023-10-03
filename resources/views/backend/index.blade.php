
@extends('backend.includes.master')

@section('content')



      <div class="dashboard__cards wow animate__animated animate__fadeInUp">
        <div class="row">
          <div class="col-12 col-sm-4 col-lg-3">
            <div class="dash__card">
              <div class="card__content">
                <p>{{ __('admin.Number of students') }}</p>
                <h2>{{$student}}</h2>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-4 col-lg-3">
            <div class="dash__card">
              <div class="card__content">
                <p>{{ __('admin.Students who passed') }}</p>
                  <h2>{{$countPassStudent}}</h2>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-4 col-lg-3">
            <div class="dash__card">
              <div class="card__content">
                <p>{{ __('admin.Students who failed') }}</p>
                  <h2>{{$countFailStudent}}</h2>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-4 col-lg-3">
            <div class="dash__card">
              <div class="card__content">
                <p>{{ __('admin.The average pass score') }}</p>
                <h2>{{ round($passAverage) }}/{{$countPassStudent}}</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard__charts">
          <div class="row gy-4 justify-content-between">
            <div class="col-12 col-sm-5">
              <div class="bars__chart">
               <p>{{ __('admin.Average student per speciality') }}</p>
                <p class="numbers">35</p>
                <div id="chart"></div>
              </div>
            </div>
            <div class="col-12 col-sm-5">
              <div class="bars__chart">
                <p>{{ __('admin.Total inspector') }}</p>
                <p class="numbers" style="margin-bottom: 8rem;">426</p>

                <p style="padding-right: 62%;">Certificate</p>
                <p style="padding-left: 62%;">Enroll</p>
                <div id="candidate"></div>
              </div>
            </div>

            <div class="col-12 col-sm-12">
                <div class="bars__chart">
                  <p>{{ __('admin.Munciplity') }}</p>
                  <p class="numbers">35</p>
                  <div id="munciplity"></div>
                </div>
              </div>


              <div class="mt-5 col-12 col-sm-12">
                <div class="bars__chart">
                  <p>{{ __('admin.Sub Munciplity') }}</p>
                  <p class="numbers">35</p>
                  <div id="Submunciplity"></div>
                </div>
              </div>
          </div>
        </div>
      </div>



  @section('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
var options = {
  chart: {
    type: 'bar',
    height: 350,
  },
  dataLabels: {
    enabled: true
  },
  plotOptions: {
    bar: {
      distributed: true
    }
  },
  colors: ['#87b2a9', '#c92b1d', '#ffaa00', '#60b7e3', '#ac91c6'],
  series: [{
    name: 'Average Student',
    data: [
        @foreach($chart_courses as $chart_course)
            {{$chart_course->course_complete_count}},
        @endforeach
    ],
    colors: ['#87b2a9', '#c92b1d', '#ffaa00', '#60b7e3', '#ac91c6']
  }],
  xaxis: {
    categories: [
        @foreach($chart_courses as $chart_course)
            '{{$chart_course->title}}',
        @endforeach
    ]
  }, labels: ['Average Student'],
}

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
</script>
<script>

var options = {
  series: [
    {
      name: "Low",
      data: [15, 15, 15, 15, 15]
    },
    {
      name: "High",
      data: [32, 34, 36, 38, 36]
    }

  ],
  chart: {
    height: 350,
    type: 'line',
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: true
  },
  stroke: {
    curve: 'straight'
  },
  grid: {
    borderColor: '#111',
    xaxis: {
      lines: {
        show: true
      }
    }
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
  }
};

var chart = new ApexCharts(document.querySelector("#line-chart"), options);
chart.render();
</script>
<script>
var options = {
  series: [{{round($total_user)}}],
  colors: ["#8cbca8"],
  chart: {
    type: 'radialBar',
    offsetY: -20,
    height: 480,
    sparkline: {
      enabled: true
    }
  },
  dataLabels: {
    enabled: true
  },
  plotOptions: {
    radialBar: {
      startAngle: -90,
      endAngle: 90,
      track: {
        background: "#c92b1d",
        strokeWidth: '100%',
        dropShadow: {
          enabled: true,
          top: 2,
          left: 0,
          color: '#999',
          opacity: 1,
          blur: 2
        }
      },
      dataLabels: {
        name: {
          show: false
        },
        value: {
          offsetY: -2,
          fontSize: '22px'
        }
      }
    }
  },
  grid: {
    padding: {
      top: -10
    },

  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'light',
      inverseColors: false,
      opacityFrom: 1,
      color: ["#8cbca8"],
      opacityTo: 1,
      stops: [0, 50, 53, 91]
    },
  },
  labels: ['Average Results'],
};

var chart = new ApexCharts(document.querySelector("#candidate"), options);
chart.render();
</script>



<script>
    var options = {
      chart: {
        type: 'bar',
        height: 350,
      },
      plotOptions: {
        bar: {
          distributed: true
        }
      },
      colors: ['#87b2a9', '#c92b1d', '#ffaa00', '#60b7e3', '#ac91c6'],
      series: [{
        name: 'Average Student',
        data: [
            @foreach($municipalities as $municipality)
                {{$municipality->countmunicipality}},
            @endforeach
        ],
        colors: ['#87b2a9', '#c92b1d', '#ffaa00', '#60b7e3', '#ac91c6']
      }],
      xaxis: {
        categories: [
          @if($municipalities->count() > 0)
            @foreach($municipalities as $municipality)

            '{{@$municipality->studentMunicipality['name']}}',

            @endforeach
          @endif
        ]
      }
    }

    var chart = new ApexCharts(document.querySelector("#munciplity"), options);
    chart.render();
    </script>


<script>
    var options = {
      chart: {
        type: 'bar',
        height: 350,
      },
      plotOptions: {
        bar: {
          distributed: true
        }
      },
      colors: ['#87b2a9', '#c92b1d', '#ffaa00', '#60b7e3', '#ac91c6'],
      series: [{
        name: 'Average Student',
        data: [
          @if($sub_municipalities->count() > 0)
            @foreach($sub_municipalities as $submunicipality)
                {{@$submunicipality->countsubmunicipality}},
            @endforeach
          @endif
        ],
        colors: ['#87b2a9', '#c92b1d', '#ffaa00', '#60b7e3', '#ac91c6']
      }],
      xaxis: {
        categories: [
          @if($sub_municipalities->count() > 0)
            @foreach($sub_municipalities as $submunicipality)

            '{{@$submunicipality->subMunicipality['name']}}',

            @endforeach
          @endif
        ]
      }
    }

    var chart = new ApexCharts(document.querySelector("#Submunciplity"), options);
    chart.render();
    </script>

@endsection

@endsection
