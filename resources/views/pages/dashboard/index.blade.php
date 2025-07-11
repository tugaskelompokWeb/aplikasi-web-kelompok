@extends('layouts.components.app')

@section('title', 'Project')

@section('content')
@if(auth()->user()->hasRole(['manager', 'developer']))

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <!--begin::Container-->
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-lg-3 col-6 col-md-3">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>{{ $totalServis ?? 0 }}</h3>
                <p>Total Servis Masuk</p>
            </div>
            <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
                    ></path>
                  </svg>
            <a href="{{ route('servis.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                Lihat Detail <i class="bi bi-link-45deg"></i></a>
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-lg-3 col-6 col-md-3">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>{{ $totalBarang ?? 0 }}</h3>
                <p>Total Barang</p>
            </div>
            <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
            <a href="{{ route('barang.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                Lihat Detail <i class="bi bi-link-45deg"></i></a>
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- fix for small devices only -->
      <!-- <div class="clearfix hidden-md-up"></div> -->
      <div class="col-lg-3 col-6 col-md-3">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>{{ $totalTransaksi ?? 0 }}</h3>
                <p>Total Transaksi</p>
            </div>
            <svg
                class="small-box-icon"
                fill="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
                >
                <path
                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                ></path>
                </svg>
            <a href="{{ route('transaksi.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                Lihat Detail <i class="bi bi-link-45deg"></i></a>
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-lg-3 col-6 col-md-3">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>{{ $totalPelanggan ?? 0 }}</h3>
                <p>Total Pelanggan</p>
            </div>
            <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                    ></path>
                  </svg>
            <a href="{{ route('pelanggan.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
              Lihat Detail <i class="bi bi-link-45deg"></i></a>
        </div>
    </div>

</div>

<form method="GET" action="{{ route('dashboard') }}" class="row mb-4">
    <div class="col-md-6">
        <label for="filter_kendaraan" class="form-label">Filter Kendaraan:</label>
        <select name="filter_kendaraan" id="filter_kendaraan" class="form-select w-auto d-inline" onchange="this.form.submit()">
            <option value="harian" {{ $filterKendaraan === 'harian' ? 'selected' : '' }}>Harian</option>
            <option value="bulanan" {{ $filterKendaraan === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="filter_barang" class="form-label">Filter Barang:</label>
        <select name="filter_barang" id="filter_barang" class="form-select w-auto d-inline" onchange="this.form.submit()">
            <option value="harian" {{ $filterBarang === 'harian' ? 'selected' : '' }}>Harian</option>
            <option value="bulanan" {{ $filterBarang === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
        </select>
    </div>
</form>

    <div class="row">
        <div class="col-lg-6">
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
        </div>

        <div class="col-lg-6">
            <figure class="highcharts-figure">
                <div id="container-barang"></div>
            </figure>
        </div>
    </div>

        <div class="row">
            <!-- Grafik Pendapatan -->
            <div class="col-lg-7 connectedSortable">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Grafik Pendapatan</h3>
                <select id="chartFilter" class="form-select w-auto">
                    <option value="daily" selected>Harian</option>
                    <option value="weekly">Mingguan</option>
                    <option value="monthly">Bulanan</option>
                </select>
                </div>
                <div class="card-body">
                <div id="revenue-chart"></div>
                </div>
            </div>
            </div>

    <!-- Browser Usage -->
    <div class="col-lg-5 connectedSortable">
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">Top 5 Barang Sering Dibeli</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12"><div id="pie-chart"></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>


<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tbody tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-description {
    margin: 0.3rem 10px;
}

 </style>

        <script>
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Jumlah Mobil'
    },
    subtitle: {
        text:
            'Source: Database'
    },
    xAxis: {
        categories: [
            @foreach ($jumlahPlat as $item)
                ' {{ $item->merek }} ',
            @endforeach
        ],
        crosshair: true,
        accessibility: {
            description: ' '
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Kendaraan'
        }
    },
    tooltip: {
        valueSuffix: ' (Mobil)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Jumlah Kendaraan',
            data: [
                @foreach ($jumlahPlat as $item)
                {{ $item->jumlah }},
                @endforeach
            ]
        }
    ]
});
Highcharts.chart('container-barang', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Jumlah Barang'
    },
    subtitle: {
        text:
            'Source: Database'
    },
    xAxis: {
        categories: [
            @foreach ($jumlahBarang as $item)
                ' {{ $item->kategori }} ',
            @endforeach
        ],
        crosshair: true,
        accessibility: {
            description: ' '
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Barang'
        }
    },
    tooltip: {
        valueSuffix: ' (Pcs)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Jumlah Stock',
            data: [
                @foreach ($jumlahBarang as $item)
                {{$item->jumlahBarang }},
                @endforeach
            ]
        }
    ]
});
</script>

<script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    >
</script>


<script>
    const chartOptions = {
  series: [],
  chart: {
    height: 300,
    type: 'area',
    toolbar: { show: false }
  },
  colors: ['#0d6efd', '#20c997'],
  dataLabels: { enabled: false },
  stroke: { curve: 'smooth' },
  xaxis: {
    type: 'category',
    categories: []
  },
  yaxis: {
    labels: {
      formatter: function (val) {
        return new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0,
          maximumFractionDigits: 0
        }).format(val);
      }
    }
  },
  tooltip: {
    x: { format: 'yyyy-MM-dd' },
    y: {
      formatter: function (val) {
        return new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0
        }).format(val);
      }
    }
  }
};


    const chart = new ApexCharts(document.querySelector("#revenue-chart"), chartOptions);
    chart.render();

    const chartData = {
      monthly: {
        categories: @json($monthlyCategories),
        revenue: @json($monthlyRevenue),
        profit: @json($monthlyProfit),
      },
      daily: {
        categories: @json($dailyCategories),
        revenue: @json($dailyRevenue),
        profit: @json($dailyProfit),
      },
      weekly: {
        categories: @json($weeklyCategories),
        revenue: @json($weeklyRevenue),
        profit: @json($weeklyProfit),
      }
    };

    function updateChartView(filter) {
      const data = chartData[filter];
      chart.updateOptions({
        series: [
          { name: "Revenue", data: data.revenue },
          { name: "Profit", data: data.profit },
        ],
        xaxis: { categories: data.categories }
      });
    }

    document.querySelector("#chartFilter").addEventListener("change", function (e) {
      updateChartView(e.target.value);
    });

    updateChartView('daily');

    const pie_chart_options = {
        series: @json($topBarangData),
        chart: {
          type: 'donut',
        },
        labels: @json($topBarangLabels),
        dataLabels: {
          enabled: false,
        },
        colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1'],
      };

      const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
      pie_chart.render();
  </script>



@else
<div class="alert alert-danger mt-4">
    <h4>Akses Ditolak</h4>
    <p>Anda tidak memiliki izin untuk mengakses dashboard ini.</p>
</div>
@endif

  @endsection
