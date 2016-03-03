/**
 * Created by rhoeh on 2/25/2016.
 */
var express = require('express');
var bodyParser = require('body-parser');
var app = express();

// parse application/json
app.use(bodyParser.json());

// Add headers
app.use(function (req, res, next) {

    // Website you wish to allow to connect
    //res.setHeader('Access-Control-Allow-Origin', 'http://local.roho.in'); // for use on local wamp
    res.setHeader('Access-Control-Allow-Origin', 'http://roho.in'); // for use on roho.in

    // Request methods you wish to allow
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

    // Request headers you wish to allow
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');

    // Set to true if you need the website to include cookies in the requests sent
    // to the API (e.g. in case you use sessions)
    res.setHeader('Access-Control-Allow-Credentials', true);

    // Pass to next layer of middleware
    next();
});

// START ROHO Builds

// This responds with a replacement src for a models' image from the model object.
app.post('/rest/model-image-replace', function (req, res, next) {
    console.log("Got a POST request for a model image");
    var obj = req.body;
    console.log(obj.name);
    var src = obj.name.replace(/[^a-zA-Z0-9]/g, "");
    res.send(src);
    next();
});

// START examples
// This responds with "Hello World" on the homepage
app.get('/', function (req, res) {
    console.log("Got a GET request for the homepage");
    res.send('Hello, you found my Node');
});

// This responds a POST request for the homepage
app.post('/army_post', function (req, res) {
    console.log("Got a POST request for the /army_post page");
    res.send('found a thing, cant read it');
});

// This responds a POST request for the homepage
app.get('/army_builder', function (req, res) {
    console.log("Got a GET request for the /army_builder page");
    console.log(req.query);
    res.end(JSON.stringify(req.query));
    //console.log(req);
    //res.send(req.armyBuilder);
});

// This responds a DELETE request for the /del_user page.
app.delete('/del_user', function (req, res) {
    console.log("Got a DELETE request for /del_user");
    res.send('Hello DELETE');
});

// This responds a GET request for the /list_user page.
app.get('/list_user', function (req, res) {
    console.log("Got a GET request for /list_user");
    res.send('Page Listing');
});

// This responds a GET request for abcd, abxcd, ab123cd, and so on
app.get('/ab*cd', function(req, res) {
    console.log("Got a GET request for /ab*cd");
    res.send('Page Pattern Match');
});

var server = app.listen(8081, function () {

    var host = server.address().address;
    var port = server.address().port;

    console.log("Example app listening at http://%s:%s", host, port)

});