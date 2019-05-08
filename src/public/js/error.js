var Error = function(){
    /** objeto que a classe de erro irá trabalhar */
    var object = null;

    var apply = function(erros){
        for(var id in erros){
            var mensagem = erros[id][0];
            var item = $('#' + id.toString().replace(/\./g, '-'));
            var closestDiv = item.closest('div');

            if(closestDiv.closest('.add-product-form').length > 0) {
                closestDiv
                    .closest('.form-group')
                    .addClass('has-error')
                    .append('<div class="has-error"><span class="help-block">' + mensagem + '</span></div>');
            }else {
                closestDiv.addClass('has-error');

                if(closestDiv.find('.input-group-addon').length > 0 || closestDiv.hasClass('select-wrapper') || closestDiv.hasClass('pretty') ){
                    $('<div class="has-error"><span class="help-block">' + mensagem + '</span></div>').insertAfter(closestDiv);
                }else{
                    $('<span class="help-block">' + mensagem + '</span>').insertAfter(item);
                }
            }
        }
    };

    var applyBlock = function(errors, element){
        var errorsHtml= '';
        errorsHtml = '<ul>';

        $.each( errors, function( key, value ) {
            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
        });
        errorsHtml += '</ul>';
        element.empty().append(errorsHtml).removeClass('d-none');
    };

    var applyBlockViaCEP = function(error, element){
        var closestDiv = element.closest('div');
        closestDiv.addClass('has-error');

        if(closestDiv.find('.input-group-addon').length > 0 || closestDiv.hasClass('select-wrapper')){
            $('<div class="has-error"><span class="help-block">' + error + '</span></div>').insertAfter(closestDiv);
        }else{
            $('<span class="help-block">' + error + '</span>').insertAfter(element);
        }
    };

    var clear = function(){
        var divError = $('div.has-error');
        var helpBlock = $('.help-block');

        if(object !== null){
            divError = object.parents(divError);
            helpBlock = object.siblings(helpBlock);
        }

        divError.removeClass('has-error');
        helpBlock.remove();
    };

    var item = function(param){
        object = param;
        return this;
    };

    return {
        apply: apply,
        clear: clear,
        item: item,
        applyBlock: applyBlock,
        applyBlockViaCEP: applyBlockViaCEP
    }
};