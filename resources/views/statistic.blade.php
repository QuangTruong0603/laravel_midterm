<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Statistic</title>
</head>
<x-app-layout>
    <x-slot name="header">
        <div class="container">

            <h2>Sleep Records Statistics</h2>
            <form id="month-year-form">
                <label for="month">Tháng:</label>
                <input type="number" id="month" name="month" min="1" max="12">
                <label for="year">Năm:</label>
                <input type="number" id="year" name="year" min="1900">
                <button type="submit" id="submit">Xem biểu đồ</button>
            </form>
            <!-- Thêm thư viện Chart.js-->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Thêm thẻ canvas để vẽ biểu đồ -->
            <canvas id="sleepChart"></canvas>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <!-- Thêm mã JavaScript để xử lý dữ liệu và vẽ biểu đồ -->
            <script>
                const form = document.getElementById('month-year-form');
                const ctx = document.getElementById('sleepChart').getContext('2d');

                document.getElementById('submit').addEventListener('click', async (event) => {
                    event.preventDefault();
                    const month = document.getElementById('month').value;
                    const year = document.getElementById('year').value;

                    const response = await fetch('/data');

                    // Parse the response body as JSON
                    const sleepRecords = await response.json();

                    // Lọc dữ liệu theo tháng và năm đã chọn
                    const filteredData = sleepRecords.filter(record => {
                        const recordDate = new Date(record.sleep_date);

                        return recordDate.getMonth() + 1 === parseInt(month) && recordDate.getFullYear() ===
                            parseInt(year);
                    });
                    // Tính tổng thời gian ngủ theo ngày
                    const sleepDataByDate = filteredData.reduce((acc, record) => {
                        const recordDate = new Date(record.sleep_date);
                        const dateString =
                            `${recordDate.getDate()}-${recordDate.getMonth() + 1}-${recordDate.getFullYear()}`;

                        let [hours, minutes, seconds] = (record.sleep_time).split(":").map(num => parseFloat(
                            num));
                        let totalMinute = (hours * 3600 + minutes * 60 + seconds) / 60;
                        let sleepMins = Math.floor(totalMinute);

                        [hours, minutes, seconds] = (record.wake_time).split(":").map(num => parseFloat(num));
                        totalMinute = (hours * 3600 + minutes * 60 + seconds) / 60;
                        let wakeMins = Math.floor(totalMinute);

                        let diffMins = wakeMins - sleepMins;
                        if (diffMins < 0) {
                            diffMins += 1440; // add 24 hours in minutes
                        }
                        const duration = (diffMins / 60).toFixed(2);

                        if (!acc.has(dateString)) {
                            acc.set(dateString, 0);
                        }

                        acc.set(dateString, acc.get(dateString) + parseFloat(duration));
                        return acc;
                    }, new Map());

                    const sleepDataObj = {};
                    for (let [key, value] of sleepDataByDate) {
                        sleepDataObj[key] = value;
                    }

                    // Vẽ biểu đồ
                    const chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(sleepDataObj),
                            datasets: [{
                                label: 'Thời gian ngủ (giờ)',
                                data: Object.values(sleepDataObj),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                            }, ],
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                },
                            },
                        },
                    });

                    // Đưa ra lời khuyên dựa trên kết quả
                    const sleepDataValues = Array.from(sleepDataByDate).map(([key, value]) => value);
                    const averagesleep_time = (sleepDataValues.length > 0 ?
                        Object.values(sleepDataByDate).reduce((acc, val) => acc + parseFloat(val), 0) /
                        Object.values(sleepDataByDate).length :
                        0).toFixed(2);
                    console.log('sleepDataByDate:', sleepDataByDate);
                    console.log('sleepDataValues:', sleepDataValues);
                    if (sleepDataValues.length === 0) {
                        toastr.info('Không có dữ liệu giấc ngủ cho tháng và năm đã chọn hoặc dữ liệu đã bị lỗi');
                    } else {
                        const averagesleep_time = (sleepDataValues.length > 0 ?
                            sleepDataValues.reduce((acc, val) => acc + parseFloat(val), 0) /
                            sleepDataValues.length :
                            0).toFixed(2);
                        if (averagesleep_time < 6.5) {
                            toastr.info(`Thời gian ngủ trung bình của bạn là`, 'Bạn nên ngủ nhiều hơn')
                        } else if (averagesleep_time > 9.5) {
                            toastr.info(`Thời gian ngủ trung bình của bạn là ${averagesleep_time}`,
                                'Bạn nên ngủ ít hơn')
                        } else {
                            toastr.info(`Thời gian ngủ trung bình của bạn là ${averagesleep_time}`,
                                'Giấc ngủ của bạn rất ổn định')
                        }
                    }

                })
            </script>
    </x-slot>
</x-app-layout>
