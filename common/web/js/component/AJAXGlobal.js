/* version 2.1 */
; (function (win) {
    var callSuccess = function() {},
        callError = function() {},
        callComplete = function() {},
        callBeforeSend = function() {};

    var Option = {
        async: true,
        url: '/',
        type: 'POST',
        dataType: 'json',
        data: {},
        processData: true,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        beforeSend: function (async) {
            if (!async) {
                Animate_Load().start();
            }
            return function(jqXHR, settings) {
                if (typeof callBeforeSend === 'function') {
                    callBeforeSend();
                } else {
                    console.error('Parameter "BeforeSend" is not a function');
                }
            }
        },
        success: function (data) {

            if (data.success) {
                if (typeof callSuccess === 'function') {
                    callSuccess(data);
                } else {
                    console.error('Parameter "Success" is not a function');
                }
            }

            if (data.message) {
                if (data.message.Error) {
                    Message({
                        MessageText: data.message.Error || 'Неизвестная ошибка',
                        Delay: 4000
                    }).Error().consoleError(data.consoleMessage || 'Неизвестная ошибка');
                }
                if (data.message.Info) {
                    Message({
                        MessageText: data.message.Info || 'Информация'
                    }).Info();
                }
                if (data.message.Success) {
                    Message({
                        MessageText: data.message.Success || 'Успех'
                    }).Success();
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {

            if (typeof callError === 'function') {
                callError();
            } else {
                console.error('Parameter "Error" is not a function');
            }

            var error = thrownError.length == 0 ? "Обрыв соединения" : thrownError + ". Обрыв соединения";
            Message({
                MessageText: error,
                Delay: 4000
            }).Error().consoleError(error);
        },
        complete: function (async) {
            if (!async) {
                Animate_Load().stop();
            }
            return function(jqXHR, textStatus) {
                if (typeof callComplete === 'function') {
                    callComplete();
                } else {
                    console.error('Parameter "Complete" is not a function');
                }
            }
        }
    };

    var ex = {};

    win.AJAXGlobals = function (option) {

        callSuccess = option.success || function () { };
        callError = option.error || function () { };
        callComplete = option.complete || function () { };
        callBeforeSend = option.beforeSend || function() { };

        var async = option.async === false ? false : Option.async;

        $.ajax({
            async: async,
            url: option.url || Option.url,
            type: option.type || Option.type,
            dataType: option.dataType || Option.dataType,
            data: option.data || Option.data,
            processData: option.processData === false ? false : (option.processData || Option.processData) ,
            contentType : option.contentType === false ? false : (option.contentType || Option.contentType),
            beforeSend: Option.beforeSend(async),
            success: Option.success,
            error: Option.error,
            complete: Option.complete(async)
        });

        return ex;
    };

})(this);