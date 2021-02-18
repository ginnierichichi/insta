var WebSocketServer = require("websocket").server;
var http = require("http");
var htmlEntity = require("html-entities");
var PORT = 3280;

//list of current connected clients (users)
var clients = [];

//create http server
var server = http.createServer();

server.listen(PORT, function () {
    console.log("Server is listening on PORT " + PORT);
}) //takes 2 parameters

//create websocket server
wsServer = new WebSocketServer({
    httpServer: server
});

/**
 * The websocket server
 */
wsServer.on("request", function (request) {
    var connection = request.accept(null, request.origin);

    //pass each connection instance to each client.
    var index = client.push(connection) -1;
    console.log('Client', index, "connected");

    /**
     * This is where the sent message to all the connected clients.
     */
    connection.on("message", function(message) {
        console.log("message");
    })

    //detect if current connection is closed
    connection.on("close", function(connection) {
      clients.splice(index, 1);
      console.log("Client", index, "was disconnected");
    })
})
