;
var app = new Vue({
    el: '#contenaire',
    data: function () {
        return {
            e_forfait: '',
        }
    },
    methods: {
        store_forfait() {
            btnsend_loader_show('submitbtn')
            this.e_forfait = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };
            // document.getElementById("frmCreate")
            var frmCreate = $("#frmChangeForfait");
            let formData = new FormData(frmCreate[0]);


            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            formData.append('commerce', $("#commerce").val())
            if($("#forfait").val()==null){
                alert("Veuilez renseigner un forfait")
                return ;
            }
            axios.post($("#choose_forfait").val(), formData, config, {}).then((response) => {
                btnsend_loader_hide('submitbtn')
                progress_hide();

                console.log(response.data)

                if (response.data.success == true) {

                    rep_success(response.data.message)

                    // setTimeout(function () {
                    //     location.reload()
                    // }, 3000);
                    //

                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                btnsend_loader_hide('submitbtn')
                progress_hide(1);
                console.log(error)
                // rep_error(error.data.message)
                // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
                if (error.response.data.errors) {
                    if (error.response.data.errors.forfait) {
                        this.e_forfait = error.response.data.errors.forfait[0];
                    }

                }

            })
        },

    },
    mounted() {
      ;


    }
})

function optionsFormatter(id, row) {
    var options = "";
    var detail = "agent/" + id + "/detail";
    var edit = "";

    edit =  '<li style=\'cursor: pointer\'><a  onclick="javascript:updateRows(\'' + id + '\');"> <i class="fa fa-pencil-alt green-text"></i> Modifier</a></li>\n';

    options = " <div class=\"btn-group btn-group-sm\">\n" +
        " <button type=\"button\" class=\"btn btn-sm btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "  Actions <span class=\"caret\"></span>\n" +
        "  </button>\n" +
        " <ul class=\"dropdown-menu right-menu\">\n" +
        " <li><a href="+detail+"> Detail <i class='fa fa-arrow-right blue-text'></i></a></li>\n" +
        " <li mairie=\"separator\" class=\"divider\"></li>\n" +
        edit +
        " <li><a onclick=\"javascript:showDeleteConfirmMessage(" + id + ");\"><i class='fa fa-times red-text'></i> Supprimer</a></li>\n" +
        "  </ul>\n" +
        "</div>"

    return options;
}

function imageFormatter(id,row){

    var publicPath = $("#app").attr("home-url") + "/storage/" + row.picture;
    var image = "<img src="+ publicPath + " width='70' class='\img-thumbnail\' />";
    return image;
}
function taxeFormatter(id,row,index){
    var paided = row.amount_paided?row.amount_paided:"";
if(row.amount_paided)
        div = "<div class='bg-green' style='padding: 5px'>"+row.month+"</div>";
else
    div = "<div class='bg-danger' style='padding: 5px'>"+row.month+"</div>";
 return div;

}

function getTaxeInfos(id){

    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append("commerce", id)

            axios.post($("#taxe_statistique").val(), formData).then((response) => {
                var result = response.data;

            console.log(result);
                pie_taxe(result);
            }).catch(error => {
                // progress_hide(1);
                // // rep_error(error.data.message)
                // // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
                // console.log(error);

            })
}

function cellStyle(value, row, index) {

    var classes = [
        'bg-green',
        'bg-red'
    ]

    if(row.amount_paided){
        return {
            classes: classes[0]
        }
    }else {
        return {
            classes: classes[1]
        }
    }

}
function pie_taxe(data) {
    var objetPie = [];
    var legend = [];
    legend[0]="Payées";
    legend[1]="Non Payées";

    objetPie[0] = JSON.parse('{"value":' + Number(data.total_paided) + ',"name":"' + legend[0] + '"}');
    objetPie[1] = JSON.parse('{"value":' + Number(data.total_prev) + ',"name":"' + legend[1] + '"}');
    require(
        [
            public_path+'echartjslib/echarts',
        ],
        function (ec) {
            var opt ={
                title : {
                    subtext: 'Mes taxes',
                    x:'center'
                },
                color: ['#08be3b', '#f32727'],
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
            var myEchartBar = ec.init(document.getElementById('echart_pie_taxe_commerce'));
            myEchartBar.setOption(opt);
        }
    );
}
