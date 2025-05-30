<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Thống kê đơn hàng</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --primary: #3b82f6;
      --success: #16a34a;
      --danger: #dc2626;
      --warning: #facc15;
      --info: #0ea5e9;
      --bg: #f8fafc;
      --text: #1e293b;
      --muted: #64748b;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: white;
      padding: 2rem 1rem;
      box-shadow: 0 4px 10px rgb(0 0 0 / 0.08);
      text-align: center;
      margin-bottom: 2rem;
    }

    header h1 {
      color: var(--primary);
      font-weight: 700;
      font-size: 2rem;
      user-select: none;
    }

    main.container {
      flex-grow: 1;
      max-width: 1140px;
    }

    form.filter-form {
      background: white;
      padding: 1.5rem 1.5rem 1.25rem;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
      margin-bottom: 2rem;
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
      align-items: flex-end;
    }

    form.filter-form label {
      font-weight: 600;
      color: var(--text);
      margin-bottom: 0.35rem;
      display: block;
    }

    form.filter-form input[type="date"] {
      border-radius: 8px;
      border: 1.5px solid #ced4da;
      padding: 0.5rem 0.75rem;
      width: 180px;
      transition: border-color 0.3s;
    }

    form.filter-form input[type="date"]:focus {
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 6px var(--primary);
    }

    form.filter-form button {
      background-color: var(--primary);
      border: none;
      color: white;
      padding: 0.65rem 1.4rem;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      flex-shrink: 0;
      transition: background-color 0.3s;
    }

    form.filter-form button:hover {
      background-color: #2563eb;
    }

    /* Card thống kê */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
      gap: 1.5rem;
      margin-bottom: 3rem;
    }

    .card-stat {
      background: white;
      border-radius: 14px;
      padding: 1.75rem 1.25rem;
      box-shadow: 0 2px 10px rgb(0 0 0 / 0.08);
      text-align: center;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      user-select: none;
    }

    .card-stat:hover {
      transform: translateY(-6px);
      box-shadow: 0 14px 25px rgb(0 0 0 / 0.12);
    }

    .card-stat .label {
      color: var(--muted);
      font-size: 0.9rem;
      margin-bottom: 0.6rem;
      font-weight: 600;
      letter-spacing: 0.02em;
      text-transform: uppercase;
    }

    .card-stat .value {
      font-size: 2.1rem;
      font-weight: 700;
      line-height: 1;
    }

    .card-stat .value.success {
      color: var(--success);
      font-size: 30px;
    }

    .card-stat .value.primary {
      color: var(--primary);
    }

    .card-stat .value.info {
      color: var(--info);
      font-size: 1.5rem;
      margin-top: 0.15rem;
    }

    .card-stat small {
      display: block;
      margin-top: 0.25rem;
      color: #6c757d;
      font-weight: 500;
    }

    /* Biểu đồ */
    .charts {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
      margin-bottom: 3rem;
    }

    .chart-container {
      flex: 1 1 48%;
      background: white;
      padding: 1.5rem 1.5rem 2rem;
      border-radius: 14px;
      box-shadow: 0 2px 10px rgb(0 0 0 / 0.07);
      display: flex;
      flex-direction: column;
    }

    .chart-container h6 {
      margin-bottom: 1.25rem;
      font-weight: 700;
      color: var(--primary);
      user-select: none;
    }

    canvas {
      max-height: 320px !important;
      user-select: none;
    }

    /* Xuất CSV */
    .export-wrapper {
      text-align: center;
      margin-bottom: 3rem;
    }

    .export-wrapper button {
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
      padding: 0.75rem 2.25rem;
      border-radius: 10px;
      font-weight: 700;
      font-size: 1.15rem;
      cursor: pointer;
      transition: all 0.3s ease;
      user-select: none;
    }

    .export-wrapper button:hover {
      background: var(--primary);
      color: white;
    }

    footer {
      background: white;
      border-top: 1px solid #e2e8f0;
      text-align: center;
      padding: 1rem 0.5rem;
      font-size: 0.9rem;
      color: var(--muted);
      user-select: none;
    }

    @media (max-width: 768px) {
      .chart-container {
        flex: 1 1 100%;
      }
    }
    header {
  background-color: white;
  padding: 1rem 2rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}

.title h1 {
  font-size: 1.75rem;
  color: #3b82f6; /* màu primary */
  font-weight: 700;
}

.logo img {
  height: 50px;
  width: auto;
  display: block;
}

