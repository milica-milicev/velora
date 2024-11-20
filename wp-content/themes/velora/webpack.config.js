const path = require('path');

module.exports = {
	mode: 'development', // or 'production'
	entry: './assets/js/site.js', // specify the entry point for your application
	output: {
		filename: 'site.min.js', // specify the name of the output file
		path: path.resolve(__dirname, 'dist/js') // specify the output directory for the bundled file
	},
	module: {
		rules: [
			{
				test: /\.js$/, // specify the files to be transpiled by Babel
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env']
					}
				}
			}
		]
  	}
};