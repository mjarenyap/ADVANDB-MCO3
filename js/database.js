
var mySql = require('mysql');

var connection = mySql.createConnection({
    host: "localhost",
    user: "root",
    password: "p@ssword",
    database: "wdi2"
});

connection.connect(function(error) {
    if (error)
        throw error;
    console.log("Connected!");
    
    var sql = "SELECT * FROM country";
    connection.query(sql, function(error, result, fields) {
        if (error)
            return error;
        console.log("Showing results: ");
        console.log(result);
    })
});