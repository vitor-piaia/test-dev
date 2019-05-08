// ==================================================================
// ====================== SUBMIT DE FORMULÁRIO ======================
// ==================================================================

$(".submit-form").on('click', function(event){
    event.preventDefault();
    submitForm(jQuery(this).closest('form'));
});


function submitForm(form){
    if(form != undefined){
        if(!form.hasClass('clicked')){
            form.addClass('clicked');
            form.submit();
        }
    }
}

// ==================================================================
// ====================== SERIALIZE FORMULÁRIO ======================
// ==================================================================
$.fn.serializeForm = function() {
    var data = {};
    $.each( this.serializeArray(), function( key, obj ) {
        data[obj.name] = obj.value;
    });

    return data;
};

// ==================================================================
// ============================ iCHECK ==============================
// ==================================================================
try{
    iCheck();
    function iCheck() {
        var item = $("input[type='checkbox']:not(.js-switch), input[type='radio']");
        item.show();
        item.iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    }
}catch(err){

}

// ==================================================================
// ============================ TOOLTIP =============================
// ==================================================================

$(function(){
    try{
        tooltip();
    }catch(error){

    }
});

function tooltip(){
    $('[data-tooltip=on]').tooltip();
}

// ==============================================================================
// ================================== MÁSCARAS ==================================
// ==============================================================================
$(function(){
    makeMask();
});

function makeMask()
{
    try{
        $('.date').mask('00/00/0000');
        $('.month-year').mask('00/00');
        $('.number').mask('000000000');
        $('.time').mask('00:00');
        $('.cep').mask('00.000-000');
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        $('.percent').mask('000.000.000.000.000,00', {reverse: true});
        $("input.cpf").mask("999.999.999-99");
        $("input.cnpj").mask("99.999.999/9999-99");
        $('.telefone').focusout(function(){
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if(phone.length > 10) {
                element.mask("99 99999-9999");
            } else {
                element.mask("99 9999-99999");
            }
        }).trigger('focusout');

        var digits = $('.digits');
        digits.on('paste', function(){
            var item = $(this);
            setTimeout(function(){
                var numberPattern = /\d+/g;
                var match = item.val().match(numberPattern);
                item.val('');
                if(match != null){
                    item.val(match.join([]));
                }
            });
        });

        digits.on('keypress', function(event){
            var keyCode = event.charCode;
            if((keyCode < 48 || keyCode > 57) && keyCode !== 0 && keyCode !== 118){
                event.preventDefault();
            }
        });
    }catch(err){

    }
}

// ==============================================================================
// ================================== DATA PICKERS ==============================
// ==============================================================================
var datepickerOptions = {
    format: 'dd/mm/yyyy',
    language: 'pt-BR',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
};

$(function(){
    try{
        makeDatePicker();
    }catch(err){

    }
});

function makeDatePicker(){
    $('.datepicker').datepicker(datepickerOptions);
}

// ==============================================================================
// ============================= EXIBIÇÃO DA INFORMAÇÃO =========================
// ========================== APÓS CARREGAMENTO DA PÁGINA =======================
// ==============================================================================
setTimeout(function(){
    $('.show-after-load').slideDown();
}, 500);

// ==============================================================================
// ======================== REMOVE TEXTO CARREGANDO APÓS LOAD ===================
// ==============================================================================
try {
    $(document).ajaxComplete(function() {
        hideLoader();
    });

    Pace.on("done", function() {
        hideLoader();
    });

    function hideLoader()
    {
        $('.overlay-loader').delay(100).animate({
            top: '-10px',
            opacity: 'toggle'
        }, 'slow');

        setTimeout(function() {
            $('.overlay-loader').remove();
        }, 450);
    }
}catch (err){}

// ==============================================================================
// =========================== ELEMENTOS MESMA ALTURA ===========================
// ============================= PARAMS: el (OBJETO) ============================
// ==============================================================================
var sameHeight = function sameHeight(el) {
    var elArr = el.toArray();
    var elHeight = elArr.reduce(function(prev, curr) {
        return prev.offsetHeight > curr.offsetHeight ? prev.offsetHeight : curr.offsetHeight;
    });

    el.each(function() {
        el.css('height', elHeight);
    });
};

// ==============================================================================
// ================================= CLIPBOARD ==================================
// ==============================================================================

function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

// ==============================================================================
// ================================== TOOLTIP ===================================
// ==============================================================================
try {
    $('[data-tooltip="on"]').on('click', function() {
        $(this).blur();
    });
}catch (err) {}

// ==============================================================================
// ================================== LOADER ====================================
// ==============================================================================
var Loader = function(){
    var object = null;

    var show = function(el){
        $(el).prepend('<p class="public-loader">Aguarde<span class="btn-dot"></span><span class="btn-dot"></span><span class="btn-dot"></span></p>');
    };

    var done = function() {
        $('.public-loader').remove();
    }

    return {
        show: show,
        done: done
    }
};

// ==============================================================================
// ======================== ADICIONA SCROLL AO MODAL ============================
// ==============================================================================
try {
    $('.modal-scroll').slimScroll({
        height: '250px'
    });
}catch (err) {}

// ==============================================================================
// ======================== FORMATAÇÃO PARA DINHEIRO ============================
// ==============================================================================
Number.prototype.toMoney = function(decPlaces, thouSeparator, decSeparator) {
    var n = this,
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "," : decSeparator,
        thouSeparator = thouSeparator == undefined ? "." : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};

// ==============================================================================
// ======================== AUTOCOMPLETE ============================
// ==============================================================================

$(document).ready(function() {
    try{
        $(".autocomplete").autocomplete({
            source: function (request, response) {
                var element = $(this)[0].element;
                if (element.data('url') != undefined && element.data('url') != '') {
                    $.ajax({
                        url: element.data('url'),
                        dataType: 'json',
                        data: {term: request.term, id: element.data('id')},
                        success: function (data) {
                            response(data.result);
                        }
                    });
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                var elementName = $(this).attr('name');
                $('input[name="' + elementName + '"]').val(ui.item.value);
                $('input[id="autcom-' + elementName + '"]').val(ui.item.id);
            },
            delay: 0,
            minLength: 2,
            autofocus: true,
            change: function (event, ui) {
                var elementName = $(this).attr('name');
                if (!ui.item) {
                    $(this).val("");
                    $('input[id="autcom-' + elementName + '"]').val("");
                }
            }
        });
    }catch (err) {}
});