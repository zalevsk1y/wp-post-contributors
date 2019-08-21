
var webpack = require('webpack');
const TerserJSPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const path = require("path");
module.exports = {

	entry:{
		 'contributor-script':'./src/index.js',

		},	
	output: {
		path: __dirname,
		filename: '../public/js/[name].js',

	},
	module: {
		rules: [

			{
				test: /\.css$/,
				use: [
				  MiniCssExtractPlugin.loader,
				  "css-loader"
				]
			  },
			
		]
	},
	optimization:{
		minimizer: [
			new TerserJSPlugin({}),
			new OptimizeCSSAssetsPlugin({})
		  ]

	},
	externals:{

		'globals':'window',

	},
	
	plugins: [
		
		new MiniCssExtractPlugin({
			filename: "../public/css/plugin-custom-styles.css",
			
		})
		  
	] 
};