/* Responsive: nhỏ hơn 600px, logo xuống dưới, căn giữa */
@media (max-width: 600px) {
  .header-container {
    flex-direction: column;
    gap: 0.75rem;
  }

  .title h1 {
    font-size: 1.5rem;
    text-align: center;
  }

  .logo {
    text-align: center;
  }

  .logo img {
    height: 40px;
  }
}

  </style>
</head>
<body>

<header>
  <div class="header-container">
    <div class="title">
      <h1>📊 Thống kê đơn hàng</h1>
    </div>
    <div class="logo">
      <a href="/homepage">
        <img src="{{ asset('images/manhinhdangnhap/logo.png') }}" alt="Logo" />
      </a>
    </div>
  </div>
</header>

  <main class="container">

    <form method="GET" action="{{ route('statistics.orders') }}" class="filter-form" novalidate>
      <div>
        <label for="from_date">Từ ngày</label>
        <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">
      </div>
      <div>
        <label for="to_date">Đến ngày</label>
        <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">
      </div>
      <div>
        <button type="submit" aria-label="Lọc dữ liệu">Lọc dữ liệu</button>
      </div>
    </form>

    <section class="stats-grid" aria-label="Tổng quan thống kê đơn hàng">
      <article class="card-stat" role="region" aria-labelledby="totalOrdersLabel">
        <div class="label" id="totalOrdersLabel">Tổng đơn hàng</div>
        <div class="value">{{ $totalOrders }}</div>
      </article>
      <article class="card-stat" role="region" aria-labelledby="totalRevenueLabel">
        <div class="label" id="totalRevenueLabel">Tổng doanh thu</div>
        <div class="value success">{{ number_format($totalRevenue, 0, ',', '.') }} đ</div>
      </article>
      <article class="card-stat" role="region" aria-labelledby="voucherOrdersLabel">
        <div class="label" id="voucherOrdersLabel">Đơn có voucher</div>
        <div class="value primary">{{ $voucherOrders }}</div>
      </article>
      <article class="card-stat" role="region" aria-labelledby="popularStatusLabel">
        <div class="label" id="popularStatusLabel">Trạng thái phổ biến</div>
        <div class="value info mb-1">{{ $ordersByStatus->sortDesc()->keys()->first() ?? '-' }}</div>
        <small>({{ $ordersByStatus->max() ?? 0 }})</small>
      </article>
    </section>

    <section class="charts" aria-label="Biểu đồ thống kê đơn hàng">
      <div class="chart-container">
        <h6>📆 Đơn hàng theo tháng</h6>
        <canvas id="ordersByMonthChart" aria-label="Biểu đồ cột đơn hàng theo tháng" role="img"></canvas>
      </div>
      <div class="chart-container">
        <h6>📌 Đơn hàng theo trạng thái</h6>
        <canvas id="ordersByStatusChart" aria-label="Biểu đồ tròn đơn hàng theo trạng thái" role="img"></canvas>
      </div>
    </section>

    <div class="export-wrapper">
      <form method="GET" action="{{ route('statistics.orders.export') }}">
        <input type="hidden" name="from_date" value="{{ request('from_date') }}">
        <input type="hidden" name="to_date" value="{{ request('to_date') }}">
        <button type="submit" aria-label="Xuất dữ liệu CSV">📤 Xuất CSV</button>
      </form>
    </div>

  </main>

  <footer>
    © {{ date('Y') }} Your Company. All rights reserved.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const ordersByMonthChart = new Chart(document.getElementById('ordersByMonthChart'), {
      type: 'bar',
      data: {
        labels: {!! json_encode($ordersByMonth->keys()) !!},
        datasets: [{
          label: 'Số đơn hàng',
          data: {!! json_encode($ordersByMonth->values()) !!},
          backgroundColor: 'rgba(59, 130, 246, 0.8)',
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });

    const ordersByStatusChart = new Chart(document.getElementById('ordersByStatusChart'), {
      type: 'pie',
      data: {
        labels: {!! json_encode($ordersByStatus->keys()) !!},
        datasets: [{
          data: {!! json_encode($ordersByStatus->values()) !!},
          backgroundColor: [
            'rgba(25, 135, 84, 0.8)',
            'rgba(255, 193, 7, 0.8)',
            'rgba(13, 110, 253, 0.8)',
            'rgba(220, 53, 69, 0.8)',
            'rgba(111, 66, 193, 0.8)'
          ]
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
      }
    });
  </script>
</body>
</html>
