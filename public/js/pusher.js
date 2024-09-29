Pusher.logToConsole = true;

var Pusher = new Pusher ('...', {
      cluster: 'us2'
    });

var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });