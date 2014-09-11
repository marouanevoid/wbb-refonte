var compressor = require('node-minify');
var fs = require('fs');
var pathTofileBase = "../../app/Resources/views/base.html.twig";
var cheerio = require('cheerio');

var stringFile = fs.readFileSync(pathTofileBase , 'utf-8');

//var  $ = cheerio.load(stringFile);
	var indexJs = stringFile.indexOf('{% javascripts');
	var indexEnd = stringFile.indexOf('{% endjavascripts %}');
	var parsedString = stringFile.substr(indexJs , indexEnd).split('%}');

	parsedString = parsedString[0].split(/\r\n|\r|\n/);

	console.log(parsedString);

// Array
new compressor.minify({
    type: 'gcc',
    fileIn: ['../WBB/CoreBundle/Resources/public/js/search.js'],
    fileOut: 'base-onefile-gcc.js',
    callback: function(err, min){
        console.log(err);
//        console.log(min);
    }
});
