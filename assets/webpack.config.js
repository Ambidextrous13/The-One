/**
 * Webpack configuration.
 */

const path                   = require( 'path' );
const MiniCssExtractPlugin   = require( 'mini-css-extract-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const TerserPlugin           = require("terser-webpack-plugin");

// JS Directory path.
const JS_DIR    = path.resolve( __dirname, 'src/js/load' );
const BUILD_DIR = path.resolve( __dirname, 'build' );

const entry = {
	admin:   JS_DIR + '/admin/',
	generic: JS_DIR + '/generic/',
    css:     JS_DIR + '/css/',
};

const output = {
	path:     BUILD_DIR,
	filename: 'js/[name].js'
};

/**
 * Note: argv.mode will return 'development' or 'production'.
 */
const plugins = ( argv ) => [
	new CleanWebpackPlugin( {
		cleanStaleWebpackAssets: ( argv.mode === 'production' ) // Automatically remove all unused webpack assets on rebuild, when set to true in production. ( https://www.npmjs.com/package/clean-webpack-plugin#options-and-defaults-optional )
	} ),

	new MiniCssExtractPlugin( {
		filename: 'css/[name].css'
	} ),
];

const rules = [
	{
		test: /\.js$/,
		include: [ JS_DIR ],
		exclude: /node_modules/,
		use: 'babel-loader'
	},
	{
		test: /\.css$/,
		exclude: /node_modules/,
		use: [
			MiniCssExtractPlugin.loader,
			'css-loader',
		],
	},
	// {
	// 	test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
	// 	use: {
	// 		loader: 'file-loader',
	// 		options: {
	// 			name: '[path][name].[ext]',
	// 			publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../'
	// 		}
	// 	}
	// },
];

/**
 * Since you may have to disambiguate in your webpack.config.js between development and production builds,
 * you can export a function from your webpack configuration instead of exporting an object
 *
 * @param {string} env environment ( See the environment options CLI documentation for syntax examples. https://webpack.js.org/api/cli/#environment-options )
 * @param argv options map ( This describes the options passed to webpack, with keys such as output-filename and optimize-minimize )
 * @return {{output: *, devtool: string, entry: *, optimization: {minimizer: [*, *]}, plugins: *, module: {rules: *}, externals: {jquery: string}}}
 *
 * @see https://webpack.js.org/configuration/configuration-types/#exporting-a-function
 */
module.exports = ( env, argv ) => ({

	entry: entry,
	output: output,
	devtool: 'source-map',

	module: {
		rules: rules,
	},

	optimization: {
        minimize: false,
		minimizer: [
            new TerserPlugin( {
                exclude: /node_modules/,
                test: /\.js(\?.*)?$/i,
                parallel: 5,

            } ),
		]
	},

	plugins: plugins( argv ),

	externals: {
		jquery: 'jQuery'
	}
});