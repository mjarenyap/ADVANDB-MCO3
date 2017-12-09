/*
var http = require('http');
http.createServer(function(request, response) {
    response.writeHead(200, {'Content-Type': 'text/html'});
    response.end('Hello World!');
}).listen(8080);
*/

var http = require('http');
var fs = require('fs');
var path = require('path');
var connect = require('connect');
var express = require('express');

var models_country = require('./models/country');
var models_series = require('./models/series');
var models_dataByYear = require('./models/dataByYear');

//initialize the page by fetching important files
function initializePage(request, response){
    var filePath = '.' + request.url;
    if (filePath == './')
        filePath = './index.html';

    var extname = path.extname(filePath);
    var contentType = 'text/html';
    
    /* validating the exetension names of the following files */
    switch (extname) {
        case '.js':
            contentType = 'text/javascript';
            break;
        case '.css':
            contentType = 'text/css';
            break;
        case '.json':
            contentType = 'application/json';
            break;
        case '.png':
            contentType = 'image/png';
            break;      
        case '.jpg':
            contentType = 'image/jpg';
            break;
            
        case '.svg':
            contentType = 'image/svg+xml';
            break;
            
        case '.wav':
            contentType = 'audio/wav';
            break;
    }

    /* reads all necessary files */
    fs.readFile(filePath, function(error, content) {
        /* if the current file does not exist */
        if (error) {
            if(error.code == 'ENOENT'){
                fs.readFile('./404.html', function(error, content) {
                    response.writeHead(200, { 'Content-Type': contentType });
                    response.end(content, 'utf-8');
                });
            }
            else {
                response.writeHead(500);
                response.end('Sorry, check with the site admin for error: '+error.code+' ..\n');
                response.end(); 
            }
        }
        
        /* if the current file has been successfully read and exists */
        else {
            response.writeHead(200, { 'Content-Type': contentType });
            response.end(content, 'utf-8');
        }
    });
}

var app = connect();
app.use('/', initializePage);

/* creating the server */
http.createServer(app).listen(3000);

console.log("Alright! Server has started in http://localhost:3000");