// script.js
const elTemp = document.getElementById('card-temp');
const elHum = document.getElementById('card-hum');
const elGas = document.getElementById('card-gas');
const elPm = document.getElementById('card-pm');
const elStatus = document.getElementById('aq-status');
const historyTableBody = document.querySelector('#history-table tbody');
let chart;

async function fetchData(){
  try {
    const res = await fetch('api.php');
    const json = await res.json();
    if(json.error){ console.error(json.error); return; }

    const latest = json.latest || {};
    const history = json.history || [];

    // update cards (field baru)
    elTemp.textContent = (latest.temperature !== undefined ? latest.temperature : '--') + ' °C';
    elHum.textContent = (latest.humidity !== undefined ? latest.humidity : '--') + ' %';
    elGas.textContent = (latest.gas_status !== undefined ? latest.gas_status : '--') + ' ppm';
    elPm.textContent = (latest.dust !== undefined ? latest.dust : '--') + ' µg/m³';

    // status
    elStatus.textContent = 'AIR QUALITY STATUS: ' 
        + qualityStatus(latest.gas_status, latest.dust);

    // update history table
    historyTableBody.innerHTML = '';
    history.forEach(row => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${row.waktu}</td>
        <td>${row.temperature ?? '-'}</td>
        <td>${row.humidity ?? '-'}</td>
        <td>${row.gas_status ?? '-'}</td>
        <td>${row.dust ?? '-'}</td>
      `;
      historyTableBody.appendChild(tr);
    });

    // chart data
    const chrono = history.slice().reverse();
    const labels = chrono.map(r => r.waktu.replace(' ', '\n'));
    const tempData = chrono.map(r => r.temperature ?? null);
    const humData = chrono.map(r => r.humidity ?? null);
    const pmData = chrono.map(r => r.dust ?? null);

    updateChart(labels, tempData, humData, pmData);

  } catch (err) {
    console.error('Fetch error', err);
  }
}

function qualityStatus(co2, debu) {
  co2 = Number(co2) || 0;
  debu = Number(debu) || 0;
  if (debu < 35 && co2 < 800) return "HEALTHY";
  if (debu < 75 && co2 < 1200) return "MODERATE";
  return "UNHEALTHY";
}

function updateChart(labels, tempData, humData, pmData){
  const ctx = document.getElementById('trendChart').getContext('2d');
  if(chart) {
    chart.data.labels = labels;
    chart.data.datasets[0].data = tempData;
    chart.data.datasets[1].data = humData;
    chart.data.datasets[2].data = pmData;
    chart.update();
    return;
  }

  chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels,
      datasets: [
        { label: 'Temp (°C)', data: tempData, borderWidth:2, fill:false, tension:0.3, borderColor:'#5ce1d5' },
        { label: 'Humidity (%)', data: humData, borderWidth:2, fill:false, tension:0.3, borderColor:'#6ea8fe' },
        { label: 'PM2.5', data: pmData, borderWidth:2, fill:false, tension:0.3, borderColor:'#9be86b' }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position:'top', labels:{ color:'#cfe9e6' } }
      },
      scales: {
        x: { ticks:{ color:'#cfd8d8' } },
        y: { ticks:{ color:'#cfd8d8' } }
      }
    }
  });
}

// fetch pertama, interval 5 detik
fetchData();
setInterval(fetchData, 5000);
