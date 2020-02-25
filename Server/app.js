const express = require('express');
const request = require('request');
const session = require('client-sessions');
const bodyParser = require('body-parser');
const cors = require('cors');
const formidableMiddleware = require('express-formidable');
const mongoose = require('mongoose');

const app = express();

// Db Connection
mongoose.connect('mongodb://localhost:27017/', {useNewUrlParser: true, useUnifiedTopology: true})
        .catch(err => console.log(err.message));

const db = mongoose.connection;
db.once('open', () => console.log('connected to the database'));

// Routes

// middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));
app.use(cors());

// Dummy Route To return something on LocalHost:9000
app.get("/",function(req,res){    
    res.send("home");
});

app.use(session({
    cookieName: 'session',
    secret: 'Charlotte',
    duration: 30 * 60 * 100,
    activeDuration: 5 * 60 * 1000,
    ephemeral: true
}));

// Respond with error message on error
app.use(function(err, req, res, next) {
    res.status(err.status || 500);
    res.render('error', {
        message : err.message,
        error : {}
    });
});



// Set Port Number and run server with yarn run start nodemon will
let port = 9000;
app.listen(port, function () {
 console.log(`Server is up and running on port ${port}`);
});


module.exports = app;