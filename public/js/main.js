(function($) {

    var form = $("#form-demande-naissance");
    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slide",
        labels: {
            previous : 'Précédent',
            next : 'Suivant',
            finish : 'Soumettre',
            current : ''
        },
        titleTemplate : '<div class="title"><span class="title-text">#title#</span><span class="title-number">0#index#</span></div>',
        onFinished: function (event, currentIndex)
        {
            $('#form-demande-naissance').submit();
            
        }
    });
    
    
})(jQuery);
