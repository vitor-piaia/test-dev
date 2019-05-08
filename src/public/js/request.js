var Request = function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
    var processData = true;

    var setContentType = function(value){
        contentType = value;
        return this;
    };

    var setProcessData = function(value){
        processData = value;
        return this;
    };

    var send = function(url, params, method, type){
        if(type === undefined){
            type = 'json';
        }

        if(method === undefined){
            method = 'POST';
        }

        return $.ajax({
            url: url,
            encoding: "UTF-8",
            dataType: type,
            contentType: contentType,
            processData: processData,
            type: method,
            data: params
        });
    };

    return {
        send: send,
        setContentType: setContentType,
        setProcessData: setProcessData
    }
};