---
layout: page
title: Get Started with the Kaltura VPaaS API
weight: 102
---

Building video experiences consists of ingesting media files, video playback and  reviewing usage and engagement analytics. In between there is a world of nuances that your unique use-case and app requires. Kaltura VPaaS is built on the principles of atomic services, SDKs and tools allowing you full control and flexibility over every element and process in the life cycle of your media.  
The guides on this site, and the [Kaltura Developer Tools](https://developer.kaltura.com), will enable you to get started quickly building your own video experiences and workflows and provide everything you need to explore the platform capabilities further and become an expert.  

To get started, let's review the foundational building blocks of a video experience. 

## Your Kaltura Account ID (partnerId)

Your Kaltura Partner ID, or PID, is a unique number identifying your Kaltura account.  
You can find your partnerId at any time by visiting the [Account Settings tab in the Kaltura Management Console](https://www.kaltura.com/index.php/kmc/kmc#account|overview).  
You will need to pass the pid paramemter everytime you authenticate with the Kaltura API, or connect with integrated apps.

## Creating a Kaltura Session

The Kaltura API is [stateless](https://en.wikipedia.org/wiki/Stateless_protocol), which means that every request made to the Kaltura API requires an authenticated session string to be passed along with your request. This is the Kaltura Session (aka KS), it identifies the Kaltura account and user for which the executed API action is to be executed. The KS can also specifiy various permissions and configurations such as dynamically setting the role of the user, time duration the session is good for and more. You are expected to provide a generated KS with every API call you will make. 

### There are three methods for generating a Kaltura Session:

* Calling the [session.start action](https://developer.kaltura.com/api-docs/#/session.start). This method is recommended for scripts and applications that only you will have access to.
* Calling [user.loginByLoginId action](https://developer.kaltura.com/api-docs/#/user.loginByLoginId). This method is recommended for managing registered users in Kaltura, and allowing users to login using email and password. When you login to the Kaltura Management Console, the KMC app calls the user.loginByLoginId action to authenticate you using your registered email and password.
* Using the [appToken service](https://developer.kaltura.com/api-docs/#/appToken). This method is recommended for when you are providing access to scripts or applications that are managed by others, and provides tools to manage API tokens per application provider, revoke access to specific applications, and more.

> To learn more about the Kaltura Session, its algorithm, guidelines and options read the [Kaltura's API Authentication and Security article](https://knowledge.kaltura.com/node/229).

## Uploading your Media Files

Media files are uploaded to Kaltura through [CORS enabled](https://www.w3.org/wiki/CORS_Enabled) REST API.  
You can implement an upload flow by using a Kaltura tested JavaScript widget for web pages, or by implementing direct calls to the API.  
Alternatively, Kaltura also provides methods for bulk-ingest and import of content. To learn more, read: [Kaltura Bulk Content Ingestion API](https://vpaas.kaltura.com/documentation/02_Media-Ingest-and-Preperation/Bulk-Content-Ingestion.html).

>  Side note: Kaltura manages all forms of media files including video, image, and audio files. It even provides APIs to host, deliver and process document files such as PDF and PPT files to create rich experiences such as synchronized side-by-side video and presentation slides.

Which method you chose to implement depends on your application needs.  
Below are the two main methods for uploading files:

### Upload Files Using JavaScript with the jQuery Upload Widget

If your application is HTML5 based, you can implement a reliable and fault tolerant large-files upload with an automatic pause-and-resume functionality by simply including and using the Kaltura Upload JavaScript widget.
The [Kaltura Upload JavaScript widget](https://github.com/kaltura/chunked-file-upload-jquery) provides a simple JavaScript library that abstracts the use of the Kaltura API, as well as handling of the files locally (such as file chunking and pause-resume).

The [Kaltura Upload jQuery project](https://github.com/kaltura/chunked-file-upload-jquery) can be used as reference or basis to implementing your own reliable chunked file upload to Kaltura.
To quickly see how it works, simply download the project to your localhost, edit index.php and switch the value of $the_user_ks_to_use to a valid Kaltura Session, then load the page from your localhost, open your browser console and try uploading a file. You'll see all the steps printed to the browser console.

### Upload Files by Calling the API Directly

Uploading a file directly via the REST API requires knowledege of handling files in your preferred programming language.  
The [Kaltura Client Libraries](https://developer.kaltura.com/api-docs/#/Client%20Libraries) simplify constructing the REST API calls to Kaltura and provides a simple API for a simple file upload request.  
However, if you'd like to support chunked file upload and pause-resume in your application, you will need to handle the file-chunking according to your preferred programming language standards.

> If you're using Java, follow the [Chunked Upload in Java reference implementation](https://github.com/kaltura/Sample-Kaltura-Chunked-Upload-Java) to achieve chunked file upload in your Java application.

Follow the recipe below to get acquinted with the file upload API:

{% onebox https://developer.kaltura.com/recipes/upload/embed#/start %}

## Working with Media Entries

After uploading your file, you will have created a [KalturaMediaEntry](https://developer.kaltura.com/api-docs/#/KalturaMediaEntry) object by calling the [media.add](https://developer.kaltura.com/api-docs/#/media.add) action, and then assigned the uploaded file to this media entry by calling the [media.addContent](https://developer.kaltura.com/api-docs/#/media.addContent) action.

Now that you have content in your account, you will want to implement a library search in order to create galleries or search for media discovery. The main service you will be working with is the [media service](https://developer.kaltura.com/api-docs/#/media).

### Searching Entries - media.list

Note that you can combine several filter parameters together to further narrow down your search results. 

{% onebox https://developer.kaltura.com/recipes/video_search/embed#/start %}

### Retriving Entry Details - media.get

In Kaltura retriving the data of an object by its id is done by calling its `get` action. With media entries, call the [`media.get`](https://developer.kaltura.com/api-docs/#/media.get) action to retrieve the data of a specific entry.

### Updating Entry Details - media.update

To update any object in Kaltura, use the `update` action. To update media entries, call the [`media.update`](https://developer.kaltura.com/api-docs/#/media.update) action providing an instance of the `KalturaMediaEntry` object.   

Additionally, media entries in Kaltura have several related objects including [captionAsset](https://developer.kaltura.com/api-docs/#/captionAsset) for caption files, [thumbAsset](https://developer.kaltura.com/api-docs/#/thumbAsset) for editorial thumbnails, [access control](https://developer.kaltura.com/api-docs/#/accessControl) profiles to set rules that allow or deny access to the media, [custom metadata](https://developer.kaltura.com/recipes/metadata) profiles to enhance the base fields available in your account, and much more.  
Keep browsing these guides and review the [Code Recipes](https://developer.kaltura.com/recipes/) to learn more about the many capabilities of Kaltura VPaaS.

## Dynamic Thumbnails

An important tool of dealing with video and building video experiences are thumbnails, images that represent your video file. Kaltura provides two methods for creating and handling thumbnails: 

1. The [thumbAsset Service](https://developer.kaltura.com/api-docs/#/thumbAsset) - provides editing, and managing editorial thumbnail assets that are associated with your video.
2. The [Dynamic Thumbnail API](https://knowledge.kaltura.com/kaltura-thumbnail-api) - provides a simple API for creating thumbnails on-the-fly (in real-time) from the source media (the file originally uploaded).

The images are generated upon demand (with caching on disk and via CDN) by calling the following URL -  
`http://www.kaltura.com/p/{partner_id}/thumbnail/entry_id/{entry_id}/param1/value1/param2/value2/...`  

The result of the thumbnail API is a JPEG image with one or more of the following features:  

* Re-sized, cropped and/or rotated version of the original.
* Taking a specific frame from a the video, in real-time.
* Controling the compression quality of the created thumbnail image. 
* Preperation of Imahe Stripes for animating thumbnails via CSS.
* And more.

Read more about the [Dynamic Thumbnail API](knowledge.kaltura.com/kaltura-thumbnail-api) and explore the [Thumbnail Animation with CSS Stripes Code Recipe](https://developer.kaltura.com/recipes/dynamic_thumbnails).


## Embed and Customize Your Video Player 

The below example shows the most basic player embed. Player embed is a JavaScript code that references your partnerId, entryId and the uiConfId - a player widget instance ID. The Kaltura Player is the building block by which you deliver video experiences to your users. It also collects viewer engagement analytics about who, when and how users interact with your video. 

<div class="w-row">
<div class="w-col w-col-3">
```
kWidget.embed({ 
  'targetId': 'kaltura_player', 
  'wid': '_811441', 
  'uiconf_id' : 34599271, 
  'entry_id' : '0_4kwzg46z', 
  'flashvars' : { 
    // Add dynamic configrations here such as page-specific or user-specific configs. 
  } 
});
```
</div>
<div class="w-col w-col-6">
  <div class="w-embed w-iframe w-script media-embed-div">
      <!-- Outer div defines maximum space the player can take -->
      <div style="width: 100%;display: inline-block;position: relative;">
        <!--  inner pusher div defines aspect ratio: in this case 16:9 ~ 56.25% -->
        <div id="dummy" style="margin-top: 56.25%;"></div>
        <!--  the player embed target, set to take up available absolute space   -->
        <script src="https://cdnapisec.kaltura.com/p/811441/sp/81144100/embedIframeJs/uiconf_id/35015842/partner_id/811441" style="margin: 0px 0px 0px 0px;"></script>
        <div id="kaltura_player_1461185766" style="position:absolute;top:0;left:0;left: 0;right: 0;bottom:0;border:none;"></div>
      </div>
      <script>
        kWidget.embed({
          "targetId": "kaltura_player_1461185766",
          "wid": "_811441",
          "uiconf_id": 35015842,
          "flashvars": {
            "streamerType": "auto"
          },
          "entry_id": "0_4kwzg46z"
        });
      </script>
  </div>
</div>
</div>

## Analyze Engagement Analytics
