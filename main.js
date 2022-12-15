const options = {
    method: 'GET',
    headers: {
        accept: 'application/json',

    }
};

fetch('https://api.chatwork.com/v2/rooms//messages?force=1', options)
    .then(response => response.json())

    .then(function (response) {
        console.log(response);
        console.log(response[1].body);

        const messages = [];
        response.forEach(message => {
            messages.push(message.body);
        });
        console.log(messages);
        $("#output").html(messages);
    })

    .catch(err => console.error(err));
