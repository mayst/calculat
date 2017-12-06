@extends('layouts.header')

@section('content')
    <style type="text/css">
        #messages{
            border: 1px solid black;
            height: 300px;
            margin-bottom: 8px;
            overflow: scroll;
            padding: 5px;
        }
    </style>
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Chat Message Module ID: {{ Auth::user()->id }}</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-8" >
                                <div id="messages" >
                                    @foreach($messages as $message)
                                        <strong>{{ $message->user->name }}</strong>
                                        <p>{{ $message->message }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-8" >
                                <form action="/sendmessage" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                    <input type="hidden" name="receiver" value="{{ '1' }}" >
                                    <textarea class="form-control msg" name="message"></textarea>
                                    <br/>
                                    <input type="button" value="Send" class="btn btn-success send-msg">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var receiver = $("input[name='receiver']").val();

        var name = [ {{ Auth::user()->id }}, receiver ].sort().join('.');

        var socket = io(':8890'),
                channel = name + ':message';
//                channel = 'chat:message';

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
//            data = jQuery.parseJSON(data);
//            console.log(data);
            $( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
        });
        $(".send-msg").click(function(e){
            e.preventDefault();
            var token = $("input[name='_token']").val();
            var msg = $(".msg").val();
            if(msg != ''){
                $.ajax({
                    type: "POST",
                    url: '{{ url('sendmessage') }}',
                    dataType: "json",
                    data: {
                        '_token': token,
                        'message': msg,
                        'receiver': receiver
                    },
                    success:function(data){
                        $(".msg").val('');
                    }
                });
            }else{
                alert("Please Add Message.");
            }
        });
    </script>
@endsection