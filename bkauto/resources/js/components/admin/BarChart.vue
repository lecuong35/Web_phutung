<template>
  <Bar
     v-if="loaded"
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
</template>

<script>
import { Bar } from 'vue-chartjs'
import baseUrl from "../../store/baseUrl";
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { mapGetters, useStore, mapActions } from 'vuex'
import { computed } from 'vue'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },

  // setup() {
  //   const store = useStore();
  //   store.dispatch('charts/setTurnOver');
  //   const turnover = computed( () => JSON.parse(JSON.stringify(store.getters['charts/turnover'])));
  //   console.log(turnover);
  //   // const jan = computed( () => store.getters['charts/jan']);
  //   // const feb = computed( () => store.getters['charts/feb']);
  //   // const mar = computed( () => store.getters['charts/mar']);
  //   // const apr = computed( () => store.getters['charts/apr']);
  //   // const may = computed( () => store.getters['charts/may']);
  //   // const jun = computed( () => store.getters['charts/jun']);
  //   // const jul = computed( () => store.getters['charts/jul']);
  //   // const aug = computed( () => store.getters['charts/aug']);
  //   // const sep = computed( () => store.getters['charts/sep']);
  //   // const oct = computed( () => store.getters['charts/oct']);
  //   // const nov = computed( () => store.getters['charts/nov']);
  //   // const dec = computed( () => store.getters['charts/dec']);

  //   const chartData =  {
  //               labels: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
  //               datasets: [ 
  //                           { backgroundColor: ['blue', 'red', 'green'] ,
  //                             data: [30] } 
  //                           ]
  //           }
  //   const chartOptions =  {
  //         responsive: false
  //     }

  //   return {
  //     chartData,
  //     chartOptions,
  //   }
  // },
  props: {
    chartId: {
      type: String,
      default: 'bar-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 450
    },
    height: {
      type: Number,
      default: 450
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Object,
      default: () => {}
    }
  },

   data: () => ({
    loaded: false,
    chartData :  {
                labels: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
                datasets: [ 
                            { backgroundColor: ['blue', 'red', 'green'] ,
                              data: [] } 
                            ]
            },
    chartOptions :  {
          responsive: false
      }
  }),

  async mounted () {
    this.loaded = false

    try {
      baseUrl.adminGet('bills/turnover').then((result) => {
            const total =  JSON.parse(JSON.stringify(result.data));
           var array = Object.keys(total).map(function(key) {
                return total[key];
              });

            this.chartData.datasets[0].data = array;
            this.loaded = true;

            console.log(array)
        }).catch((err) => {
            console.log(err);
        });

    } catch (e) {
      console.error(e)
    }
  }
}
</script>

<style scoped> 
   body {
    width: 600px;
    height: 600px;
   }
</style>