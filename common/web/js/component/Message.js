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