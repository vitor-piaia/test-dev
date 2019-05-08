var Modal = function(){
    var danger = function(title, message){
        var modal = document.getElementById('default-modal');
        var $modal = $(modal);
        $modal.unbind('confirm');
        $modal.unbind('close');

        var template = new ModalTemplates();
        var html = template.getDanger(title, message);

        $modal.empty().append(html);
        $modal.on('click', '#do-it', function(){
            assignEvent(modal, 'confirm')
        });

        $modal.on('hide.bs.modal', function(){
            assignEvent(modal, 'close')
        });

        $modal = addOpenMethod($modal);
        $modal = addCloseMethod($modal);

        return $modal;
    };

    var cancel = function(title, message){
        var modal = document.getElementById('default-modal');
        var $modal = $(modal);
        $modal.unbind('confirm');
        $modal.unbind('close');

        var template = new ModalTemplates();
        var html = template.getCancel(title, message);

        $modal.empty().append(html);
        $modal.on('click', '#do-it', function(){
            assignEvent(modal, 'confirm')
        });

        $modal.on('hide.bs.modal', function(){
            assignEvent(modal, 'close')
        });

        $modal = addOpenMethod($modal);
        $modal = addCloseMethod($modal);

        return $modal;
    };

    var info = function(title, message){
        var modal = document.getElementById('default-modal');
        var $modal = $(modal);
        $modal.unbind('confirm');
        $modal.unbind('close');

        var template = new ModalTemplates();
        var html = template.getInfo(title, message);

        $modal.empty().append(html);

        $modal.on('hide.bs.modal', function(){
            assignEvent(modal, 'close')
        });

        $modal = addOpenMethod($modal);
        $modal = addCloseMethod($modal);

        return $modal;
    };

    var success = function(title, message){
        var modal = document.getElementById('default-modal');
        var $modal = $(modal);
        $modal.unbind('confirm');
        $modal.unbind('close');

        var template = new ModalTemplates();
        var html = template.getSuccess(title, message);

        $modal.empty().append(html);

        $modal.on('hide.bs.modal', function(){
            assignEvent(modal, 'close')
        });

        $modal = addOpenMethod($modal);
        $modal = addCloseMethod($modal);

        return $modal;
    };

    var confirm = function(title, message)
    {
        var modal = document.getElementById('default-modal');
        var $modal = $(modal);
        $modal.unbind('confirm');
        $modal.unbind('close');

        var template = new ModalTemplates();
        var html = template.getConfirm(title, message);

        $modal.empty().append(html);
        $modal.on('click', '#do-it', function(){
            assignEvent(modal, 'confirm')
        });

        $modal.on('hide.bs.modal', function(){
            assignEvent(modal, 'close')
        });

        $modal = addOpenMethod($modal);
        $modal = addCloseMethod($modal);

        return $modal;
    };

    var confirmSmall = function(title, message)
    {
        var modal = document.getElementById('default-modal');
        var $modal = $(modal);
        $modal.unbind('confirm');
        $modal.unbind('close');

        var template = new ModalTemplates();
        var html = template.getConfirmSmall(title, message);

        $modal.empty().append(html);
        $modal.on('click', '#do-it', function(){
            assignEvent(modal, 'confirm')
        });

        $modal.on('hide.bs.modal', function(){
            assignEvent(modal, 'close')
        });

        $modal = addOpenMethod($modal);
        $modal = addCloseMethod($modal);

        return $modal;
    };

    /** Modal customizado de acordo com o seletor. É criado um objeto de modal */
    var custom = function(selector, html)
    {
        var modal = document.querySelector(selector);
        var $modal = $(modal);
        $modal.unbind('confirm');
        $modal.unbind('close');

        $modal.empty().append(html);
        $modal.on('click', '#do-it', function(){
            assignEvent(modal, 'confirm')
        });

        $modal.on('hide.bs.modal', function(){
            assignEvent(modal, 'close')
        });

        $modal = addOpenMethod($modal, selector);
        $modal = addCloseMethod($modal, selector);

        return $modal;
    };

    function assignEvent(item, eventName){
        var event = document.createEvent("Event");
        event.initEvent(eventName, true, false);
        item.dispatchEvent(event);
    }

    /**
     * Adiciona método para abrir o modal
     */
    function addOpenMethod(modal, selector){
        if(selector === undefined){
            selector = '#default-modal';
        }

        modal.open = function(){
            var html = '<a id="modal-default-open-link" style="display: none;" data-toggle="modal" data-target="' + selector + '"></a>';
            $('body').append(html);

            var item = $('#modal-default-open-link');
            item.trigger('click');
            item.remove();

            return this;
        };

        return modal;
    }

    /**
     * Adiciona método para fechar o modal
     */
    function addCloseMethod(modal) {
        modal.close = function () {
            this.trigger('click');
            return this;
        };

        return modal;
    }

    return {
        danger:         danger,
        cancel:         cancel,
        info:           info,
        success:        success,
        confirm:        confirm,
        confirmSmall:   confirmSmall,
        custom:         custom
    }
};