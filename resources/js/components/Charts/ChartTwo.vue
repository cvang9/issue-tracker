<script>
import { ref } from 'vue'
import VueApexCharts from 'vue3-apexcharts';

export default {

    components:{
        'vue-apex-charts' : VueApexCharts
    },
    props: ['counts'],
    setup(props) {


        const isLoading = ref(true);
        const chartData = ref(null)
        const apexOptions = ref(null)
        const chart = ref(null)

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
                name: 'Raised',
                data: [
                (props.counts.created.Monday) ? props.counts.created.Monday.ticket_count : 0,
                (props.counts.created.Tuesday) ? props.counts.created.Tuesday.ticket_count : 0,
                (props.counts.created.Wednesday) ? props.counts.created.Wednesday.ticket_count : 0,
                (props.counts.created.Thursday) ? props.counts.created.Thursday.ticket_count : 0,
                (props.counts.created.Friday) ? props.counts.created.Friday.ticket_count : 0,
                (props.counts.created.Saturday) ? props.counts.created.Saturday.ticket_count : 0,
                (props.counts.created.Sunday) ? props.counts.created.Sunday.ticket_count : 0             
            ]
        },
            {
                name: 'Resolved',
                data: [
                    (props.counts.resolved.Monday) ? props.counts.resolved.Monday.ticket_count : 0,
                    (props.counts.resolved.Tuesday) ? props.counts.resolved.Tuesday.ticket_count : 0,
                    (props.counts.resolved.Wednesday) ? props.counts.resolved.Wednesday.ticket_count : 0,
                (props.counts.resolved.Thursday) ? props.counts.resolved.Thursday.ticket_count : 0,
                (props.counts.resolved.Friday) ? props.counts.resolved.Friday.ticket_count : 0,
                (props.counts.resolved.Saturday) ? props.counts.resolved.Saturday.ticket_count : 0,
                (props.counts.resolved.Sunday) ? props.counts.resolved.Sunday.ticket_count : 0             
            ]
            }
        ],
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S']
    }
    
      
        
        apexOptions.value = {
            colors: ['#3056D3', '#80CAEE'],
            chart: {
            type: 'bar',
            height: 335,
            stacked: true,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
        },
        responsive: [
            {
                breakpoint: 1536,
            options: {
                plotOptions: {
                    bar: {
                        borderRadius: 0,
                        columnWidth: '25%'
                    }
                }
            }
        }
        ],
        plotOptions: {
            bar: {
            horizontal: false,
            borderRadius: 0,
            columnWidth: '25%',
            borderRadiusApplication: 'end',
            borderRadiusWhenStacked: 'last'
        }
    },
    dataLabels: {
            enabled: false
        },
        xaxis: {
            type: 'category',
            categories: chartData.value.labels
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            fontFamily: 'Satoshi',
            fontWeight: 500,
            fontSize: '14px',
            
            markers: {
            radius: 99
            }
        },
        fill: {
            opacity: 1
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
    class="col-span-12 rounded-sm border border-stroke bg-white p-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4"
  >
    <div class="mb-4 justify-between gap-4 sm:flex">
      <div>
        <h4 class="text-xl font-bold text-black dark:text-white">Stats this week</h4>
      </div>
      <div>
      </div>
    </div>

    <div>
      <div id="chartTwo" class="-ml-5 -mb-9">
        <vue-apex-charts v-if="!isLoading"
          type="bar"
          height="335"
          :options="apexOptions"
          :series="chartData.series"
          ref="chart"
        />
      </div>
    </div>
  </div>
</template>
