const path = require('path');

module.exports = {
	// モード
	mode: 'development',
	// エントリーポイント
	entry: '/webroot/js/hello2.js',
	// 出力するファイル
	output: {
		filename: 'bundle.js',
		path: path.resolve(__dirname, 'webroot/dists')
	}
};
