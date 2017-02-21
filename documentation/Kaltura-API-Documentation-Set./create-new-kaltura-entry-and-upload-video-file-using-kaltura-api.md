---
layout: page
title: Create A New Kaltura Entry And Upload Video File Using The Kaltura API
---
 

This short article takes the user through the basic flow of uploading media using Kaltura's upload API.

 

<span class="mce-procedure">To upload a video file using the C# API Client Library, follow the steps below.</span>

1.  ****Handshake to create a Kaltura Session:  
    ****<pre class="brush: csharp;fontsize: 100; first-line: 1; ">KalturaConfiguration config = new KalturaConfiguration(PARTNER_ID);
config.ServiceUrl = SERVICE_URL;
KalturaClient client = new KalturaClient(config);
client.KS = client.GenerateSession(ADMIN_SECRET, USER_ID, KalturaSessionType.ADMIN, PARTNER_ID, 86400, "");</pre>

2.  ****Create a new Media Entry to which we'll attach the uploaded file:  
    ****<pre class="brush: csharp;fontsize: 100; first-line: 1; ">KalturaMediaEntry mediaEntry = new KalturaMediaEntry();
mediaEntry.Name = "Media Entry Using C#";
mediaEntry.MediaType = KalturaMediaType.VIDEO;
mediaEntry = client.MediaService.Add(mediaEntry);</pre>

3.  ****Upload the media File:  
    ****<pre class="brush: csharp;fontsize: 100; first-line: 1; ">FileStream fileStream = new FileStream("DemoVideo.flv", FileMode.Open, FileAccess.Read);
KalturaUploadToken uploadToken = client.UploadTokenService.Add();
client.UploadTokenService.Upload(uploadToken.Id, fileStream);</pre>

4.  ****Attach the Media Entry to the File:  
    ****<pre class="brush: csharp;fontsize: 100; first-line: 1; ">KalturaUploadedFileTokenResource mediaResource = new KalturaUploadedFileTokenResource();
mediaResource.Token = uploadToken.Id;
mediaEntry = client.MediaService.AddContent(mediaEntry.Id, mediaResource);</pre> 

<p class="p1 mce-heading-2">
  <span class="s1"><a name="chunked-upload"></a></span>
</p>

<p class="p1 mce-heading-2">
  <span class="s1">Chunked Video Upload or Upload Pause and Resume Flow</span>
</p>

<p class="p1">
  <span class="s1"> </span>
</p>

<p class="p1">
  <span class="s1">The Kaltura API supports an upload pause and resume via chunked upload workflow.</span>
</p>

<p class="p1">
  <span class="s1">Additionally, Kaltura also provide a jQuery plugin that simplifies the process: <a href="https://github.com/kaltura/jQuery-File-Upload"><span class="s2">https://github.com/kaltura/jQuery-File-Upload</span></a></span>
</p>

<p class="p1">
  <span class="s1">An example showing how to use the jquery plugin can be seen at: <a href="https://developer.kaltura.org/recipes/upload"><span class="s2">https://developer.kaltura.org/recipes/upload</span></a></span>
</p>

<p class="p2">
   
</p>

<p class="p1">
  <span class="s1">If you can’t use the jQuery plugin above, you can implement it yourself by chunking the file and calling the uploadToken service. </span>
</p>

<p class="p1">
  <span class="s1">To use the uploadToken service for chunked upload, set the following parameters in the upload action:</span>
</p>

<ol class="ol1">
  <li class="li1">
    <span class="s1">resume - should be set to true.</span>
  </li>
  <li class="li1">
    <span class="s1">resumeAt – the byte offset to add current chunk to.</span>
  </li>
  <li class="li1">
    <span class="s1">finalChunk - should be set to 0 for all chunks, and set to 1 for the last chunk.</span>
  </li>
</ol>

<span class="s1">For reference example, see <a href="https://github.com/kaltura/AndroidReferenceApp/blob/master/DemoApplication/src/com/kaltura/services/UploadToken.java#L88" target="_blank">this implementation of function performing Kaltura chunked upload in Android App</a>.</span>
