const path = require('path');

module.exports = {
	// ���[�h
	mode: 'development',
	// �G���g���[�|�C���g
	entry: '/webroot/js/hello2.js',
	// �o�͂���t�@�C��
	output: {
		filename: 'bundle.js',
		path: path.resolve(__dirname, 'webroot/dists')
	}
};
