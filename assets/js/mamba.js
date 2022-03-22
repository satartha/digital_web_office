function do_data_list(data){
	const key = CryptoJS.lib.WordArray.random(32);
	const iv =  CryptoJS.lib.WordArray.random(16);
	const encrypted = CryptoJS.AES.encrypt(data, key, {
		iv:iv
	});
	const encryptedText = encrypted.ciphertext.toString(CryptoJS.enc.Base64);
	const postKey=key.toString(CryptoJS.enc.Base64);
	const postIv=iv.toString(CryptoJS.enc.Base64);
	const postData=postKey+":"+encryptedText+":"+postIv;
	return postData;
}