const express = require('express');
const bodyParser = require('body-parser');

const app = express();

// middleware
app.use(bodyParser.json());

// Dummy Route To return something on LocalHost:9000
app.get("/",function(req,res){    
    res.send("home");
});

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