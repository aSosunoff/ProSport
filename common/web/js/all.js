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
/*version 1.0*/
; (function (win) {
    var messageText = '';
    var delay;
    var messageBlock = '<div></div>';

    function Go(text, addClass) {
        var color = '';
        switch (addClass) {
            case 'info':
                color = 'rgb(184, 198, 255)';
                break;
            case 'error':
                color = 'rgb(255, 184, 184)';
                break;
            case 'success':
                color = 'rgb(188, 255, 159)';
                break;
            default:
                color = '#ccc';
        }
        var $mBox = $(messageBlock)
            .html(text)
            .css({
                "position": "fixed",
                "top": "0px",
                "left": "10px",
                "width": "360px",
                "height": "auto",
                "padding": "10px",
                "background-color": color,
                "border-radius": "0px 0px 0px 0px",
                "z-index": "10505"
            })
            .fadeTo(300, 1)
            .delay(delay)
            .fadeTo(300, 0, function () {
                $(this).remove();
            });

        $('body').prepend($mBox);
    };

    var consoleObject = {
        consoleWarn: function (messageText) {
            console.warn(messageText);
        },
        consoleError: function (messageText) {
            console.error(messageText);
        },
        consoleInfo: function (messageText) {
            console.info(messageText);
        }
    }

    var ex = {
        Info: function () {
            Go(messageText, 'info');
            return consoleObject;
        },
        Error: function () {
            Go(messageText, 'error');
            return consoleObject;
        },
        Success: function () {
            Go(messageText, 'success');
            return consoleObject;
        }
    };



    win.Message = function (option) {
        messageText = (option && option.MessageText) || '';
        delay = (option && option.Delay) || 2000;
        return ex;
    };

})(this);
/* version 1.0 */

; (function (win, $) {

    var _library = function (option) {
        var elementIn = 'body',
            followCursor = (option && option.FollowCursor) ? option.FollowCursor : false,
            gifClassName = 'mouse-load-gif',
            shadeClassName = 'shade';

        var gif = $("<div></div>").addClass(gifClassName).css({
            width: "50px",
            height: "50px",
            position: "absolute",
            display: "none",
            'z-index': "2001",
            "background-image": 'url("data:image/png;base64,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")'
        });

        function _setGefElementCEnter() {
            var heightElement = $(elementIn).outerHeight(),
                widthElement = $(elementIn).outerWidth(),
                heightGif = gif.outerHeight(),
                widthGif = gif.outerWidth();

            /* Set our gif element to the center */
            gif.css({
                top: (heightElement / 2) - (heightGif / 2),
                left: (widthElement / 2) - (widthGif / 2)
            });
        }

        var shade = $('<div></div>').addClass(shadeClassName).css({
            position: 'fixed',
            top: '0px',
            left: '0px',
            width: '100%',
            height: '100%',
            display: 'none',
            'z-index': "2000",
            'background-color': 'rgba(0, 0, 0, 0.2)'
        });
        return {
            start: function () {

                _setGefElementCEnter();

                $(elementIn).append(gif);
                gif.fadeIn(500);

                $(elementIn).append(shade);
                shade.fadeIn(500);

                if (followCursor) {

                    $(elementIn).mouseenter(function (e) {
                        $('.' + shadeClassName).fadeOut(500, function () {
                            $(this).remove();
                        });
                    });

                    $(elementIn).mouseleave(function (e) {
                        $(this).append(shade);
                        shade.fadeIn(500);

                        _setGefElementCEnter();
                    });

                    $(elementIn).mousemove(function (e) {
                        var width = 50,
                            height = 50;
                        var left = e.pageX - width / 2 + 3;
                        var top = e.pageY - height / 2 + 6;

                        $('.' + gifClassName).css({
                            left: left,
                            top: top
                        });
                    });
                }
            },
            stop: function () {
                $('.' + shadeClassName).fadeOut(500, function () {
                    $(this).remove();
                });
                $('.' + gifClassName).fadeOut(500, function () {
                    $(this).remove();
                });
            }
        }



    };
    win.Animate_Load = function (option) {
        return new _library(option);
    }
})(this, jQuery);