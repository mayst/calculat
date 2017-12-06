<!-- OLD 1 CHAT -->
<div id="message-popup" class="message-popup mfp-hide zoom-anim-dialog">
    <div class="message-write">
        <div class="message-form">
            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}" >--}}
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
        <div class="message-popup-peoples">
            @if($list_dialogs)
                @foreach($list_dialogs as $dialog)
                    @php $recipient = ($dialog->receiver == Auth::user()->id) ? $dialog->user : $dialog->recipient; @endphp
                    <a data-dialog-id="{{ $recipient->id }}" href="#message{{ $recipient->id }}" class="dialog popup-tabs-btn message-popup-peoples-single">
                        <div class="message-photo">
                            <img src="/images/avatars/{{ $recipient->avatar() }}" alt="">
                            <span class="status online"></span>
                        </div>
                        <div class="message-info">
                            <p class="name">{{ $recipient->name }}</p>
                            <p class="text">{{ substr($dialog->message, 0, 25) }}...</p>
                        </div>
                        <div class="message-peoples-right">
                            <p class="date">{{ $dialog->created_at->format('d.m.y') }}</p>
                            <span class="count-message">2</span>
                        </div>
                    </a>
                    {{--{{ $recipient }}--}}
                @endforeach
            @endif
        </div>
    </div>
    <div class="message-popup-right">
        <div class="message-mobile-header">
            <a href="#" class="mobile-message-hide mobile-message-close"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <h2>Сообщение</h2>
        </div>
        <div class="message-popup-right-top">
            <h2>Сообщение</h2>
            <p class="name">{{ Auth::user()->name }}</p>
        </div>
        @if($list_dialogs)
            @foreach($list_dialogs as $dialog)
				<?php $recipient = ($dialog->receiver == Auth::user()->id) ? $dialog->user : $dialog->recipient; ?>
                <div id="message{{ $recipient->id }}" class="message-content popup-tab chat-history">
                    <div class="chat-history-list">
                    </div>
                </div>
            @endforeach
        @endif

    </div>
    <script>
        $(window).load(function() {
            var name = "{{ Auth::user()->id }}";

            var socket = io(':8890'),
                channel = name;

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
//              data = jQuery.parseJSON(data);
                console.log(data.type);

                switch(data.type) {
                    case 'message':
                        console.log(data);
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
//                    case '':
                }

            });

            var activeChat = '{{ ($list_dialogs) ? '' : $list_dialogs[0]->receiver }}';

            $(".dialog").click(function () {
                activeChat = this.getAttribute("data-dialog-id");

                $.ajax({
                    type: "POST",
                    url: "{{ url('history') }}",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    data: { rec_id: activeChat },
                    success: function (data) {
                        $("#message" + activeChat).html('');

                        for(var a in data.messages) {
                            var str = '<div class="message-single';
                            if(data.messages[a].user_id == '{{ Auth::user()->id }}') {
                                str += ' my-message';
                            }
                            str += '">';
                            if(data.messages[a].user_id != '{{ Auth::user()->id }}') {
                                str += '<div class="message-photo">';
                                str += '<img src="/images/avatars/' + data.avatar + '" alt="">';
                                str += '<span class="status online"></span>';
                                str += '</div>';
                            }
                            str += '<div class="read-info">';
                            str += '<p class="message-text">' + data.messages[a].message + '</p>';
                            str += '<div class="read-status">';
                            str += '<p class="date">' + data.messages[a].created_at + '</p>';
                            str += '<span class="readed"></span>';
                            str += '</div></div>';
                            if(data.messages[a].user_id == '{{ Auth::user()->id }}') {
                                str += '<div class="message-photo"><img src="/images/avatars/{{ Auth::user()->avatar() }}" alt=""><span class="status online"></span></div>';
                            }
                            str += '</div>';

                            $("#message" + activeChat).append(str);
                        }
                    }
                });
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
                            str += '<div class="message-photo"><img src="/images/avatars/{{ Auth::user()->avatar() }}" alt=""><span class="status online"></span></div>';
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
<!-- OLD 2 CHAT -->
<div id="message-popup" class="message-popup mfp-hide zoom-anim-dialog">
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
        <div class="message-popup-peoples">
            <a href="#message1" class="active message-popup-peoples-single popup-tabs-btn">
                <div class="message-photo">
                    <img src="img/user-photo.jpg" alt="">
                    <span class="status online"></span>
                </div>
                <div class="message-info">
                    <p class="name">Sam MacCury, 35</p>
                    <p class="text">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="message-peoples-right">
                    <p class="date">14.05.17</p>
                    <span class="count-message">2</span>
                </div>
            </a>
            <a href="#message2" class="popup-tabs-btn message-popup-peoples-single">
                <div class="message-photo">
                    <img src="img/user-photo.jpg" alt="">
                    <span class="status online"></span>
                </div>
                <div class="message-info">
                    <p class="name">Sam MacCury, 35</p>
                    <p class="text">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="message-peoples-right">
                    <p class="date">14.05.17</p>
                    <span class="count-message">2</span>
                </div>
            </a>
            <a href="#message3" class="popup-tabs-btn message-popup-peoples-single">
                <div class="message-photo">
                    <img src="img/user-photo.jpg" alt="">
                    <span class="status offline"></span>
                </div>
                <div class="message-info">
                    <p class="name">Sam MacCury, 35</p>
                    <p class="text">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="message-peoples-right">
                    <p class="date">14.05.17</p>
                </div>
            </a>
            <a href="#message4" class="popup-tabs-btn message-popup-peoples-single">
                <div class="message-photo">
                    <img src="img/user-photo.jpg" alt="">
                    <span class="status offline"></span>
                </div>
                <div class="message-info">
                    <p class="name">Sam MacCury, 35</p>
                    <p class="text">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="message-peoples-right">
                    <p class="date">14.05.17</p>
                </div>
            </a>
            <a href="#message5" class="popup-tabs-btn message-popup-peoples-single">
                <div class="message-photo">
                    <img src="img/user-photo.jpg" alt="">
                    <span class="status online"></span>
                </div>
                <div class="message-info">
                    <p class="name">Sam MacCury, 35</p>
                    <p class="text">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="message-peoples-right">
                    <p class="date">14.05.17</p>
                </div>
            </a>
            <a href="#message6" class="popup-tabs-btn message-popup-peoples-single">
                <div class="message-photo">
                    <img src="img/user-photo.jpg" alt="">
                    <span class="status offline"></span>
                </div>
                <div class="message-info">
                    <p class="name">Sam MacCury, 35</p>
                    <p class="text">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="message-peoples-right">
                    <p class="date">14.05.17</p>
                </div>
            </a>
            <a href="#message7" class="popup-tabs-btn message-popup-peoples-single">
                <div class="message-photo">
                    <img src="img/user-photo.jpg" alt="">
                    <span class="status offline"></span>
                </div>
                <div class="message-info">
                    <p class="name">Sam MacCury, 35</p>
                    <p class="text">Lorem ipsum dolor sit amet...</p>
                </div>
                <div class="message-peoples-right">
                    <p class="date">14.05.17</p>
                </div>
            </a>
        </div>
    </div>
    <div class="message-popup-right">
        <div class="message-mobile-header">
            <a href="#" class="mobile-message-hide mobile-message-close"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <h2>Сообщение</h2>
        </div>
        <div class="message-popup-right-top">
            <h2>Сообщение</h2>
            <p class="name">Sam MacCury, 35</p>
        </div>
        <div id="message1" class="message-content popup-tab chat-history">
            <div class="chat-history-list">
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-day"><span>14.05.17</span></div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single my-message">
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <span class="readed"></span>
                            <p class="date">14.05.17</p>
                        </div>
                    </div>
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="message2" class="message-content popup-tab chat-history">
            <div class="chat-history-list">
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">2Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-day"><span>14.05.17</span></div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single my-message">
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <span class="readed"></span>
                            <p class="date">14.05.17</p>
                        </div>
                    </div>
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="message3" class="message-content popup-tab chat-history">
            <div class="chat-history-list">
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">3Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-day"><span>14.05.17</span></div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single my-message">
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <span class="readed"></span>
                            <p class="date">14.05.17</p>
                        </div>
                    </div>
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="message4" class="message-content popup-tab chat-history">
            <div class="chat-history-list">
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">4Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-day"><span>14.05.17</span></div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single my-message">
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <span class="readed"></span>
                            <p class="date">14.05.17</p>
                        </div>
                    </div>
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="message5" class="message-content popup-tab chat-history">
            <div class="chat-history-list">
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">5Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-day"><span>14.05.17</span></div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single my-message">
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <span class="readed"></span>
                            <p class="date">14.05.17</p>
                        </div>
                    </div>
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="message6" class="message-content popup-tab chat-history">
            <div class="chat-history-list">
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">6Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-day"><span>14.05.17</span></div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single my-message">
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <span class="readed"></span>
                            <p class="date">14.05.17</p>
                        </div>
                    </div>
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="message7" class="message-content popup-tab chat-history">
            <div class="chat-history-list">
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">7Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-day"><span>14.05.17</span></div>
                <div class="message-single">
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sdiduore magna aliqua. Ut enim ad</p>
                        <div class="read-status">
                            <p class="date">14.05.17</p>
                            <span class="readed"></span>
                        </div>
                    </div>
                </div>
                <div class="message-single my-message">
                    <div class="read-info">
                        <p class="message-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                        <div class="read-status">
                            <span class="readed"></span>
                            <p class="date">14.05.17</p>
                        </div>
                    </div>
                    <div class="message-photo">
                        <img src="img/user-photo.jpg" alt="">
                        <span class="status online"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="message-write">
            <div class="message-form">
                <input id="message-to-send" type="text" placeholder="Введите сообщение...">
                <button class="desctop chat-btn">Отправить<i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                <button class="mobile chat-btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>