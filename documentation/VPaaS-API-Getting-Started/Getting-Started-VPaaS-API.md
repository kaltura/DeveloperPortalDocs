---
layout: page
title: Get Started with Kaltura VPaaS
weight: 102
---

Building video experiences consists of ingesting media files, playing back videos, and reviewing usage and engagement analytics. In between, there is a world of nuances required for your unique use-case and application. Kaltura VPaaS is built on the principles of atomic services, SDKs, and tools that allow you full control and flexibility over every element and process in your media's lifecycle.


The guides on this site, together with the [Kaltura Developer Tools](https://developer.kaltura.com), enable you to get started building your own video experiences and workflows, and provide you with everything you need to further explore the platform's capabilities and to become an expert.  

To get started, let's review the foundational building blocks of a video experience. 

## Your Kaltura Account ID (PartnerId)  

Your Kaltura Partner ID, or PID, is a unique number that identifies your Kaltura account.  
Your PID is easily available at any time through the Kaltura Management Console (KMC), by simply clicking the [Account Settings tab](https://www.kaltura.com/index.php/kmc/kmc#account|overview).  

> Remember: You will need to pass the PID parameter every time you authenticate with the Kaltura API, or connect with integrated applications.

## Creating a Kaltura Session  

The Kaltura API is [stateless](https://en.wikipedia.org/wiki/Stateless_protocol), which means that every request made to the Kaltura API requires an authenticated session string to be passed along with your request. This is the Kaltura Session, which identifies the Kaltura account and user for which the executed API action is to be executed. The Kaltura Session can also specify various permissions and configurations, such as setting the role of the user dynamically, setting the time duration for the session, and more. 
> Remember: For every API call you make, you will need to provide a Kaltura Session. 

### Methods for Generating a Kaltura Session  

There are three methods for generating a Kaltura Session:

* Calling the [session.start action](https://developer.kaltura.com/api-docs/#/session.start): This method is recommended for scripts and applications to which you alone will have access.
* Calling the [user.loginByLoginId action](https://developer.kaltura.com/api-docs/#/user.loginByLoginId): This method is recommended for managing registered users in Kaltura, and allowing users to log in using email and password. When you log in to the KMC, the KMC application calls the user.loginByLoginId action to authenticate you using your registered email and password.
* Using the [appToken service](https://developer.kaltura.com/api-docs/#/appToken): This method is recommended when providing access to scripts or applications that are managed by others; this method provides tools to manage API tokens per application provider, revoke access to specific applications, and more.

> To learn more about the Kaltura Session, its algorithm, guidelines and options read the [Kaltura API Authentication and Security article](https://knowledge.kaltura.com/node/229).

## Uploading Your Media Files  

Media files are uploaded to Kaltura through [CORS-enabled](https://www.w3.org/wiki/CORS_Enabled) REST API.  
You can implement an upload flow by using a Kaltura tested JavaScript widget for web pages, or by implementing direct calls to the API.  
Alternatively, Kaltura also provides methods for bulk-ingest and import of content. To learn more, read the [Kaltura Bulk Content Ingestion API article](https://vpaas.kaltura.com/documentation/02_Media-Ingest-and-Preperation/Bulk-Content-Ingestion.html).

> Note: Kaltura manages all forms of media files, including video, image, and audio files. It even provides APIs to host, deliver and process document files, such as PDF and PPT files, to create rich experiences such as synchronized side-by-side video and presentation slides.

Which method you chose to implement depends on your application needs. The following are the two main methods for uploading files.

### Upload Files Using JavaScript with the jQuery Upload Widget  

If your application is HTML5 based, you can implement a reliable and fault-tolerant large-files upload with an automatic pause-and-resume functionality, by including the Kaltura Upload JavaScript widget. The [Kaltura Upload JavaScript widget](https://github.com/kaltura/chunked-file-upload-jquery) provides a simple JavaScript library that abstracts the use of the Kaltura API and handles the files locally (such as file chunking and pause-resume).

The [Kaltura Upload jQuery project](https://github.com/kaltura/chunked-file-upload-jquery) can be used as reference or basis to implement your own reliable chunked file upload to Kaltura.  
For a quick view of how this method works:

1. Download the project to your localhost, edit the index.php file, and switch the value of $the_user_ks_to_use to a valid Kaltura Session. 
2. Next, load the page from your localhost, open your browser console and try uploading a file. You'll see all the steps printed to the browser console.

### Upload Files by Calling the API Directly  

Uploading a file directly via the REST API requires knowledge of handling files in your preferred programming language. The [Kaltura Client Libraries](https://developer.kaltura.com/api-docs/#/Client%20Libraries) simplify constructing the REST API calls to Kaltura and provide a simple API for a simple file upload request. However, if you'd like to support chunked file upload and pause-resume in your application, you will need to handle the file-chunking according to your preferred programming language standards.

> If you're using Java, to achieve a chunked file upload in your Java application follow the information in [chunked uploads in the Java reference implementation](https://github.com/kaltura/Sample-Kaltura-Chunked-Upload-Java).

To learn how to use the file upload API, follow the recipe below:

{% onebox https://developer.kaltura.com/recipes/upload/embed#/start %}

## Working with Media Entries  

Uploading a file creates a [KalturaMediaEntry](https://developer.kaltura.com/api-docs/#/KalturaMediaEntry) object by calling the [media.add](https://developer.kaltura.com/api-docs/#/media.add) action. The uploaded file is then assigned to this media entry by calling the [media.addContent](https://developer.kaltura.com/api-docs/#/media.addContent) action.

Now that you have content in your account, you will want to implement a library search to create galleries or search for media discovery. The main service you will be working with is the [media service](https://developer.kaltura.com/api-docs/#/media).

### Searching Entries - media.list  

Note that you can combine several filter parameters together to further narrow down your search results. 

{% onebox https://developer.kaltura.com/recipes/video_search/embed#/start %}

### Retrieving Entry Details - media.get  

To retrieve the data of an object using its ID, call the object's `get` action. With media entries, call the [`media.get`](https://developer.kaltura.com/api-docs/#/media.get) action to retrieve the data of a specific entry.

### Updating Entry Details - media.update  

To update any object in Kaltura's VPaaS, use the `update` action. 
To update media entries, call the [`media.update`](https://developer.kaltura.com/api-docs/#/media.update) action by providing an instance of the `KalturaMediaEntry` object.   

Additionally, media entries in Kaltura have several related objects, including: 

* [captionAsset](https://developer.kaltura.com/api-docs/#/captionAsset) for caption files
* [thumbAsset](https://developer.kaltura.com/api-docs/#/thumbAsset) for editorial thumbnails
* [access control](https://developer.kaltura.com/api-docs/#/accessControl) profiles to set rules that allow or deny access to the media
* [custom metadata](https://developer.kaltura.com/recipes/metadata) profiles to enhance the base fields available in your account
* And more

We recommend reading these guides and reviewing the [Code Recipes](https://developer.kaltura.com/recipes/) to learn more about the many capabilities of Kaltura's VPaaS.

## Dynamic Thumbnails  

An important tool for dealing with video and building video experiences are thumbnails, images that represent your video file. Kaltura provides two methods for creating and handling thumbnails: 

* The [thumbAsset Service](https://developer.kaltura.com/api-docs/#/thumbAsset): Enables you to edit and manage editorial thumbnail assets that are associated with your video.
* The [Dynamic Thumbnail API](https://knowledge.kaltura.com/kaltura-thumbnail-api): Provides a simple API for creating thumbnails on-the-fly (in real-time) from the source media (the file originally uploaded).

The images are generated on-demand (with caching on disk and via CDN) by calling the following URL:  

{% highlight plaintext %}
http://www.kaltura.com/p/{partner_id}/thumbnail/entry_id/{entry_id}/param1/value1/param2/value2/...
{% endhighlight %}

The result of the thumbnail API is a JPEG image with one or more of the following features:  

* Re-sized, cropped and/or rotated version of the original
* Taking a specific frame from a the video, in real-time
* Controlling the compression quality of the created thumbnail image
* Preparation of Imahe Stripes for animating thumbnails via CSS
* And more.

> Read more about the [Dynamic Thumbnail API](knowledge.kaltura.com/kaltura-thumbnail-api) and explore the [Thumbnail Animation with CSS Stripes Code Recipe](https://developer.kaltura.com/recipes/dynamic_thumbnails).


## Embed and Customize Your Video Player  

The example below shows the most basic Player embed. Player embed is a JavaScript code that references your partnerId, entryId and the uiConfId - a Player widget instance ID. 

<div class="w-row">
<div class="w-col w-col-6">
  <div class="highlighter-rouge" style="padding-right: 10px;"><pre class="highlight" style="margin: 0;background: none;"><code><span class="c1">kWidget</span><span class="c1">.</span><span class="c1">embed</span><span class="c1">({</span>
    <span class="s1">'targetId'</span><span class="c1">:</span> <span class="s1">'playerDivId'</span><span class="c1">,</span>
    <span class="s1">'wid'</span><span class="c1">:</span> <span class="s1">'_811441'</span><span class="c1">,</span>
    <span class="s1">'uiconf_id'</span> <span class="c1">:</span> <span class="s1">34599271</span><span class="c1">,</span>
    <span class="s1">'entry_id'</span> <span class="c1">:</span> <span class="s1">'0_4kwzg46z'</span><span class="c1">,</span>
    <span class="s1">'flashvars'</span> <span class="c1">:</span> <span class="c1">{</span>
        <span class="nx">// Add dynamic configs such as page-specific or user-specific</span>
    <span class="c1">}</span>
<span class="c1">});</span>
</code></pre>
  </div>
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

The Kaltura Player is the building block that enables you to deliver video experiences to your users. The Player abstracts the complexities of delivery of video across devices, browsers and native applications, and provides a cross-platform UI framework, easy branding and customization features and even in-video quizzes, advertising integrations.   

The Player's robust plugins-framework also enables you to create your own unique experiences, while the uiConf service simplifies the management of many such Player instances and configurations.

The uiConfId is used to reference the Player instance you wish to render when embedding a video in your pages or application views.

### Creating and Managing Player Widgets - uiConf Service  

{% onebox https://developer.kaltura.com/recipes/player_uiconf/embed#/start %} 

### Getting Started with the Player Features  

* [Responsive Player embed](http://player.kaltura.com/docs/responsive).
* [JavaScript function for the Player embed method](http://player.kaltura.com/docs/kwidget).
* [JavaScript function thumbnail embed (clicking turns thumbnail to Player)](http://player.kaltura.com/docs/thumb).
* [JavaScript tag player embed](http://player.kaltura.com/docs/autoEmbed).
* [Enabling a robust web to native bridge](http://player.kaltura.com/docs/NativeCallout).

## Analyze Engagement Analytics  

Make decisions based on complete data - the Kaltura VPaaS usage and engagement analytics reports provide you with the insight you need to manage your content, reach your audience, and optimize your video workflow. View a quick snapshot of high-level figures, or drill down to user-specific or video-specific information. Use the analytics reports to gain business insights, and understand user trends. Already using an analytics or audience measurement tool? Leverage the Kaltura pre-integrated plugins for all major analytics providers and consolidate your data securely and reliably.

Integrated Analytics Partners - [See Configuring Analytics Plugins](https://knowledge.kaltura.com/universal-studio-information-guide#configuring_analytics): [Youbora](https://knowledge.kaltura.com/node/1675), [comScore](http://player.kaltura.com/docs/ComscoreAnalytics), [Nielsen](http://player.kaltura.com/docs/NielsenVideoCensus), [Chartbeat](http://support.chartbeat.com/docs/video.html#kaltura), [Google Analytics](https://knowledge.kaltura.com/node/1148#googleanalytics), and [Adobe Heartbeat](http://player.kaltura.com/modules/Heartbeat/tests/HeartBeatDemo.html).

Follow the Code Recipe below to get started with the Kaltura Analytics [report service](https://developer.kaltura.com/api-docs/#/report).

{% onebox https://developer.kaltura.com/recipes/analytics/embed %}

