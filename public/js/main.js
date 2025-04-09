new DataTable('#ride');
new DataTable('#approvedDispatcher');
new DataTable('#unApprovedDispatcher');
new DataTable('#orders');
new DataTable('#foods');

const orderChart = document.getElementById('singleValueChart').getContext('2d');
const ctx = document.getElementById('incomePayoutChart').getContext('2d');

// Gradients for Income and Payout
const gradientIncome = ctx.createLinearGradient(0, 0, 0, 400);
gradientIncome.addColorStop(0, 'rgba(0, 168, 89, 0.4)'); // for --pColor: #00a859
gradientIncome.addColorStop(1, 'rgba(0, 168, 89, 0)');

const gradientPayout = ctx.createLinearGradient(0, 0, 0, 400);
gradientPayout.addColorStop(0, 'rgba(253, 205, 17, 0.4)'); // for --aColor: #fdcd11
gradientPayout.addColorStop(1, 'rgba(253, 205, 17, 0)');

const gradient = orderChart.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(0, 168, 89, 0.4)'); // --pColor with transparency
gradient.addColorStop(1, 'rgba(0, 168, 89, 0)'); // Fully transparent at the bottom

// Chart Data and Configuration for Income and Payout Chart
const incomePayoutChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label: 'Income',
        data: [15000, 20000, 30000, 45000, 120000, 80000, 100000, 125000, 90000, 110000, 140000, 150000],
        borderColor: '#00a859', // Updated to --pColor
        backgroundColor: gradientIncome,
        borderWidth: 1.5,
        tension: 0.4,
        pointRadius: 3,
        pointBackgroundColor: '#00a859', // Updated to --pColor
        fill: true,
      },
      {
        label: 'Payout',
        data: [10000, 15000, 20000, 25000, 84000, 60000, 70000, 90000, 80000, 95000, 120000, 130000],
        borderColor: '#fdcd11', // Updated to --aColor
        backgroundColor: gradientPayout,
        borderWidth: 1.5,
        tension: 0.4,
        pointRadius: 3,
        pointBackgroundColor: '#fdcd11', // Updated to --aColor
        fill: true,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      tooltip: {
        enabled: true,
        mode: 'nearest',
        callbacks: {
          label: (context) => `₦${context.raw.toLocaleString()}`,
        },
      },
      legend: {
        position: 'top',
        align: 'center',
        labels: {
          color: '#333',
          font: {
            size: 12,
          },
        },
      },
    },
    scales: {
      x: {
        grid: {
          display: false, // Remove gridlines for x-axis
        },
        ticks: {
          color: '#555',
          font: {
            size: 12,
          },
        },
      },
      y: {
        grid: {
          display: false, // Remove gridlines for y-axis
        },
        ticks: {
          color: '#555',
          font: {
            size: 12,
          },
          callback: (value) => `₦${value / 1000}k`,
        },
        min: 0,
        max: 150000,
      },
    },
  },
});

// Chart Data and Configuration for Single Value Chart (Order Chart)
const singleValueChart = new Chart(orderChart, {
  type: 'line',
  data: {
    labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    datasets: [
      {
        label: 'Income',
        data: [5000, 7000, 3000, 9000, 12000, 8000, 10000], // Example data
        borderColor: '#00a859', // --pColor
        backgroundColor: gradient, // Use the same gradient as incomePayoutChart
        borderWidth: 2,
        tension: 0.4,
        pointRadius: 5,
        pointBackgroundColor: '#00a859', // --pColor
        fill: true,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      tooltip: {
        enabled: true,
        mode: 'nearest',
        callbacks: {
          label: (context) => `₦${context.raw.toLocaleString()}`,
        },
      },
      legend: {
        display: false, // Hide legend for single dataset
      },
    },
    scales: {
      x: {
        grid: {
          display: false, // Remove gridlines for x-axis
        },
        ticks: {
          color: '#555',
          font: {
            size: 12,
          },
        },
      },
      y: {
        grid: {
          display: false, // Remove gridlines for y-axis
        },
        ticks: {
          color: '#555',
          font: {
            size: 12,
          },
          callback: (value) => `₦${value / 1000}k`,
        },
        min: 0,
        max: 15000, // Adjust based on your data range
      },
    },
    onClick: (event, elements) => {
      if (elements.length > 0) {
        const index = elements[0].index;
        const day = singleValueChart.data.labels[index];
        const value = singleValueChart.data.datasets[0].data[index];
        document.getElementById('details').innerText = `Day: ${day}, Income: ₦${value.toLocaleString()}`;
      }
    },
  },
});

new DataTable('#members');
new DataTable('#viewMemberTable');
new DataTable('#viewDueTable');
new DataTable('#viewDuePayerTable');
new DataTable('#payoutTable');
new DataTable('#receivedTable');    