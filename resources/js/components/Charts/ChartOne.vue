<script>
import { ref } from 'vue'
import VueApexCharts from 'vue3-apexcharts'
export default {

    components: {
        'vue-apex-charts' : VueApexCharts
    },

    props: ['counts'],

    setup(props) {  

            const isLoading = ref(true);
            const chartData = ref(null);
            const apexOptions = ref(null);
            const chart = ref(null);

            const fun = () => {
                setTimeout( function() {
                    if( props.counts ) {
                        isLoading.value = false;
                        analyse();
                    }
                    else {
                        fun();
                    }
                } , 500)
            }

            fun();


            const analyse = () => {

                chartData.value = {
                    series: [
                        {
                            name: 'Ticket Raised',
                            data: [
                                (props.counts.created[1]) ? props.counts.created[1].ticket_count : 0,
                                (props.counts.created[2]) ? props.counts.created[2].ticket_count : 0,
                                (props.counts.created[3]) ? props.counts.created[3].ticket_count : 0,
                                (props.counts.created[4]) ? props.counts.created[4].ticket_count : 0,
                                (props.counts.created[5]) ? props.counts.created[5].ticket_count : 0,
                                (props.counts.created[6]) ? props.counts.created[6].ticket_count : 0,
                                (props.counts.created[7]) ? props.counts.created[7].ticket_count : 0,
                                (props.counts.created[8]) ? props.counts.created[8].ticket_count : 0,
                                (props.counts.created[9]) ? props.counts.created[9].ticket_count : 0,
                                (props.counts.created[10]) ? props.counts.created[10].ticket_count : 0,
                                (props.counts.created[11]) ? props.counts.created[11].ticket_count : 0,
                                (props.counts.created[12]) ? props.counts.created[12].ticket_count : 0,
                            ]
                        },
                        {
                            name: 'Ticket Resolved',
                            data: [
                                (props.counts.resolved[1]) ? props.counts.resolved[1].ticket_count : 0,
                                (props.counts.resolved[2]) ? props.counts.resolved[2].ticket_count : 0,
                                (props.counts.resolved[3]) ? props.counts.resolved[3].ticket_count : 0,
                                (props.counts.resolved[4]) ? props.counts.resolved[4].ticket_count : 0,
                                (props.counts.resolved[5]) ? props.counts.resolved[5].ticket_count : 0,
                                (props.counts.resolved[6]) ? props.counts.resolved[6].ticket_count : 0,
                                (props.counts.resolved[7]) ? props.counts.resolved[7].ticket_count : 0,
                                (props.counts.resolved[8]) ? props.counts.resolved[8].ticket_count : 0,
                                (props.counts.resolved[9]) ? props.counts.resolved[9].ticket_count : 0,
                                (props.counts.resolved[10]) ? props.counts.resolved[10].ticket_count : 0,
                                (props.counts.resolved[11]) ? props.counts.resolved[11].ticket_count : 0,
                                (props.counts.resolved[12]) ? props.counts.resolved[12].ticket_count : 0,
                            ]
                        }
                    ],
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }
                
                chart.value = ref(null)
                
                apexOptions.value = {
                    legend: {
                        show: false,
                        position: 'top',
                        horizontalAlign: 'left'
                    },
                    colors: ['#3C50E0', '#80CAEE'],
                    chart: {
                        fontFamily: 'Satoshi, sans-serif',
                        height: 335,
                        type: 'area',
                        dropShadow: {
                            enabled: true,
                            color: '#623CEA14',
                            top: 10,
                            blur: 4,
                            left: 0,
                            opacity: 0.1
                        },
                        
                        toolbar: {
                            show: false
                        }
                    },
                    responsive: [
                        {
                            breakpoint: 1024,
                            options: {
                                chart: {
                                    height: 300
                                }
                            }
                        },
                        {
                            breakpoint: 1366,
                            options: {
                                chart: {
                                    height: 350
                                }
                            }
                        }
                    ],
                    stroke: {
                        width: [2, 2],
                        curve: 'straight'
                    },
                    
                    labels: {
                        show: false,
                        position: 'top'
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    markers: {
                        size: 4,
                        colors: '#fff',
                        strokeColors: ['#3056D3', '#80CAEE'],
                        strokeWidth: 3,
                        strokeOpacity: 0.9,
                        strokeDashArray: 0,
                        fillOpacity: 1,
                        discrete: [],
                        hover: {
                            size: undefined,
                            sizeOffset: 5
                        }
                    },
                    xaxis: {
                        type: 'category',
                        categories: chartData.labels,
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        title: {
                            style: {
                                fontSize: '0px'
                            }
                        },
                        min: 0,
                        max: 10
                    }
                }
            }

        return {
            apexOptions,
            chartData,
            chart,
            isLoading
        }
    }
}

</script>

<template>
  <div
    class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-8"
  >
    <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
      <div class="flex w-full flex-wrap gap-3 sm:gap-5">
        <div class="flex min-w-47.5">
          <span
            class="mt-1 mr-2 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-primary"
          >
            <span class="block h-2.5 w-full max-w-2.5 rounded-full bg-primary"></span>
          </span>
          <div class="w-full">
            <p class="font-semibold text-primary ">Tickets Raised</p>

          </div>
        </div>
        <div class="flex min-w-47.5">
          <span
            class="mt-1 mr-2 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-secondary"
          >
            <span class="block h-2.5 w-full max-w-2.5 rounded-full bg-secondary"></span>
          </span>
          <div class="w-full">
            <p class="font-semibold text-secondary">Tickets Resolved</p>

          </div>
        </div>
      </div>
      <div class="flex w-full max-w-45 justify-end">
      </div>
    </div>
    <div>
      <div id="chartOne" class="-ml-5">
        <vue-apex-charts v-if="!isLoading"
          type="area"
          height="350"
          :options="apexOptions"
          :series="chartData.series"
          ref="chart"
        />
      </div>
    </div>
  </div>
</template>
