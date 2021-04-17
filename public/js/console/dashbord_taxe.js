$(document).ready(function () {
    getter();

    $("#commune,#mairie,#zone,#type_commerce,#type_taxe,#month,#year").on("change",function (){
        getter();
    })
    window.setInterval(() => {
       getter()
    }, 120000)

});


var app = new Vue({
    el: '#dashboard',
    data: function () {
        return {
            e_firstname: '',
        }
    },
    methods: {


    },
    mounted() {

    }
})


function getter() {
    var config = {
    };
    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
    formData.append('commune',$("#commune").val())
    formData.append('mairie',$("#mairie").val())
    formData.append('zone',$("#zone").val())
    formData.append('type',$("#type_commerce").val())
    formData.append('type_taxe',$("#type_taxe").val())
    formData.append('month',$("#month").val())
    formData.append('year',$("#year").val())

    axios.post('taxecommerce/get_statistique', formData, config, {}).then((response) => {
        // $(".card-bg").addClass('bg-green');

var rep = response.data;
        var totalTaxe = rep.total_prev?rep.total_prev:0;
        var totalTaxeSomme = rep.total_amount_prev? rep.total_amount_prev:0;
        var totalPaided = rep.total_paided?rep.total_paided:0;
        var totalPaidedMontant= rep.total_amount_paided?rep.total_amount_paided:0;
       var totalNoPaided = Number(totalTaxe)-Number(totalPaided);
       var totalNoPaidedMontant = Number(totalTaxeSomme)-Number(totalPaidedMontant);

       var percentTotal = percentage(totalTaxe,totalTaxe);
       var percentPaided = percentage(totalTaxe,totalPaided);
       var percentNoPaided = percentage(totalTaxe,totalNoPaided);


        $("#tbody").html(" <tr class=\"bg-primary\">\n" +
            "<td> Taxe totale</td> <td style='text-align: center'> "+totalTaxe+"</td> <td style='text-align: right'> "+totalTaxeSomme+"</td><td> "+percentTotal+"</td>\n" +
            "\n" +
            " </tr>\n" +
            " <tr style=\"background: mediumseagreen !important;color: white !important;\">\n" +
            " <td> Payées</td> <td style='text-align: center'> "+totalPaided+"</td><td style='text-align: right'> "+totalPaidedMontant+"</td><td> "+percentPaided+"</td>\n" +
            "\n" +
            " </tr>\n" +
            " <tr style=\"background: #F44336!important;color: white !important;\">\n" +
            "  <td> impayées</td> <td style='text-align: center'>  "+totalNoPaided+"</td><td style='text-align: right'>  "+totalNoPaidedMontant+"</td><td> "+percentNoPaided+"</td>\n" +
            " </tr>");
        echart_bar_taxe(totalTaxe,totalPaided,totalNoPaided)
        pie_taxe_sommes(totalPaidedMontant,totalNoPaidedMontant)
    }).catch(error => {
        console.log(error)


    })
};

