


var app = new Vue({
    el: '#container',
    data: function () {
        return {
            e_montant: '',
        }
    },
    methods: {

        testFunction: function (event) {
            console.log('test clicked')
        }
    },
    mounted() {


    }
})

function optionsFormatterReplay(id, row) {
    options = "<button onclick=\"javascript:relanceSmsForPaidTaxe("+id+");\" class='btn btn-warning  waves-effect btn-sm no-shadow' title='Ajouter'  type='button'>" +
        "<i class=\"fa fa-sms blue-text\"></i>" +
        " </button>";
    return options;
}



function relanceSmsForPaidTaxe(id){
    // console.log(id);
    // destroy_delegation

    swal({
        title: "Confirmation",
        text: "Etes vous sûr de bien vouloir notifier ce commerce pour le paiement de la taxe ?",
        showCancelButton: true,
        confirmButtonColor: "#dda255",
        confirmButtonText: "Continuer",
        cancelButtonText: "Annuler",
        closeOnConfirm: false
    }, function (response) {
        progress_show();
        var config = {
            onUploadProgress: function (progressEvent) {
                var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                progress_counter(percentCompleted);
            }
        };
        // var frmCreate = $("#frmCreateDelegation");
        let formData = new FormData();

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
        formData.append('id', id)
        formData.append('commerce', $("#commerce").val())


        axios.post($("#relance_to_sms").val(), formData, config, {}).then((response) => {
            progress_hide();

            if (response.data.success === true) {
                $('#table').bootstrapTable('refresh');
                rep_success(response.data.message)

                swal({
                        title: 'Suppression reussie',
                        text: "La ligne a bien été supprimée",
                        type: 'success',
                        timer: 2000
                    }
                );


            } else {
                rep_error(response.data.message)
            }

        }).catch(error => {
            progress_hide(1);
            // rep_error(error.data.message)
            //


        })
    })
}
