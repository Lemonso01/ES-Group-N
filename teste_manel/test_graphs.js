document.addEventListener('DOMContentLoaded', function() {
    const ctxTemperature = document.getElementById('temperatureChart').getContext('2d');
    const ctxWaterTemperature = document.getElementById('waterTemperatureChart').getContext('2d');
    const ctxHumidity = document.getElementById('humidityChart').getContext('2d');
    const ctxWaveHeight = document.getElementById('waveHeightChart').getContext('2d');

    // Sample data for the last 24 hours
    const labels = Array.from({ length: 24 }, (_, i) => `${i}h`);

    const temperatureData = Array.from({ length: 24 }, () => Math.random() * (30 - 20) + 20);
    const waterTemperatureData = Array.from({ length: 24 }, () => Math.random() * (25 - 15) + 15);
    const humidityData = Array.from({ length: 24 }, () => Math.random() * (100 - 40) + 40);
    const waveHeightData = Array.from({ length: 24 }, () => Math.random() * (5 - 0.5) + 0.5);

    const createChart = (ctx, label, data, borderColor) => {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderColor: borderColor,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Time'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: label
                        }
                    }
                }
            }
        });
    };

    createChart(ctxTemperature, 'Temperature (°C)', temperatureData, 'red');
    createChart(ctxWaterTemperature, 'Water Temperature (°C)', waterTemperatureData, 'blue');
    createChart(ctxHumidity, 'Humidity (%)', humidityData, 'green');
    createChart(ctxWaveHeight, 'Wave Height (m)', waveHeightData, 'purple');
});
