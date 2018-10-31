//1 Create an Upload Token
let uploadToken = new kaltura.objects.UploadToken();

kaltura.services.uploadToken.add(uploadToken)
.execute(client)
.then(token => {
    console.log(token);
});


// 2 Upload the file data
let uploadToken = new kaltura.objects.UploadToken();

kaltura.services.uploadToken.add(uploadToken)
.execute(client)
.then(token => {
    let uploadTokenId = token.id;
	let fileData = '/path/to/file';
	let resume = false;
	let finalChunk = true;
	let resumeAt = -1;

	kaltura.services.uploadToken.upload(uploadTokenId, fileData, resume, finalChunk, resumeAt)
	.execute(client)
	.then(result => {
	    console.log(result);
	});
});

// 3 Create the Kaltura Media Entry 

let uploadToken = new kaltura.objects.UploadToken();

kaltura.services.uploadToken.add(uploadToken)
.execute(client)
.then(token => {
    let uploadTokenId = token.id;
	let fileData = '/path/to/file';
	let resume = false;
	let finalChunk = true;
	let resumeAt = -1;

	kaltura.services.uploadToken.upload(uploadTokenId, fileData, resume, finalChunk, resumeAt)
	.execute(client)
	.then(result => {
	    let mediaEntry = new kaltura.objects.MediaEntry();
		mediaEntry.name = "Kaltura Logo";
		mediaEntry.description = "sample video of kaltura logo";
		mediaEntry.mediaType = kaltura.enums.MediaType.VIDEO;

		kaltura.services.media.add(mediaEntry)
		.execute(client)
		.then(entry => {
		    console.log(entry);
		});
	});
});


// 4 Attach the Video

let uploadToken = new kaltura.objects.UploadToken();

kaltura.services.uploadToken.add(uploadToken)
.execute(client)
.then(token => {
    let uploadTokenId = token.id;
	let fileData = '/path/to/file';
	let resume = false;
	let finalChunk = true;
	let resumeAt = -1;

	kaltura.services.uploadToken.upload(uploadTokenId, fileData, resume, finalChunk, resumeAt)
	.execute(client)
	.then(result => {
	    let mediaEntry = new kaltura.objects.MediaEntry();
		mediaEntry.name = "Kaltura Logo";
		mediaEntry.description = "sample video of kaltura logo";
		mediaEntry.mediaType = kaltura.enums.MediaType.VIDEO;

		kaltura.services.media.add(mediaEntry)
		.execute(client)
		.then(entry => {
		    let entryId = entry.id
			let resource = new kaltura.objects.UploadedFileTokenResource();
			resource.token = uploadTokenId;

			kaltura.services.media.addContent(entryId, resource)
			.execute(client)
			.then(result => {
			    console.log(result);
			});
		});
	});
});

