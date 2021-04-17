$(document).ready(function (){

})

var app = new Vue({
    el: '#content',
    data: function () {
        return {
            permission_id: '',
        }
    },
    methods: {
        store() {

            this.permission_id = ''
            progress_show();
            var config = {
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progress_counter(percentCompleted);
                }
            };

            var frmCreate = $("#frmCreate");
            let formData = new FormData(frmCreate[0]);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))
            axios.post($("#store").val(), formData, config, {}).then((response) => {
                progress_hide();

                if (response.data.success === true) {

                    rep_success(response.data.message)

                } else {
                    rep_error(response.data.message)
                }

            }).catch(error => {
                progress_hide(1);
                // rep_error(error.data.message)
                //
                if (error.response.data.errors) {
                    if (error.response.data.errors.permission_id) {
                        this.e_name = error.response.data.errors.permission_id[0];

                    }

                }

            })
        },
    },
    mounted() {
        $("#select-all").on("change",function (){
            var checked = $(this).is(':checked');
            if(this.checked){
                $(':checkbox').each(function (){
                    this.checked = true;
                    console.log(checked)
                });
            }else {
                $(':checkbox').each(function (){
                    this.checked = false;
                });
            }
        })
    }
})




