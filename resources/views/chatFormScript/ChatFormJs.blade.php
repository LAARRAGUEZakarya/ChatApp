<script>
    $(document).ready(function(){
        $("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
        $('#action_menu_btn').click(function(){
            $('.action_menu').toggle();
        });
        });


        $('#send').click(function(){
        // Retrieve the CSRF token value from a meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.post("/sendMessage",
            {
                _token: csrfToken, // Include the CSRF token
                user_id:{{$receiver->id}},
                message: $("#message").val(),
            },
            function(data, status) {
            // console.log("Data: " + data + "\nStatus: " + status);
            let senderMessage = `
                <div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">
                        ${$("#message").val()}
                        <span class="msg_time_send">${getCurrentTimeFormatted()}</span>
                    </div>
                    <div class="img_cont_msg">
                        <img src="{{ Auth::user()->image }}" class="rounded-circle user_img_msg">
                    </div>
                </div>`;
            $("#chat_area").append(senderMessage);
            $("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);

            $("#message").val('');
        })
    })


    function getCurrentTimeFormatted() {
        const currentDate = new Date();
        let hours = currentDate.getHours();
        let minutes = currentDate.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';

        // Convert hours to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // '0' should be '12'

        // Pad minutes with leading zero if necessary
        minutes = minutes < 10 ? '0' + minutes : minutes;

        return hours + ':' + minutes + ' ' + ampm + ', Today';
    }




        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('e2e929b62f46ba459441', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('chat'+{{auth()->user()->id}});
            channel.bind('chatMessage', function(data) {

            // Extracting values
            const image = data.receiver.image;
            const message = data.message;

            // Generating HTML with the extracted values
            const receiverMessage = `<div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="{{asset('${image}')}}" class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer">
                                ${message}
                                <span class="msg_time">${getCurrentTimeFormatted()}</span>
                            </div>
                        </div>`;
            $("#chat_area").append(receiverMessage);
            $("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);

        });
</script>
