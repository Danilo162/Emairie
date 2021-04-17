
Vue.component('dashboard-component',{
    template : "<div class=\"row\"> <div v-if='is_display' class=\"row clearfix\">\n" +

        "                <div class=\"col-lg-3 col-md-3 col-sm-6 col-xs-12\">\n" +
        "                    <div :class='theme' class=\"info-box  hover-expand-effect\">\n" +
        "                        <div class=\"icon\">\n" +
        "                            <i class=\"fa fa-users\"></i>\n" +
        "                        </div>\n" +
        "                        <div class=\"content\">\n" +
        "                            <div class=\"text\">ADMINISTRES</div>\n" +
        "                            <div class=\"number count-to\" data-from=\"0\" data-to=\"257\"" +
        " data-speed=\"1000\" data-fresh-interval=\"20\">{{administred}}</div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "                <div class=\"col-lg-3 col-md-3 col-sm-6 col-xs-12\">\n" +
        "                    <div :class='theme' class=\"info-box hover-expand-effect\">\n" +
        "                        <div class=\"icon\">\n" +
        "                            <i class=\"fa fa-building\"></i>\n" +
        "                        </div>\n" +
        "                        <div class=\"content\">\n" +
        "                            <div class=\"text\">COMMERCES</div>\n" +
        "                            <div class=\"number count-to\" data-from=\"0\" data-to=\"243\" " +
        "data-speed=\"1000\" data-fresh-interval=\"20\">{{commerce}}</div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "                <div class=\"col-lg-3 col-md-3 col-sm-6 col-xs-12\">\n" +
        "                    <div :class='theme' class=\"info-box  hover-expand-effect\">\n" +
        "                        <div class=\"icon\">\n" +
        "                            <i class=\"fa fa-user-plus\"></i>\n" +
        "                        </div>\n" +
        "                        <div class=\"content\">\n" +
        "                            <div class=\"text\">AGENTS</div>\n" +
        "                            <div class=\"number count-to\" data-from=\"0\" data-to=\"1225\" data-speed=\"1000\" data-fresh-interval=\"20\">{{agent}}</div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "                <div class=\"col-lg-3 col-md-3 col-sm-6 col-xs-12\">\n" +
        "                    <div :class='theme' class=\"info-box  hover-expand-effect\">\n" +
        "                        <div class=\"icon\">\n" +
        "                            <i class=\"fa fa-place-of-worship\"></i>\n" +
        "                        </div>\n" +
        "                        <div class=\"content\">\n" +
        "                            <div class=\"text\">SERVICES</div>\n" +
        "                            <div class=\"number count-to\" data-from=\"0\" data-to=\"1225\" data-speed=\"1000\" data-fresh-interval=\"20\"></div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "            </div>\n" +

        "          \n" +
        "            <!-- #END# Widgets -->\n" +
        "            <!-- CPU Usage -->\n" +
        "            <div class=\"row clearfix\">\n" +
        "                <div class=\"col-lg-6\">\n" +
        "                    <div class=\"card\">\n" +
        "                        <div class=\"body\">\n" +
        "                            <div style='height: 400px' id=\"echart_pie_mairie_administred\" class=\"dashboard-flot-chart\"></div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "                <div class=\"col-lg-6\">\n" +
        "                    <div class=\"card\">\n" +
        "                        <div class=\"body\">\n" +
        "                            <div style='height: 400px' id=\"echart_pie_mairie_commerce\" class=\"dashboard-flot-chart\"></div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +

        "            </div>\n" +
        "                <!-- #END# Browser Usage -->\n" +
        "            </div></div>  ",
    data: function () {
        return {
            mairie: '',
            commerce: '',
            agent: '',
            administred: '',
            theme: 'bg-green',
            is_display: false
        }
    },

    methods: {
        getter() {
            // progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    // progress_counter(percentCompleted);
                }
            };
            // document.getElementById("frmCreate")
            let formData = new FormData();

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            formData.append('mairie','')

            axios.post('console/dashbord/fonctionel', formData, config, {}).then((response) => {
                // $(".card-bg").addClass('bg-green');


                this.administred = response.data.administred;
                this.commerce = response.data.commerce;
                this.agent = response.data.agent;
                pie_administred(response.data.pie_administred);
                pie_commerce(response.data.pie_commerce);
                // $(".card-bg").addClass("bg-"+response.data.theme);
                this.theme = "bg-"+response.data.theme;

                this.is_display = true;

            }).catch(error => {
                console.log(error)

                // progress_hide(1);
                // rep_error(error.data.message)
                // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE


            })
        },


    },
    mounted() {
        this.getter()
        // pie_administred();
    }

});

var app = new Vue({
    el: '#dashboard'
});


function pie_administred(data) {
    var objetPie = [];
    var legend = [];
    var jj= 0;
    for (var i = 0;i<data.length; i++){
        objetPie[jj] = JSON.parse('{"value":' + data[i].total + ',"name":"' + data[i].gender + '"}');
        legend[jj] = data[i].gender;
        jj++;
    }
    require(
        [
            public_path+'echartjslib/echarts',
        ],
        function (ec) {
            var opt ={
                title : {
                    subtext: 'Nombre d\'administrés par sexe',
                    x:'center'
                },
                // color: ['#50A5D8', '#DE725C'],
                tooltip : {
                    trigger: 'item',
                    formatter: "<small>{a} <br/>{b} : {c} ({d}%)</small>"
                },
                legend: {
                    orient: 'vertical',
                    top:'center',
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
                            lang: [ "Genre", "Fermer", "Actualiser" ], readOnly: false },

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
                        radius : '50%',
                        center: ['50%', '50%'],
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
            var myEchartBar = ec.init(document.getElementById('echart_pie_mairie_administred'));
            myEchartBar.setOption(opt);
       }
     );
}
function pie_commerce(data) {
    console.log(data);
    var objetPie = [];
    var legend = [];
    var jj= 0;
    for (var i = 0;i<data.length; i++){
        objetPie[jj] = JSON.parse('{"value":' + data[i].total + ',"name":"' + data[i].name + '"}');
        legend[jj] = data[i].name;
        jj++;
    }
    require(
        [
            public_path+'echartjslib/echarts',
        ],
        function (ec) {
            var opt ={
                title : {
                    subtext: 'Nombre de commerces par type',
                    x:'center'
                },
                // color: ['#50A5D8', '#DE725C'],
                tooltip : {
                    trigger: 'item',
                    formatter: "<small>{a} <br/>{b} : {c} ({d}%)</small>"
                },
                legend: {
                    orient: 'vertical',
                    top:'center',
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
                            lang: [ "Genre", "Fermer", "Actualiser" ], readOnly: false },

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
                        radius : '50%',
                        center: ['50%', '50%'],
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
            var myEchartBar = ec.init(document.getElementById('echart_pie_mairie_commerce'));
            myEchartBar.setOption(opt);
       }
     );
}

// var app = new Vue(
//     'dashbord',{
//     el: '#content',
//
// })
