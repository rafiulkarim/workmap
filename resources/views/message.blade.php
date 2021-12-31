@extends('layouts.front-layout.message_layout')

@section('header_script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .chat-online {
            color: #34ce57;
        }

        .chat-offline {
            color: #e4606d;
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            height: 400px;
            overflow-y: scroll;
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0;
        }

        .chat-message-left {
            margin-right: auto;
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto;
        }
        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }
        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }
        .flex-grow-0 {
            flex-grow: 0 !important;
        }
        .border-top {
            /*border-top: 1px solid #dee2e6 !important;*/
        }
    </style>
@endsection

@section('content')
    <div id="snippetContent">
        <main class="content">
            <div class="container p-0">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-lg-5 col-xl-3 border-right">
                            @if(Auth::user()->User_role == 1)
                                @foreach($freelancers as $freelancer)
                                    <a href="{{ route('message', $freelancer->freelancer_id) }}" class="list-group-item list-group-item-action border-0">
                                        <div id="message-count-{{ $freelancer->freelancer_id }}">
                                            @if($freelancer->unread_message>0)
                                                <div class="badge bg-success float-right">{{ $freelancer->unread_message }}</div>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <img src="https://ui-avatars.com/api/?name={{ $freelancer->freelancer->name }}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40" />
                                            <div class="flex-grow-1 ml-3">
                                                {{ $freelancer->freelancer->name }}
                                                <div class="small" id="status_{{$freelancer->freelancer_id}}">
                                                    @if($freelancer->freelancer->is_online == 1)
                                                        <span class="fa fa-circle chat-online"></span> Online
                                                    @else
                                                        <span class="fa fa-circle chat-offline"></span> Offline
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @elseif(Auth::user()->User_role == 2)
                                @foreach($clients as $client)
                                    <a href="{{ route('message', $client->client_id) }}" class="list-group-item list-group-item-action border-0">
                                        <div id="message-count-{{ $client->client_id }}">
                                            @if($client->unread_message>0)
                                                <div class="badge bg-success float-right">{{ $client->unread_message }}</div>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <img src="https://ui-avatars.com/api/?name={{ $client->client->name }}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40" />
                                            <div class="flex-grow-1 ml-3">
                                                {{ $client->client->name }}
                                                <div class="small" id="status_{{$client->client_id}}">
                                                    @if($client->client->is_online == 1)
                                                        <span class="fa fa-circle chat-online"></span> Online
                                                    @else
                                                        <span class="fa fa-circle chat-offline"></span> Offline
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                            <hr class="d-block d-lg-none mt-1 mb-0" />
                        </div>
                        <div class="col-12 col-lg-7 col-xl-9">
                            @if($id)
                                <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                    <div class="d-flex align-items-center py-1">
                                        <div class="position-relative"><img src="https://ui-avatars.com/api/?name={{ $other_user->name }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40" /></div>
                                        <div class="flex-grow-1 pl-3">
                                            <strong>{{ $other_user->name }}</strong>
                                            <div class="text-muted small" id="typing-in"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <div class="chat-messages p-4">
                                        @foreach($messages as $message)
                                            @if($message['user_id'] == Auth::user()->id)
                                                <div class="chat-message-right pb-4">
                                                    <div>
                                                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40" />
                                                        <div class="text-muted small text-nowrap mt-2">{{ date("h:i A",
                                                    strtotime($message['created_at']) )}}</div>
                                                    </div>
                                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                        <div class="font-weight-bold mb-1">You</div>
                                                        {{ $message['message'] }}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="chat-message-left pb-4">
                                                    <div>
                                                        <img src="https://ui-avatars.com/api/?name={{ $other_user->name }}"
                                                             class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40" />
                                                        <div class="text-muted small text-nowrap mt-2">{{ date("h:i A",
                                                    strtotime($message['created_at']) )}}</div>
                                                    </div>
                                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                        <div class="font-weight-bold mb-1">{{ $other_user->name }}</div>
                                                        {{ $message['message'] }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex-grow-0 py-3 px-4 border-top">
                                    <form id="chat-form" autocomplete="off">
                                        <div class="input-group">
                                            <input type="text" id="message-input" class="form-control" placeholder="Type your message" />
                                            <button class="btn btn-primary" type="submit" value="submit">Send</button>
                                        </div>
                                    </form>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@section('footer_script')
    <script>
        var timeOut;
        $(function () {
            var user_id = "{{ Auth::user()->id }}";
            var other_user_id = "{{ ($other_user)?$other_user->id:'' }}";
            var other_user_name = "{{ ($other_user)?$other_user->name:'' }}";
            var socket = io("http://localhost:3000", {query:{user_id: user_id}});

            $(".chat-messages").animate({scrollTop:$(".chat-messages").prop("scrollHeight")}, 100);

            $('#chat-form').on('submit', function (e) {
                e.preventDefault();
                var message = $('#message-input').val();
                if (message.trim().length == 0){
                    $('#message-input').focus();
                }else {
                    var data = {
                        user_id: user_id,
                        other_user_id: other_user_id,
                        message: message,
                        other_user_name: other_user_name
                    }
                    socket.emit('send_message', data);
                    $('#message-input').val('');
                }
            });

            socket.on('receive_message', function (data) {
                if((data.user_id == user_id && data.other_user_id == other_user_id) || (data.user_id == other_user_id
                    && data.other_user_id == user_id)){
                    if(data.user_id == user_id){
                        var html = `<div class="chat-message-right pb-4">
                            <div>
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40" />
                                <div class="text-muted small text-nowrap mt-2">${data.time}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                <div class="font-weight-bold mb-1">You</div>
                                ${data.message}
                            </div>
                        </div>`;
                    }else {
                        socket.emit('read_message', data.id);
                        var html = `<div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://ui-avatars.com/api/?name=${other_user_name}"
                                         class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40" />
                                    <div class="text-muted small text-nowrap mt-2">${data.time}</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">${other_user_name}</div>
                                    ${data.message}
                                </div>
                            </div>
                            <audio src="https://2u039f-a.akamaihd.net/downloads/ringtones/files/mp3/facebook-messenger-tone-wapking-fm-mp3-17015-19072-43455.mp3" autoplay>`;
                    }
                    $('.chat-messages').append(html);
                    // $('audio').html('<audio src="https://2u039f-a.akamaihd.net/downloads/ringtones/files/mp3/facebook-messenger-tone-wapking-fm-mp3-17015-19072-43455.mp3" autoplay>');
                }else {
                    $('#message-count-'+data.user_id).html('<div class="badge bg-success float-right">'+ data.unread_message +'</div>');
                }
            });

            socket.on('user_typing', function (data) {
                if(data.user_id == other_user_id){
                    $('#typing-in').html('<em>Typing...</em>');
                    clearTimet();
                    clearTyping();
                }
            });

            $('#message-input').on('keyup', function (){
                socket.emit('user_typing', {user_id: user_id, other_user_id: other_user_id});
            });

            socket.on('user_connected', function (data) {
                $('#status_'+data).html('<span class="fa fa-circle chat-online"></span> Online');
            });

            socket.on('user_disconnect', function (data) {
                $('#status_'+data).html('<span class="fa fa-circle chat-offline"></span> Offline');
            });
        });

        function clearTyping(){
            timeOut = setTimeout(function () {
                $('#typing-in').html('');
            }, 3000);
        }

        function clearTimet(){
            clearTimeout(timeOut);
        }
    </script>
@endsection
