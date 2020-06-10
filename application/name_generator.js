/**
 * Name Generator
 */
exports.generateSimple = function(name_type, gender, amount = 5) {

  var fs = require('fs');
  let names = [];
  let names_array = [];

  if (amount > 20) {
    amount = 20;
  }

  try {
    let names_array_json = fs.readFileSync(`${__dirname}/library/${name_type}.json`);
    names_array = JSON.parse(names_array_json);
  
    for (let i = 1; i <= amount; i++) {
      let idx_name = Math.floor(Math.random() * names_array[gender].length);
      let surname_array = names_array["surname"];
      if (typeof names_array[`${gender}_surname`] !== "undefined") {
        surname_array = names_array[`${gender}_surname`];
      }

      let idx_surname = Math.floor(Math.random() * surname_array.length);
      let name = `${names_array[gender][idx_name]} ${surname_array[idx_surname]}`;
      names.push(name);
    }
    
  } catch (e) {
    console.log(e);
  }
  finally {
    return names;
  }
}
