const options = {
    method: 'GET',
    headers: {
        accept: 'application/json',
        'x-chatworktoken': '6015f0e82771fb9cb4f1e9f5d6fd7913'
    }
};

fetch('https://api.chatwork.com/v2/rooms/156657493/messages?force=1', options)
    .then(response => response.json())

    .then(function (response) {
        console.log(response);
        console.log(response[1].body);

        const messages = [];
        response.forEach(message => { //メッセージを1つずつ取り出し配列にまとめる
            messages.push(message.body);
        });
        console.log(messages);
        $("#output").html(messages);
    })

    .catch(err => console.error(err));
