
$(document).ready(function () {
    $(".select2").select2();
    var device = $("#device").val()
    var price = $("#price").val();
    $("#quantite").on("keyup", function () {
        var qte = Number($("#quantite").val());
     var total = Number(price)*qte;
     $("#total").val(total+" "+device)

    })

});
var app = new Vue({
    el: '#main',
    data: function () {
        return {
            e_quantite: '',
          /*  e_numero: '',*/
            e_mode_paiement: '',
        }
    },
    methods: {
        store() {
            btnsend_loader_show('submitbtn')

            this.e_quantite = '',
            this.e_mode_paiement = ''
        /*    this.e_numero = ''*/
          /*  progress_show();*/
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                 /*   progress_counter(percentCompleted);*/
                }
            };
            // document.getElementById("frmCreate")
            var frmCreate = $("#frmCreate");
            let formData = new FormData(frmCreate[0]);


            console.log("rsrs")
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post("store", formData, config, {}).then((response) => {
                btnsend_loader_hide('submitbtn')
              /*  progress_hide();*/

                console.log("envoi")
                if (response.data.success === true) {
                    console.log("Ok")
                    frmCreate[0].reset();
                    rep_success(response.data.message)
                    window.location.href = $("#profile").val();

                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                btnsend_loader_hide('submitbtn')
               /* progress_hide(1);*/
                // rep_error(error.data.message)
                // ON RECUPERE LES ERREURS QUI DOIVENT ÊTRES AFFICHEES DANS LA VUE
                if (error.response.data.errors) {
                    if (error.response.data.errors.quantite) {
                        this.e_quantite = error.response.data.errors.quantite[0];
                    }
                 /*   if (error.response.data.errors.numero) {
                        this.e_numero = error.response.data.errors.numero[0];
                    }*/
                    if (error.response.data.errors.mode_paiement) {
                        this.e_mode_paiement = error.response.data.errors.mode_paiement[0];
                    }


                }

            })
        },

    },
    mounted() {
      ;


    }
})
