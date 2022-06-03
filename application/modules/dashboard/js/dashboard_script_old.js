$(document).ready(function() {
     month_graph();
     recovery_info();

     var link = BASE_URL+'assets/back/images/dashboard-2/radial-image.png';

     var options4 = {
          series: [taux_renouvellement],
          chart: {
               height: 345,
               type: 'radialBar',
               offsetY: -10,
          },

          plotOptions: {
               radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    inverseOrder: true,
                    hollow: {
                         margin: 5,
                         size: '60%',
                         image: link,
                         imageWidth: 140,
                         imageHeight: 140,
                         imageClipped: false,
                    },
                    track: {
                         opacity: 0.4,
                         colors: CubaAdminConfig.primary
                    },
                    dataLabels: {
                         enabled: false,
                         enabledOnSeries: undefined,
                         formatter: function (val, opts) {
                              return val + "%"
                         },
                         textAnchor: 'middle',
                         distributed: false,
                         offsetX: 0,
                         offsetY: 0,

                         style: {
                              fontSize: '14px',
                              fontFamily: 'Helvetica, Arial, sans-serif',
                              fill:['#2b2b2b'],

                         },
                    },
               }
          },

          fill: {
               type: 'gradient',
               gradient: {
                    shade: 'light',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100],
                    gradientToColors: ['#3DA5D9'],
                    type: 'horizontal'
               },
          },
          stroke: {
               dashArray: 15,
               strokecolor: ['#ffffff']
          },

          labels: ['Renouvellement'],
          colors: [ CubaAdminConfig.primary ],
     };

     var chart4 = new ApexCharts(document.querySelector("#riskfactorchart"),
     options4
);
     chart4.render();

});

function month_graph(){
     $.get(BASE_URL + "api/script/get_month_data").done(function (json) {
          var obj = JSON.parse(json) || {};
          var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          Morris.Line({
               element: "morris-line-example",
               data: obj.data,
               xkey: "y",
               ykeys: ["a","b"],
               labels: ["Encaissement","Decaissements"],
               fillOpacity: ["0.5"],
               pointFillColors: ["#ffffff"],
               pointStrokeColors: ["#999999"],
               behaveLikeLine: !0,
               gridLineColor: "#eef0f2",
               hideHover: "auto",
               lineWidth: "3px",
               pointSize: 0,
               preUnits: "$ ",
               resize: !0,
               lineColors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
               xLabelFormat: function(x) {
                    var cpt = x.getMonth();
                    var month = months[cpt];
                    return month;
               },
               dateFormat: function(x) {
                    var cpt = new Date(x).getMonth();
                    var month = months[cpt];
                    return month;
               },
          });
     }).fail(function (jqxhr, textStatus, error) {
          return [];
     });
}

function recovery_graph(){
     var facturer = $("#facturer").val();
     var tx_encaisser = Math.round($("#encaisser").val()/facturer*100);
     var tx_a_encaisser = Math.round((facturer-$("#encaisser").val())/facturer*100);
     Morris.Donut({
          element: "morris-donut-example",
          data: [{label:"Taux recouvré",value:tx_encaisser},{label:"Taux à recouvrir",value:tx_a_encaisser}],
          resize: !0,
          colors: ["#FFB64C","#E63950"]
     });
}

function recovery_info(){
     var facturer = $("#facturer").val();
     var tx_encaisser = Math.round($("#encaisser").val()/facturer*100);
     var tx_a_encaisser = Math.round((facturer-$("#encaisser").val())/facturer*100);
     $("#tx_recouvrement").val(tx_encaisser);
     $(".knob2").knob({

          'width': 80,
          'height': 80,
          'max': 100,

          change: function (value) {
               //console.log("change : " + value);
          },
          release: function (value) {
               //console.log(this.$.attr('value'));
               console.log("release : " + value);
          },
          cancel: function () {
               console.log("cancel : ", this);
          },
          format: function (value) {
               return value + '%';
          },
          draw: function () {

               // "tron" case
               if (this.$.data('skin') == 'tron') {

                    this.cursorExt = 1;

                    var a = this.arc(this.cv)  // Arc
                    , pa                   // Previous arc
                    , r = 1;

                    this.g.lineWidth = this.lineWidth;

                    if (this.o.displayPrevious) {
                         pa = this.arc(this.v);
                         this.g.beginPath();
                         this.g.strokeStyle = this.pColor;
                         this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                         this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
               }
          }
     });
}
