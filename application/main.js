'use strict'

exports.handler = function(event, context, callback) {

  var NameGenerator = require('./name_generator');

  // Create default pessimistic output.
  var response = {
    statusCode: 404,
    headers: {
      'Content-Type': 'application/json; charset=utf-8'
    },
    body: JSON.stringify(["Not Found"])
  };

  let path = event.pathParameters.proxy.split("/");

  // Validate the path.
  if (typeof path[0] !== "undefined" && typeof path[1] !== "undefined") {
    let name_type = path[0];
    let gender = path[1];
  
    var names = NameGenerator.generateSimple(name_type, gender, path[2]);
  
    // If names exist - return a 200 and JSON.
    if (names.length > 0) {
      response.statusCode = 200;
      response.body = JSON.stringify(names);
    }
  }

  callback(null, response)
}
