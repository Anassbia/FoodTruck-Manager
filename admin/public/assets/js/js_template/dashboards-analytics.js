function analys_data() {

    $.ajax({
        url: "/orders-by-date",
        method: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                const weekLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                const weekOrders = {
                    'Week 1': 0,
                    'Week 2': 0,
                    'Week 3': 0,
                    'Week 4': 0
                };
            
                response.data.forEach(item => {
                    if (weekOrders.hasOwnProperty(item.week_period)) {
                        weekOrders[item.week_period] = item.total_orders;
                    }
                });
            
                const currentDay = new Date().getDate();
                let currentWeekIndex = 0;
                if (currentDay <= 7) currentWeekIndex = 0;
                else if (currentDay <= 14) currentWeekIndex = 1;
                else if (currentDay <= 21) currentWeekIndex = 2;
                else currentWeekIndex = 3;
            
                const orders = weekLabels.map((label, i) => {
                    return i <= currentWeekIndex ? weekOrders[label] : null;
                });

                const total = orders.reduce((acc, val) => acc + (val ?? 0), 0);
                const formattedTotal = total >= 1000 ? (total / 1000).toFixed(1) + 'k' : total;
                document.getElementById("totalOrders").textContent = formattedTotal;
            
                const options = {
                    chart: {
                        height: 80,
                        type: "area",
                        toolbar: { show: false },
                        sparkline: { enabled: true }
                    },
                    markers: {
                        size: 5,
                        colors: "transparent",
                        strokeColors: "transparent",
                        strokeWidth: 4,
                        discrete: [
                            {
                                seriesIndex: 0,
                                dataPointIndex: currentWeekIndex,
                                fillColor: config.colors.success,
                                strokeColor: "#fff",
                                size: 7,
                                radius: 8
                            }
                        ],
                        hover: { size: 7 }
                    },
                    grid: { show: false, padding: { top: 15, right: 7, left: 0 } },
                    colors: [config.colors.success],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.4,
                            gradientToColors: [config.colors.cardColor],
                            opacityTo: 0.4,
                            stops: [0, 100]
                        }
                    },
                    dataLabels: { enabled: false },
                    stroke: { width: 2, curve: "smooth" },
                    series: [{
                        name: "Orders",
                        data: orders
                    }],
                    xaxis: {
                        categories: weekLabels,
                        labels: {
                            show: true,
                            style: {
                                fontSize: "12px",
                                colors: "#888"
                            }
                        },
                        axisBorder: { show: false },
                        axisTicks: { show: false }
                    },
                    yaxis: {
                        labels: { show: false }
                    }
                };
            
                const chart = new ApexCharts(document.querySelector("#orderChart"), options);
                chart.render();
            }
            
            
            
        },
        error: function (xhr) {
            console.error("Failed to load chart data", xhr);
        }
    });
    $.ajax({
        url: "/payment-stats",
        method: "GET",
        success: function (response) {
            console.log(response); 
            if (response.status === "success") {
                console.log(response.data);
                
                let chartData = response.data.map(item => {
                    console.log(item);
                
                    if (item.percentage !== undefined) {
                        console.log(item.percentage);  
                        return parseFloat(item.percentage); 
                    }
                
                    console.warn("Missing 'percentage' in item:", item);
                    return 0; 
                });
                

                document.getElementById("Online Order").innerText = chartData[0] + "%";
                document.getElementById("Normal Order").innerText = chartData[1] + "%";
                document.getElementById("Online Payement").innerText = chartData[2] + "%";
                document.getElementById("Normal Payement").innerText = chartData[3] + "%";
                
                
                let chart = new ApexCharts(document.querySelector("#horizontalBarChart"), {
                    chart: {
                        height: 360,
                        type: "bar",
                        toolbar: { show: false }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            barHeight: "60%",
                            distributed: true,
                            startingShape: "rounded",
                            borderRadiusApplication: "end",
                            borderRadius: 7
                        }
                    },
                    colors: [
                        config.colors.primary,
                        config.colors.info,
                        config.colors.success,
                        config.colors.secondary,
                        config.colors.danger,
                        config.colors.warning
                    ],
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ["#fff"],
                            fontWeight: 400,
                            fontSize: "13px",
                            fontFamily: "Public Sans"
                        },
                        formatter: function (val) {
                            return val + "%";
                        }
                    },
                    labels: ["Online Order", "Normal Order", "Online Payement", "Normal Payement"],
                    series: [{ data: chartData }],
                    xaxis: {
                        categories: ["Online Order", "Normal Order", "Online Payement", "Normal Payement"],
                        labels: {
                            formatter: function (val) {
                                return val + "%";
                            },
                            style: {
                                colors: "#6e6b7b",
                                fontFamily: "Public Sans",
                                fontSize: "13px"
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: "#6e6b7b",
                                fontFamily: "Public Sans",
                                fontSize: "13px"
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        custom: function ({ series, seriesIndex, dataPointIndex }) {
                            return `<div class="px-3 py-2"><span>${series[seriesIndex][dataPointIndex]}%</span></div>`;
                        }
                    },
                    legend: { show: false }
                });
    
                chart.render();
            }
        },
        error: function (err) {
            console.error("Error fetching chart data:", err);
        }
    });
    $.ajax({
        url: 'top-menus',
        method: 'GET',
        success: function(response) {
            var menuList = $('#top_menus');
            menuList.empty();
    
            $.each(response, function(index, menu) {
                menuList.append(`
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-4 w-px-34 h-px-34">
                                <img src="/storage/${menu.image}" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div>
                                <h6 class="mb-0 text-truncate">${menu.name}</h6>
                                <small class="text-truncate text-body">${menu.type}</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">${menu.total_orders}</h6>
                        </div>
                    </div>
                `);
            });
        },
        error: function(xhr, status, error) {
            alert('Erreur lors de la récupération des données.');
        }
    });
       
};