function pie_taxe_sommes(paided,nopaided) {

    var objetPie = [];
    var legend = ["Somme payée","Somme non payée"];
    // var jj= 0;
    // for (var i = 0;i<data.length; i++){
        objetPie[0] = JSON.parse('{"value":' + paided + ',"name":"' + legend[0] + '"}');
        objetPie[1] = JSON.parse('{"value":' + nopaided + ',"name":"' + legend[1]+ '"}');
    //     legend[jj] = data[i].name;
    //     jj++;
    // }
    require(
        [
            public_path+'echartjslib/echarts',
        ],
        function (ec) {
            var opt ={
                title : {
                    subtext: 'Representation de la somme payée/non payée',
                    x:'center'
                },
                // color: ['#50A5D8', '#DE725C'],
                color: ['#10ac5e','#F44336'],
                tooltip : {
                    trigger: 'item',
                    formatter: "<small>{a} <br/>{b} : {c} ({d}%)</small>"
                },
                legend: {
                    orient: 'vertical',
                    top:'bottom',
                    right: 5,
                    data: legend
                },
                toolbox: {
                    show: true,
                    // orient: 'vertical',
                    // bottom: 'center',
                    //
                    feature : {
                        dataView : {show: true, title: "Données",
                            lang: [ "Somme", "Fermer", "Actualiser" ], readOnly: false },

                        restore : {show: true, title: "Rafraichir"},
                        saveAsImage : { show: true, title: "Enregistrer",  lang:["Sauvegarder"] }
                    }
                },

                series : [
                    {
                        name: 'Part : ',
                        type: 'pie',
                        label: {
                            // formatter: "{b} : {num|{c}} | {rate|{d}%}",
                            formatter: "{b} : {rate|{d}%}",
                            color: "black",
                            fontSize: 10,
                            rich: {
                                num: {
                                    fontSize: 18,
                                    fontWeight: 'bold',
                                    color: "black"
                                },
                                rate: {
                                    fontSize: 18,
                                    fontWeight: 'bold',
                                    color: "black"
                                },
                                symbol: {
                                    fontSize: 18,
                                    color: "black"
                                }
                            }
                        },
                        radius : '40%',
                        center: ['45%', '45%'],
                        data:objetPie,
                        // data:tabTypeAction_source,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)',

                            }

                        },

                    }
                ]
            };
            var myEchartBar = ec.init(document.getElementById('echart_pie_taxe_somme'));
            myEchartBar.setOption(opt);
       }
     );
}

function percentage(total_,small_) {

    var total = Number(total_);
    var small = Number(small_);
    var percent = 0;
    if(total && small){
        percent = parseFloat((small*100)/total).toFixed(2);
    }

    return percent+" %"
}

function echart_bar_taxe(total,paided,nopaided) {

     total =  Number(total)
     paided =  Number(paided)
     nopaided =  Number(nopaided)

    var legend = ["Total ","Payées","Non payées"];
    require(
        [
            public_path+'echartjslib/echarts',
        ],
        function (ec) {

            var  option = {
                color: ['#3398DB','#10ac5e','#F44336'],

                legend: {
                    data:legend
                },
                toolbox: {
                    show : true,
                    orient: 'vertical',
                    x: 'right',
                    y: 'center',
                    feature : {
                        dataView : {show: false, title: "Données",
                            lang: [ "Sauvegarder", "Fermer", "Actualiser" ], readOnly: false },
                        magicType : {show: true, type: [ 'bar'],
                            title: {

                                bar: 'Bar'
                            }
                        },
                        restore : {show: true, title: "Rafraichir"},
                        saveAsImage : { show: true, title: "Enregistrer",  lang:["Sauvegarder"] }
                    }
                },
                // calculable: true,
                // tooltip: {
                //     trigger: 'axis',
                //     axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                //         type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                //     }
                //
                // },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        data:legend,
                        axisTick: {
                            alignWithLabel: true
                        },
                        axisLine :{
                            show:true,
                            lineStyle:{
                                color:'green',
                                type:'solid',
                                width:2
                            }
                        },
                        axisLabel:{
                            show:true,
                            interval:'auto',
                            rotate:25,
                            margin:2,
                            formatter:'{value}',
                            textStyle:{
                                color:'black',
                                fontFamily:'sans-serif',
                                fontStyle:'italic',
                                fontSize:10,
                                fontWeight:'bold'
                            }
                        },
                    }
                ],
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        // name: 'Forest',
                        type: 'bar',
                        label: "Total",
                        data: [total,0,0]
                        // data: [total]
                    },
                    {
                        // name: 'Steppe',
                        type: 'bar',
                        label: "Taxe payées",
                        // data: [paided]
                        data: [0,paided,0]
                    },
                    {
                        // name: 'Desert',
                        type: 'bar',
                        label: "Taxe non payées",
                        // data: [nopaided]
                        data: [0,0,nopaided]
                    },

                ]
            };

            var myEchartBar = ec.init(document.getElementById('echart_bar_status'));
            myEchartBar.setOption(option);
        }
    );
}
