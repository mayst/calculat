<div id="message-popup" class="message-popup mfp-hide zoom-anim-dialog">
    <div class="message-write">
        <div class="message-form">
            <input id="rec" type="hidden" name="receiver" value="" >
            <input id="message-to-send" type="text" placeholder="Введите сообщение..." name="message" class="msg">
            <button id="send-msg" class="desctop chat-btn">Отправить<i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            <button id="send-msg" class="mobile chat-btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="message-popup-left">
        <div class="message-mobile-header">
            <a href="#" class="mfp-close mobile-message-close">X</a>
            <h2>Сообщение</h2>
        </div>
        <div class="message-popup-search">
            <form action="/" class="message-popup-search-form">
                <button class="refresh">X</button>
                <div class="message-search">
                    <input type="text" class="form-controll" placeholder="Поиск">
                    <button class="search-btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
        @php $user = Auth::user(); @endphp
        <div class="message-popup-peoples">
            {{--@if($list_dialogs)--}}
                {{--@foreach($list_dialogs as $dialog)--}}
                    {{--{{ $dialog }}--}}
                {{--{{ $dialog->lastMsg['receiver'] }}--}}
                    {{--@php $recipient = ($dialog->lastMsg->receiver == $user->id) ? $dialog->lastMsg->user : $dialog->lastMsg->recipient; @endphp
                    <a data-dialog-id="{{ $recipient->id }}" href="#message{{ $recipient->id }}" class="dialog popup-tabs-btn message-popup-peoples-single">
                        <div class="message-photo">
                            <img src="/images/avatars/{{ $recipient->avatar() }}" alt="">
                            <span class="status online"></span>
                        </div>
                        <div class="message-info">
                            <p class="name">{{ $recipient->name }}</p>
                            <p class="text">{{ substr($dialog->lastMsg->message, 0, 25) }}...</p>
                        </div>
                        <div class="message-peoples-right">
                            <p class="date">{{ $dialog->lastMsg->created_at->format('d.m.y') }}</p>
                            <span class="count-message">2</span>
                        </div>
                    </a>
                    <div style="cursor: pointer;">
                        more dialogs..
                    </div>--}}
                {{--@endforeach--}}
            {{--@endif--}}
        </div>
    </div>
    <div class="message-popup-right">
        <div class="message-mobile-header">
            <a href="#" class="mobile-message-hide mobile-message-close"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <h2>Сообщение</h2>
        </div>
        <div class="message-popup-right-top">
            <h2>Сообщение</h2>
            <p class="name">{{ $user->name }}</p>
        </div>
        {{--@if($list_dialogs)--}}
            {{--@foreach($list_dialogs as $dialog)--}}
                {{--@php $recipient = ($dialog->lastMsg->receiver == $user->id) ? $dialog->lastMsg->user : $dialog->lastMsg->recipient; @endphp
                <div id="message{{ $recipient->id }}" class="message-content popup-tab chat-history">
                    <div class="chat-history-list">
                    </div>
                </div>--}}
            {{--@endforeach--}}
        {{--@endif--}}

    </div>
    <script>
        $(window).load(function() {
            var name = "{{ $user->id }}";

            var socket = io('https://dovedating.com:8890'),
                    channel = name;

            console.log('i`m working');

            socket.on('connect', function () {
                socket.emit('subscribe', channel)
            });

            socket.on('error', function (error) {
                console.warn('Error', error);
            });

            socket.on('message', function(message) {
                console.info(message);
            });

            socket.on(channel, function (data) {
                console.log(data.type);

                switch(data.type) {
                    case 'message':
                        var msg = '<div class="message-single">';
                        msg += '<div class="message-photo">';
                        msg += '<img src="/images/avatars/' + data.avatar + '" alt="">';
                        msg += '<span class="status online"></span>';
                        msg += '</div>';
                        msg += '<div class="read-info">';
                        msg += '<p class="message-text">' + data.message.message + '</p>';
                        msg += '<div class="read-status">';
                        msg += '<p class="date">' + data.message.created_at + '</p>';
                        msg += '<span class="readed"></span>';
                        msg += '</div></div>';
                        msg += '</div>';

                        $("#message" + data.message.user_id).append(msg);
                        break;
                    case 'favorite':
                        console.log(data);
                }

            });

            {{--var activeChat = '{{ (!$list_dialogs) ? '' : $list_dialogs[0]->receiver }}';--}}
            var activeChat = '';

            $.ajax({
                type: "POST",
                url: '{{ url('ajax/dialogs') }}',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var dialogs = data.dialogs.data;
                    var dialog_list = '';
                    var tabs_list = '';

                    for(var i = 0; i < dialogs.length; i++) {
                        var myDate = new Date(dialogs[i].last_msg.created_at);

                        dialog_list += '<a data-dialog-id="' + data.recipients[i].id +
                            '" href="#message' + data.recipients[i].id + '" class="dialog popup-tabs-btn message-popup-peoples-single">' +
                            '<div class="message-photo">' +
                            '<img src="/images/avatars/' + data.recipients[i].avatar + '" alt="">' +
                            '<span class="status online"></span>' +
                            '</div>' +
                            '<div class="message-info">' +
                            '<p class="name">' + data.recipients[i].name + '</p>' +
                            '<p class="text">' + dialogs[i].last_msg.message.substring(0, 25) + '...</p>' +
                            '</div>' +
                            '<div class="message-peoples-right">' +
                            '<p class="date">' + (myDate.getMonth() + 1) + "." + myDate.getDate() + "." + myDate.getFullYear().toString().substr(-2) + '</p> ' +
                            '<span class="count-message">2</span>' +
                            '</div>' +
                            '</a>';
                        tabs_list += '<div id="message' + data.recipients[i].id + '" class="message-content popup-tab chat-history" style="display: none;">' +
                            '<div class="chat-history-list">' +
                            '</div></div>';
                    }
                    if(data.dialogs.next_page_url) {
                        dialog_list += '<div class="dialog-paginator" style="cursor: pointer;" data-url="' + data.dialogs.next_page_url + '">' +
                        'more dialogs..' +
                        '</div>';
                    }

                    $('.message-popup-peoples').append(dialog_list);
                    $('.message-popup-right').append(tabs_list);

                    var dialog_click = function() {
                        $(".dialog").click(function () {
                            activeChat = this.getAttribute("data-dialog-id");
                            $('.dialog').each(function(i, obj) {
                                $(obj).removeClass('active');
                            });
                            $('.chat-history').each(function(i, obj) {
                                $(obj).css('display', 'none');
                            });
                            $(this).addClass('active');
                            $('#message' + activeChat).css('display', 'block');

                            $.ajax({
                                type: "POST",
                                url: "{{ url('history') }}",
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: "json",
                                data: { rec_id: activeChat },
                                success: function (data) {
                                    console.log(data);
                                    $("#message" + activeChat).html('');

                                    var messages = data.read_messages.data;
                                    for(var a in messages) {
                                        var str = '<div class="message-single';
                                        if(messages[a].user_id == '{{ $user->id }}') {
                                            str += ' my-message';
                                        }
                                        str += '">';
                                        if(messages[a].user_id != '{{ $user->id }}') {
                                            str += '<div class="message-photo">';
                                            str += '<img src="/images/avatars/' + data.avatar + '" alt="">';
                                            str += '<span class="status online"></span>';
                                            str += '</div>';
                                        }
                                        str += '<div class="read-info">';
                                        str += '<p class="message-text">' + messages[a].message + '</p>';
                                        str += '<div class="read-status">';
                                        str += '<p class="date">' + messages[a].created_at + '</p>';
                                        str += '<span class="readed"></span>';
                                        str += '</div></div>';
                                        if(messages[a].user_id == '{{ $user->id }}') {
                                            str += '<div class="message-photo"><img src="/images/avatars/{{ $user->avatar() }}" alt=""><span class="status online"></span></div>';
                                        }
                                        str += '</div>';

                                        $("#message" + activeChat).append(str);
                                    }
                                    if(data.read_messages.next_page_url) {
                                        var more_btn = '<div class="message-paginator"' +
                                            'style="cursor: pointer; position: absolute; left: 60%;" data-url="' + data.read_messages.next_page_url + '">' +
                                            'more dialogs..' +
                                            '</div>';
                                        $("#message" + activeChat).prepend(more_btn);
                                    }

                                    var message_paginator = function() {
                                        $(".message-paginator").click(function () {
                                            var paginator = this;
                                            var url = paginator.getAttribute("data-url");

                                            $.ajax({
                                                type: "POST",
                                                url: url,
                                                headers: {
                                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                data: { rec_id: activeChat },
                                                dataType: "json",
                                                success: function (data) {
                                                    $(paginator).remove();
                                                    console.log(data);

                                                    var messages = data.read_messages.data;
                                                    for(var a in messages) {
                                                        var str = '<div class="message-single';
                                                        if(messages[a].user_id == '{{ $user->id }}') {
                                                            str += ' my-message';
                                                        }
                                                        str += '">';
                                                        if(messages[a].user_id != '{{ $user->id }}') {
                                                            str += '<div class="message-photo">';
                                                            str += '<img src="/images/avatars/' + data.avatar + '" alt="">';
                                                            str += '<span class="status online"></span>';
                                                            str += '</div>';
                                                        }
                                                        str += '<div class="read-info">';
                                                        str += '<p class="message-text">' + messages[a].message + '</p>';
                                                        str += '<div class="read-status">';
                                                        str += '<p class="date">' + messages[a].created_at + '</p>';
                                                        str += '<span class="readed"></span>';
                                                        str += '</div></div>';
                                                        if(messages[a].user_id == '{{ $user->id }}') {
                                                            str += '<div class="message-photo"><img src="/images/avatars/{{ $user->avatar() }}" alt=""><span class="status online"></span></div>';
                                                        }
                                                        str += '</div>';

                                                        $("#message" + activeChat).prepend(str);
                                                    }
                                                    if(data.messages.next_page_url) {
                                                        var more_btn = '<div class="message-paginator"' +
                                                            'style="cursor: pointer; position: absolute; left: 60%;" data-url="' + data.messages.next_page_url + '">' +
                                                            'more dialogs..' +
                                                            '</div>';
                                                        $("#message" + activeChat).prepend(more_btn);
                                                    }

                                                    message_paginator();
                                                }
                                            });
                                        });
                                    };

                                    message_paginator();
                                }
                            });
                        });
                    };

                    dialog_click();

                    var dialog_paginator = function() {
                        $(".dialog-paginator").click(function () {
                            var paginator = this;
                            var url = paginator.getAttribute("data-url");

                            $.ajax({
                                type: "POST",
                                url: url,
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: "json",
                                success: function (data) {
                                    $(paginator).remove();
                                    var dialogs = data.dialogs.data;
                                    var dialog_list = '';
                                    var tabs_list = '';

                                    for(var i = 0; i < dialogs.length; i++) {
                                        var myDate = new Date(dialogs[i].last_msg.created_at);

                                        dialog_list += '<a data-dialog-id="' + data.recipients[i].id +
                                            '" href="#message' + data.recipients[i].id + '" class="dialog popup-tabs-btn message-popup-peoples-single">' +
                                            '<div class="message-photo">' +
                                            '<img src="/images/avatars/' + data.recipients[i].avatar + '" alt="">' +
                                            '<span class="status online"></span>' +
                                            '</div>' +
                                            '<div class="message-info">' +
                                            '<p class="name">' + data.recipients[i].name + '</p>' +
                                            '<p class="text">' + dialogs[i].last_msg.message.substring(0, 25) + '...</p>' +
                                            '</div>' +
                                            '<div class="message-peoples-right">' +
                                            '<p class="date">' + (myDate.getMonth() + 1) + "." + myDate.getDate() + "." + myDate.getFullYear().toString().substr(-2) + '</p> ' +
                                            '<span class="count-message">2</span>' +
                                            '</div>' +
                                            '</a>';
                                        tabs_list += '<div id="message' + data.recipients[i].id + '" class="message-content popup-tab chat-history" style="display: none;">' +
                                            '<div class="chat-history-list">' +
                                            '</div></div>';
                                    }
                                    if(data.dialogs.next_page_url) {
                                        dialog_list += '<div class="dialog-paginator" style="cursor: pointer;" data-url="' + data.dialogs.next_page_url + '">' +
                                            'more dialogs..' +
                                            '</div>';
                                    }

                                    $('.message-popup-peoples').append(dialog_list);
                                    $('.message-popup-right').append(tabs_list);

                                    dialog_click();
                                    dialog_paginator();
                                }
                            });
                        });
                    };

                    dialog_paginator();
                }
            });



            $("#send-msg").click(function(e){
                e.preventDefault();
                var token = $("input[name='_token']").val();
                var message = $(".msg").val();

                if(message != ''){
                    $.ajax({
                        type: "POST",
                        url: '{{ url('message') }}',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        data: {
                            'message': message,
                            'receiver': activeChat
                        },
                        success:function(data){
                            $(".msg").val('');

                            var str = '<div class="message-single my-message">';
                            str += '<div class="read-info">';
                            str += '<p class="message-text">' + data[0].message + '</p>';
                            str += '<div class="read-status">';
                            str += '<p class="date">' + data[0].created_at + '</p>';
                            str += '<span class="readed"></span>';
                            str += '</div></div>';
                            str += '<div class="message-photo"><img src="/images/avatars/{{ $user->avatar() }}" alt=""><span class="status online"></span></div>';
                            str += '</div>';

                            $("#message" + activeChat).append(str);
                        }
                    });
                } else {
                    alert("Please Add Message.");
                }
            });

        });
    </script>
</div>