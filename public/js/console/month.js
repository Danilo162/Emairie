
$(document).ready(function () {
    $('#year').on("change", function () {
        // $('#table').bootstrapTable('refresh');
        var id = $(this).val();

        $('#table').bootstrapTable('refresh', {
            query: {
                year: convertToIn($("#year").val()),

            }
        });
    })
});

var app = new Vue({
    el: '#content',
    data: function () {
        return {
            e_mois: '',
        }
    },

    methods: {
        store() {
            // loader_s();
            // upload file
            // const formData = new FormData();


            this.e_mois = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };
            // document.getElementById("frmCreate")
            var frmCreate = $("#frmCreate");
            let formData = new FormData(frmCreate[0]);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#store").val(), formData, config, {}).then((response) => {
                progress_hide();

                if (response.data.success === true) {
                    frmCreate[0].reset();
                    rep_success(response.data.message)
                    $('#table').bootstrapTable('refresh');
                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                progress_hide(1);
                // rep_error(error.data.message)
                //
                if (error.response.data.errors) {
                    if (error.response.data.errors.mois) {
                        this.e_mois = error.response.data.errors.mois[0];
                    }

                }

            })
        },

        testFunction: function (event) {
            console.log('test clicked')
        }
    },
    mounted() {


    }
})


function cellStyle(value, row, index) {

    var classes = [
        'bg-green',
        'bg-red'
    ]

    if(row.total_prev == row.total_paided){
        return {
            classes: classes[0]
        }
    }else {
        return {
            classes: classes[1]
        }
    }

}

function optionsFormatterDetail(id, row) {

    var detail = $("#detail").val()+"?month="+row.month;

    options = "<a href='"+detail+"' class='btn   btn-sm no-shadow' title='Detail' " +
        " type='button'><i class=\"fa fa-arrow-alt-circle-right white-text\" style='color: white !important;'></i> </a>";
    return options;
}

function updateRows(id,mois){
    console.log(mois)
    $("#typetaxe_id").val(id);
    $("#mois").val(mois);
}
