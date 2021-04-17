
$(document).ready(function () {
    $('#commune').on("change", function () {
        // $('#table').bootstrapTable('refresh');
        var id = $(this).val();


        $('#table').bootstrapTable('refresh', {
            query: {
                commune: convertToIn($("#commune").val()),

            }
        });
        con
    })
});
var app = new Vue({
    el: '#content',
    data: function () {
        return {

        }
    },
    methods: {


    },
    mounted() {
        ;


    }
})

function optionsFormatter(id, row) {
    var options = "";
    var detail = "administred/" + id + "/detail";

    return options;
}
function optionsFormatterDetail(id, row) {
    // var detail = "commerce/" + id + "/detail";
    var detail = "administred/" + id + "/detail";
    options = "<a href='"+detail+"' class='btn  waves-effect btn-sm no-shadow' title='Detail'  type='button'><i class=\"fa fa-arrow-alt-circle-right blue-text\"></i> </a>";
    return options;
}

function imageFormatter(id,row){

    var publicPath = public_path+ "/storage/" + row.picture;
    var image = "<img src="+ publicPath + " width='40' class='\img-thumbnail\' />";

    return image;

}
function identifierFormatter(id,row){
    var identifier = row.identifier?row.identifier:"";
    return "<span class='red-text'> "+identifier+" </span>";

}

function updateRows(id){

    let formData = new FormData();

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append("id", id)

    const param = new URLSearchParams();
    param.append('_token', $('meta[name="csrf-token"]').attr('content'));
    param.append("id", id)

    axios.post($("#edit").val(), formData).then((response) => {
        progress_hide();
        console.log(response.data)
        if (response.data.success === true) {
            var row = response.data.data;
            console.log(row)
            $("#agent_id").val(row.id);
            console.log(row.id);
            $("#firstname").val(row.firstname);
            $("#lastname").val(row.lastname);
            $("#phone").val(row.phone);
            $("#email").val(row.email);
            $("#role").val(row.role_id);

            var publicPath = $("#app").attr("home-url") + "/storage/" + row.picture;
            $(".imgpreview").attr('src',publicPath);

            $("#mairie").val(row.mairie_id);
            $("#job").val(row.job);
            $("#defaultModal").modal("show");
        } else {
            rep_error(response.data.message)
        }

    }).catch(error => {
        progress_hide(1);
        // rep_error(error.data.message)
        // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
        console.log(error);

    })
}


