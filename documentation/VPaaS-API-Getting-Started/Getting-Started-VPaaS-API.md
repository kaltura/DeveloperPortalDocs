---
layout: page
title: Get Started with Kaltura VPaaS
weight: 101
---

Building video experiences consists of ingesting media files, playing back videos, and reviewing usage and engagement analytics. In between, there is a world of nuances required for your unique use-case and application. Kaltura VPaaS is built on the principles of atomic services, SDKs, and tools that allow you full control and flexibility over every element and process in your media's lifecycle.

The guides on this site, together with the [Kaltura Developer Tools](https://developer.kaltura.com), enable you to get started building your own video experiences and workflows, and provide you with everything you need to further explore the platform's capabilities and to become an expert.  

To get started, let's review the foundational building blocks of a video experience. 

## Before You Begin  

To access the Kaltura API, you'll need the following:

* A Kaltura publisher account - To obtain a Kaltura account, start a [free trail](http://corp.kaltura.com/free-trial), [contact us](http://corp.kaltura.com/company/contact-us), or [download Kaltura CE](http://www.kaltura.org/project/community_edition_video_platform).
* Your Kaltura API publisher credentials, which are available through the [KMC Integration Settings](http://www.kaltura.com/index.php/kmc/kmc4#account/integration).

## Your Kaltura Account ID (PartnerId)  

Your Kaltura Partner ID, or PID, is a unique number that identifies your Kaltura account. Your PID is easily available at any time through the Kaltura Management Console (KMC), by simply clicking the [Account Settings tab](https://www.kaltura.com/index.php/kmc/kmc#account/overview).  

> Remember: You'll need to pass the PID parameter every time you authenticate with the Kaltura API, or connect with integrated applications.

## Creating a Kaltura Session  

The Kaltura API is [stateless](https://en.wikipedia.org/wiki/Stateless_protocol), which means that every request made to the Kaltura API requires an authenticated session string to be passed along with your request. This is the Kaltura Session, which identifies the Kaltura account and user for which the executed API action is to be executed. The Kaltura Session can also specify various permissions and configurations, such as setting the role of the user dynamically, setting the time duration for the session, and more. 

> Remember: For every API call you make, you will need to provide a Kaltura Session. 

To learn more about creating a Kaltura Session, see [How to Create a Kaltura Session](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/how-to-create-kaltura-session.html).

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

1. Download the project to your localhost, edit the index.php file, and switch the value of `$the_user_ks_to_use` to a valid Kaltura Session. 
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


## Kaltura API Documentation  

This section details the Kaltura API documentation that is available to developers working with Kaltura's APIs.



| Guide                                                  | Summary                                                                                                                                                                                                                                                                                                                                                                                                 |
|--------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| [Interactive Code Recipes and Examples](https://developers.kaltura.org)                  | Kaltura provides APIs for every core feature. You can use the Kaltura API to incorporate Kaltura features in web applications and web sites.                                                                                                                                                                                                                                                            |
| [Kaltura Knowledge Center Glossary](http://knowledge.kaltura.com/glossary)                     | As a reference for understanding technical terms related to Online Video, Media Asset Management and Kaltura.                                                                                                                                                                                                                                                                                          |
| [Kaltura's API Authentication and Security](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/Kaltura_API_Authentication_and_Security.html)              | Protecting personal user data, video streaming and limiting access to features are at the heart of the Kaltura Media Asset Management Platform. This guide will take you through the basic concepts and practices of authentication and security in the Kaltura API v3.                                                                                                                                 |
| The Kaltura Media Access Control Model                 | An Access Control Profile defines authorized and restricted domains where your content can or cannot be displayed, countries from which it can or cannot be viewed, white and black lists of IP addresses and authorized and unauthorized domains and devices in which your media can be embedded.                                                                                                      |
| [Introduction to Kaltura Client Libraries](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/introduction-kaltura-client-libraries.hmtl)               | Kaltura client libraries are SDKs in numerous programming languages that provide easy access to the Kaltura API and facilitate developing Kaltura applications.                                                                                                                                                                                                                                         |
|                                                        |                                                                                                                                                                                                                                                                                                                                                                                                         |
| [The Kaltura Thumbnail API](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/examples/kaltura-thumbnail-api.html)                              | The Thumbnail API provides an easy interface to dynamically manipulate images or video snapshots to be used as thumbnails. Using the thumbnail API it is possible to resize, cropped versions of the original Kaltura video thumbnail, a specific frame from in the video and manipulate the thumbnail image and various ways.                                                                          |
| [How To Create a Video Thumbnail Rotator in JavaScript](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/how-create-video-thumbnail-rotator-javascrip.html)  | Case Study of using Kaltura's Thumbnail API to create a rotating video thumbnail.                                                                                                                                                                                                                                                                                                                       |
| [How To Handle Kaltura Server Notifications in PHP](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/examples/how-handle-kaltura-server-notifications-in-php.html)      | Often applications require the ability to respond to asynchronous events that occurred on the Kaltura server. For example, when a Media Entry was uploaded, finished transcoding or any other status update.                                                                                                                                                                                            |
| [Introduction to Kaltura's Cross-Platform Media Players](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/introduction-kalturas-cross-platform-media-players.html) | Kaltura's flexible HTML5 and Adobe OSMF (Flash)-based media players provide media online publishing solutions that are easy to use and embed.                                                                                                                                                                                                                                                           |
| [JavaScript API for Kaltura Media Players](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/javascript-api-kaltura-media-players.html)                | Kaltura's powerful media player JavaScript API enables you to design flexible, multifaceted interaction with the player.                                                                                                                                                                                                                                                                                |
| [Kaltura Exchange](http://exchange.kaltura.com/)                        | If you use a CMS such as Drupal or WordPress, or an LMS such as Moodle, Sakai or Blackboard, make sure to check the Kaltura Exchange for a Kaltura integration to your CMS of choice. |
                                                                                                                                   
## Common API Related Tasks  

* [Create A New Kaltura Entry And Upload Video File Using The Kaltura API](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/examples/create-new-kaltura-entry-and-upload-video-file-using-kaltura-api.html)
* [Getting Started with the Kaltura API - Blog post and Webinar](http://blog.kaltura.org/kaltura-api-how-to-get-started-video)
* [How to retrieve the download or streaming URL using API calls?]https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/examples/how-retrieve-download-or-streaming-url-using-api-calls.html)
* [How to retrieve a media entry details and metadata?](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/examples/how-retrieve-metadata-media-entry-using-api.html)
* [How the Search in Kaltura Works (How to perform AND, OR, NOT and Exact Match searches in API)](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/examples/how-search-kaltura-works-how-perform-and-or-not-and-exact-match-searches-api.html).               


## Kaltura API Usage Guidelines  

### Document Conventions  

A string in brackets [] represents a value. Replace the string – including the brackets – with an actual value.  For example: replace *[SERVICENAME]* with *syndicationFeed*.

### Finding the Latest API Version Number  

To find the version number of the API that contains the latest updates, go to the full XML description of the API schema: [http://www.kaltura.com/api\_v3/api\_schema.php](http://www.kaltura.com/api_v3/api_schema.php).

The version and date of the API schema appear near the beginning of the file.

### Getting a Client Library for the Kaltura API  

To work with the Kaltura API, you need code that can:

*   Construct a Kaltura request.
*   Perform an HTTP request.
*   Parse the result of a Kaltura request.

To save you time, Kaltura provides client libraries. A client library is a set of classes that includes:

*   The functional infrastructure for communication with the Kaltura API: constructing a request, performing an HTTP request, and parsing a response
*   A full object representation of all the entities that are available through the Kaltura API, including enumeration objects
*   Infrastructure for developers, such as built-in log capabilities

The Kaltura API SDK includes client library packages in different languages, including PHP, Java, C#, and JavaScript. For the latest version of all client libraries, refer to [Kaltura API SDK - Native Client Libraries](https://developer.kaltura.com/api-docs/#/Client%20Libraries).

To get the entire API in your IDE, just download the client library for the language that you use to develop your applications and include the client library in your application or project.


### Getting a Client Library for a Language that Kaltura Does Not Provide  

The Kaltura client libraries are generated automatically based on API schema. Kaltura also strives to include contributions from the community and customers, and we welcome contributions of client libraries for languages that Kaltura does not yet provide.

You can write a custom generator class in PHP that generates code in the language of your choice.

If you provide the generator class to Kaltura, Kaltura will include your generator class in the Kaltura core generator. The new client library will be automatically generated and will be publicly available.

For more information on creating a client library generator, refer to [Adding New Kaltura API Client Library Generator](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/introduction-kaltura-client-libraries.html).


### API Authentication and Kaltura Sessions  

Most Kaltura API calls require you to authenticate before executing a call. Calls that require authentication usually have a response that cannot be shared between different accounts. For the Kaltura server to know that you are allowed to “ask that question,” you must authenticate before executing the call.

To learn more about the Kaltura Session and API Authentication, read: [Kaltura's API Authentication and Security](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/Kaltura_API_Authentication_and_Security.html).


| Error Code                         | Error Message                                                                                                       |   |
|------------------------------------|---------------------------------------------------------------------------------------------------------------------|---|
| INTERNAL_SERVERL_ERROR             | Internal server error occurred                                                                                      |   |
| MISSING_KS                         | Missing KS, session not established                                                                                 |   |
| INVALID_KS                         | Invalid KS "%KS%", Error "%KS_ERROR_CODE%,%KS_ERROR_DESCRIPTION%"                                                   |   |
| SERVICE_NOT_SPECIFIED              | Service name was not specified, please specify one                                                                  |   |
| SERVICE_DOES_NOT_EXISTS            | Service "%SERVICE_NAME%" does not exist                                                                             |   |
| ACTION_NOT_SPECIFIED               | Action name was not specified, please specify one                                                                   |   |
| ACTION_DOES_NOT_EXISTS             | Action "%ACTION_NAME%" does not exist for service "%SERVICE_NAME%"                                                  |   |
| MISSING_MANDATORY_PARAMETER        | Missing parameter "%PARAMETER_NAME%"                                                                                |   |

### Kaltura API Response/Request Format  

#### Request Structure  

The Kaltura API implements a standard HTTP POST/GET URL encoded request structure. URL-encoded requests are targeted to a specific API method.

Each API method location is concatenated from:

*   Base URI
*   Service identifier string
*   Action identifier string

The format of the API method location is:https://developer.kaltura.com/api-docs/#/[SERVICENAME].[ACTIONNAME], where

*   [SERVICENAME] represents a specific service
*   [ACTIONNAME] represent an action to be applied in the specific service

#### Request URL Example  

Post a request to activate the *list* action of the *media* service to the following URL: https://developer.kaltura.com/api-docs/#/media.list.

#### Request Input Parameters  

Each API method receives a different set of input parameters.

For all request types:

*   Send input parameters as a standard URL-encoded key-value string.
*   When an input parameter is an object, flatten it to pairs of ObjectName:Param keys.

#### Request Input Parameters Example  

{% highlight c %}
<pre class="brush: plain;fontsize: 100; first-line: 1; ">id=abc12&name=name%20with%20spaces&entry:tag=mytag&entry:description=mydesc</pre>
{% endhighlight %}

In the example, the following parameters are URL encoded and are passed as API input parameters:

{% highlight c %}
<pre class="brush: plain;fontsize: 100; first-line: 1; ">id = ‘abc’
name = ‘name with spaces’
entry {
	tag = ‘mytag’,
	description = ‘mydesc’	
}</pre>
{% endhighlight %}

### API Errors and Error Handling  

The Kaltura API can return errors, which are represented by an error identifier followed by a description:

*   An error ID is a unique string. The parts of the string are separated by underscores.
*   An error description is textual. The description may include a dynamic value.

A comma separates the error ID from the description.

#### API Error Example  

{% highlight c %}
<pre class="brush: plain;fontsize: 100; first-line: 1; ">ENTRY_ID_NOT_FOUND,Entry id "%s" not found </pre>
{% endhighlight %}

where *%s* is replaced with the value that is sent to the API call.

In the response XML:

*   The *<code>* node contains the error code (such as *ENTRY\_ID\_NOT_FOUND*).
*   The *<message>* node contains the description (such as *Entry id “%s” not found*).


#### ErrorResponse  

**Error Handling**

In most client libraries, the client library code throws an exception when an error is returned from the API. Depending on the programming language, catching the exception to read the code and/or the message enables user-friendly error handling. Errors that you encounter during development usually are caused by incorrect implementation.

### The Multirequest API  

#### Understanding the Multi-Request Feature  

The Kaltura API can execute several API calls in a single HTTP request to Kaltura. The multi-request feature improves performance in Kaltura integrations. The feature enables a developer to stack multiple API calls and issue them in a single request. This reduces the number of round-trips from server-side or client-side developer code to Kaltura.

The Kaltura API processes each of the API calls that are included in the single HTTP request. The response essentially is a list of the results for each of the calls in the request. The multi-request feature includes the ability to have one request depend on the result of another request.

While the Kaltura API is processing each of the API calls in a multi-request, it detects when there is a dependency in one of the call parameters. The Kaltura API parses the dependency and replaces it with the result of the relevant call.

#### Using the Multi-Request Feature  

##### Multi-Request with Dependency - Sample Use Case

To create a new entry out of a file in your server, execute several different API calls:

1.  uploadToken.add
2.  uploadToken.upload
3.  baseEntry.addFromUploadedFile

The result of *uploadToken.add* is an *uploadToken* object that consists of a token string.

You'll need the token string when executing the next action – uploading the file, therefore, you must complete the first action to call the second one.

Using the multi-request feature, in the second request you specify obtaining the value of the token parameter from the token property that is the result of the first request.

### Multi-Request Structure  

To perform a multi-request call:

1.  Define the *GET* parameter of *service* as *multirequest* and define the *action* as *null* using (http://www.kaltura.com/api_v3/?service=multirequest&action=null).

2.  Prefix each API call with a number that represents its order in the multi-request call, followed by a colon. Prefix the first call with *1:*, the second with *2:*, and so on.

3.  Use the prefix for each of an API call's parameters (service, action, and action parameters).

### Multi-Request Structure Example  

{% highlight c %}
<pre class="brush: xml;fontsize: 100; first-line: 1; ">Request URL: api_v3/index.php?service=multirequest&action=null
	POST variables:
		1:service=baseEntry
		1:action=get
		1:version=-1
		1:entryId=0_zsadqv3e
		2:service=flavorasset
		2:action=getWebPlayableByEntryId
		2:entryId=0_zsadqv3e
		2:version=-1
		ks={ks}</pre>
{% endhighlight %}


### Multi-Request with Dependency - Structure  

To create a multi-request with a dependent request, use the following structure as input in the variable whose value you want to replace with a result of a preceding request:

{% highlight c %}
<pre class="brush: xml;fontsize: 100; first-line: 1; ">{num:result:propertyName}</pre>
{% endhighlight %}

where:

*   *num* is the number of the request from which to collect data.
*   *result* instructs the Kaltura API to replace this value with a result from another request.
*   *propertyName* is the property to obtain from the object of the required result.

### Multi-Request With Dependency - Example  

{% highlight c %}

<pre class="brush: xml;fontsize: 100; first-line: 1; ">Request URL: api_v3/index.php?service=multirequest&action=null
	POST variables:
		1:service=media
		1:action=list
		1:filter:nameLike=myentry
		2:service=media
		2:action=get
		2:entryId={1:result:objects:0:id}
		ks={ks}</pre>
{% endhighlight %}


In the example, the first request lists entries whose names resemble *myentry*. The *media.list* request returns an object of type *KalturaMediaListResponse*, which contains an object named *objects* of type *KalturaMediaEntryArray*.

The second request is *media.get*, which uses *entryId* as input.

The *entryId* input is dynamic, and the value is obtained from the first request. Since the *media.list* response is constructed of array object within a response object, the first property to access is *KalturaMediaEntryArray*.

Since in the `KalturaMediaEntryArray` you want to obtain the first element (index **), add *:0* to the request value.

Since from the first element you want only the ID that is the input for the second request, add *:id* to the request value.


## Maintaining Backward Compatibility and Tracking Version Changes  

Maintaining backward compatibility during API upgrades is a common concern for developers utilizing APIs to build applications. 

Kaltura's client libraries are automatically generated from the server code, that include an automatic client libraries' generator mechanism. See [Adding the New Kaltura API Client Library Generator](https://knowledge.kaltura.com/node/43) for more information. As a result, the Kaltura API client libraries are not available as a static code repository that you can track for changes.

To keep up to date with the changes between releases, follow the [Kaltura API Twitter account](https://twitter.com/Kaltura_API). 

For each Kaltura release, the Kaltura API Twitter account notifies followers about additions and changes made to the REST APIs, Players APIs, and changes to the Client Libraries, and release notes are provided about the new release.

Kaltura API based applications do not require frequent updates to the client library used. Kaltura is committed to provide full backward computability to the API layer, keeping deprecated APIs functional, and ensuring that additions or changes introduced in new versions will not break existing applications. 

When new functionalities for your applications are introduced, or when maintainance upgrades are made to your applications, we encourage you to keep your client libraries updated even though an upgrade based on the availability of new Kaltura releases is not required.
