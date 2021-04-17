$(document).ready(function () {


    $("#commune,#mairie,#zone,#type_commerce,#type_taxe,#month,#year,#etat_paided").on("change",function (){


        $('#table').bootstrapTable('refresh', {
            query: {
                commune: convertToIn($("#commune").val()),
                mairie: convertToIn($("#mairie").val()),
                zone: convertToIn($("#zone").val()),
                type_taxe: convertToIn($("#type_taxe").val()),
                type: convertToIn($("#type_commerce").val()),
                year: convertToIn($("#year").val()),
                etat_paided: $("#etat_paided").val(),
                month: $("#month").val(),

            }
        });


    })


});

var app = new Vue({
    el: '#content',
    data: function () {
        return {
            e_firstname: '',
        }
    },
    methods: {

    },
    mounted() {
        ;


    }
})


function isNumeric(str) {
    if (typeof str != "string") return false // we only process strings!
    return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
        !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}
function convertToIn(val){
    if(isNumeric(val)){
        return parseInt(val);
    }else {
        return "";
    }
}
function optionsFormatterDetail(id, row) {
    var detail = "../commerce/" + row.commerce_id + "/detail";
    options = "<a href='"+detail+"' class='btn  waves-effect btn-sm no-shadow' title='Detail'  type='button'><i class=\"fa fa-arrow-alt-circle-right white-text\"></i> </a>";
    return options;
}
function optionsFormatterReplay(id, row) {
    options = "<a onclick=\"javascript:sendRelanceToTaxe(" + id + "," + row.commerce_id + ");\" class='btn  waves-effect btn-sm no-shadow' title='Detail'  type='button'><i class=\"fa fa-sms white-text\" style='color: white'></i> </a>";
    return options;
}


function sendRelanceToTaxe(id,commerce_id){

    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append("id", id)
    formData.append("commerce", commerce_id)

    axios.post($("#relance_to_sms").val(), formData).then((response) => {
        var result = response.data;

        if (response.data.success === true) {

            rep_success(response.data.message)
            $('#table').bootstrapTable('refresh');
        } else {
            rep_error(response.data.message)
        }

    }).catch(error => {
        // progress_hide(1);
        // // rep_error(error.data.message)
        // // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
        // console.log(error);

    })
}

function identifierFormatter(id,row){
    var identifier = row.identifier?row.identifier:"";
    return "<span class=''> "+identifier+" </span>";

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
