---
layout: page
title: Create a New Kaltura Entry and Upload Video File using the Kaltura API
---
 

This article takes the user through the basic flow of uploading media using Kaltura's upload API.

To upload a video file using the C# API Client Library, follow the steps below.


1.  Handshake to create a Kaltura Session:  
    <pre class="brush: csharp;fontsize: 100; first-line: 1; ">KalturaConfiguration config = new KalturaConfiguration(PARTNER_ID);
config.ServiceUrl = SERVICE_URL;
KalturaClient client = new KalturaClient(config);
client.KS = client.GenerateSession(ADMIN_SECRET, USER_ID, KalturaSessionType.ADMIN, PARTNER_ID, 86400, "");</pre>

2.  Create a new Media Entry to which we'll attach the uploaded file:  
    <pre class="brush: csharp;fontsize: 100; first-line: 1; ">KalturaMediaEntry mediaEntry = new KalturaMediaEntry();
mediaEntry.Name = "Media Entry Using C#";
mediaEntry.MediaType = KalturaMediaType.VIDEO;
mediaEntry = client.MediaService.Add(mediaEntry);</pre>

3.  Upload the media file:  
    <pre class="brush: csharp;fontsize: 100; first-line: 1; ">FileStream fileStream = new FileStream("DemoVideo.flv", FileMode.Open, FileAccess.Read);
KalturaUploadToken uploadToken = client.UploadTokenService.Add();
client.UploadTokenService.Upload(uploadToken.Id, fileStream);</pre>

4.  Attach the Media Entry to the file:  
    <pre class="brush: csharp;fontsize: 100; first-line: 1; ">KalturaUploadedFileTokenResource mediaResource = new KalturaUploadedFileTokenResource();
mediaResource.Token = uploadToken.Id;
mediaEntry = client.MediaService.AddContent(mediaEntry.Id, mediaResource);</pre> 

## Chunked Video Upload or Upload Pause and Resume Flow</

The Kaltura API supports an upload pause and resume via chunked upload workflow. Additionally, Kaltura also provide a [jQuery plugin](https://github.com/kaltura/jQuery-File-Upload) that simplifies the process.

An example showing how to use the jquery plugin can be seen in this [recipe](https://developer.kaltura.org/recipes/upload).

However, if you are unable to use the jQuery plugin above, you can implement it yourself by chunking the file and calling the uploadToken service. 

To use the uploadToken service for chunked upload, set the following parameters in the upload action:

* Resume - should be set to true.
* resumeAt – the byte offset to add current chunk to.</span>
* finalChunk - should be set to 0 for all chunks, and set to 1 for the last chunk.

For a reference example, refer to [this implementation of the function performing Kaltura chunked upload in the Android API](https://github.com/kaltura/AndroidReferenceApp/blob/master/DemoApplication/src/com/kaltura/services/UploadToken.java#L88).
