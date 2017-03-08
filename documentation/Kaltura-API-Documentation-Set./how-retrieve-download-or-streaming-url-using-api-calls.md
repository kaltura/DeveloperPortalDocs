---
layout: page
title: How to Retrieve the Download or Streaming URL using API Calls?
---

The Kaltura Player abstracts the need to retrieve direct access to the video file, and handles the various aspects of the video playback including multi-bitrate, choosing the correct codec and streaming protocols, DRM, Access Control and more. Often applications need a direct URL for downloading the raw media file for purposes such as streaming outside of the Kaltura Player, processing the video data (such as video analysis or transcriptions) and more. In cases where you need to access the playback stream directly, or just a link to download the video file, you will need to consider the target playback devices, any security protocols applied to your Kaltura account and video, and then call the suitable API methods. The following will guide developers of using the playManifest API call to retrieve specific transcoded video flavors from a Kaltura account. 

## The playManifest API  

The playManifest is a redirect action [source code](https://github.com/kaltura/server/blob/master/alpha/apps/kaltura/modules/extwidget/actions/playManifestAction.class.php), whose purpose is to direct media player applications to the desired video stream.

playManifest features return the following types:

1.  A redirect to video file for [progressive download (http://en.wikipedia.org/wiki/Progressive_download) or an M3U8 stream descriptor for [Apple HTTP Streaming, aka HLS](http://en.wikipedia.org/wiki/HTTP_Live_Streaming).
2. An XML response in the form of a MPEG-DASH Media Presentation Description (MPD).
2.  An XML response in the form of [Flash Media Manifest File](http://osmf.org/dev/osmf/specpdfs/FlashMediaManifestFileFormatSpecification.pdf).

### Retrieving a URL for a Video Stream  

To retrieve a specific video flavor, call the **playManifest** API. Be certain to have the Partner ID and Entry ID at hand. To call the **playManifest** API and retrieve a specific video flavor, call the following URL -

**[serviceUrl]**/p/**[YourPartnerId]**/sp/0/playManifest/entryId/**[YourEntryId]**/format/**[StreamingFormat]**/protocol/**[Protocol]**/flavorParamId/**[VideoFlavorId]**/ks/**[ks]**/video.**[ext]**

Replace the following parameters:

*   **serviceUrl - **the base URL to the Kaltura Server (e.g. http://www.kaltura.com)
*   **YourPartnerId** - Your Kaltura account publisher Id. (Can be retrieved from the <a href="http://www.kaltura.com/index.php/kmc/kmc4#account|integration" target="_blank">Publisher Account Settings</a> page in the KMC).
*   ****YourEntryId**** - The Id of the media entry you'd like to retrieve.
*   **StreamingFormat** - See the list of available formats in the table below. This parameter is optional and defaults to <span style="font-family: 'andale mono', times;">/format/url</span>
*   **Protocol** - Whether video is to be delivered over HTTP or HTTPS. See the list of available protocols below for additional options. This parameter is optional and defaults to <span style="font-family: 'andale mono', times;">/format/http</span>
*   ******VideoFlavorId** - ****The Id of the video flavor you want to download. If supported by the streaming format, multiple flavors may be comma-separated.
*   **ks** - A valid Kaltura Session. This parameter is only required when the media entry has an Access Control defined to limit anonymous access to the media.
*   ********ext****** - The file extension of the video you wish to retrieve (For example, mp4, if the video flavor is an MPEG4 file or flv, if the video flavor is an FLV file.)**


### Available Service URLs (Public / SaaS)  

| Protocol + Domain             | Description                         |
|-------------------------------|-------------------------------------|
| https://cdnapisec.kaltura.com | Secure HTTPS Request. (recommended) |
| http://cdn.kaltura.com        | Standard HTTP Request.              |


### Available Playback Formats  


| Format            | Description                                                                                          |
|-------------------|------------------------------------------------------------------------------------------------------|
| mpegdash          | MPEG-DASH Streaming.                                                                                 |
| applehttp         | HTTP Live Streaming (HLS) Streaming.                                                                 |
| url               | Progressive download.                                                                                |
| hds               | Adobe HTTP Dynamic Streaming. Not available for all Kaltura accounts.                                |
| rtmp              | Real Time Messaging Protocol (RTMP). Recommended only for Live, or special use cases.                |
| rtsp              | Real Time Streaming Protocol (RTSP). For legacy devices, such as older Blackberry and Nokia phones.  |
| hdnetworkmanifest | Akamai HDS delivery. Available only for accounts with Akamai delivery.                               |
| hdnetwork         | Akamai Proprietary Delivery Protocol. Available only for accounts with Akamai delivery. (deprecated) |


### Available Protocol Parameters  

| Protocol                 | Description                                                                                                         |
|-------------------------|---------------------------------------------------------------------------------------------------------------------|
| http                    | http Redirect and streaming URLs make use of the HTTP protocol. (Default)                                           |
| https                   | https  Redirect and streaming URLs make use of the HTTPS protocol.                                                  |
| rtmp|rtmpe|rtmpt|rtmpte | (RTMP Streaming only) Streaming Server Base URL make use of the specified protocol (RTMP, RTMPE, RTMPT, or RTMPTE). |


### Examples  

* http://www.kaltura.com/p/309/sp/0/playManifest/entryId/1_rcit0qgs/format/url/flavorParamId/301971/video.mp4
* http://www.kaltura.com/p/309/sp/0/playManifest/entryId/1_rcit0qgs/format/applehttp/protocol/http/flavorParamId/301971/video.mp4

>Note: The playManifest API is not a standard part of the Kaltura API v3, it is a direct URL request that retrieves the specific binary video file from Kaltura. The response to the playManifest URL is the actual video file of the requested entry flavor.


>Note: The playManifest API does not require a KS unless the media entries were specifically setup with Access Control profiles to limit anonymous access to the media. If the media entry does have Access Control profiles assigned, a KS (Kaltura Session) must be specfied when calling the playManifest URL.

### >Considerations of Access Control and Entitlements  

It is important to note that Kaltura entries can be set for private or protected modes, where access is only allowed when providing a valid admin [Kaltura Session](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/how-to-create-kaltura-session.html).

For best practice, to retrieve the download URL for an entry, use the following steps:

1.  Locate the ID of the desired video flavor (see below Video Flavor Id).
2.  Call the `flavorAsset.geturl` API action.

Below is a PHP code sample for retrieving the download URL of a web-playable flavor for a desired entry ID:

{% highlight c %}

//Client library configuration and instantiation...
 
//when creating the Kaltura Session it is important to specify that this KS should bypass entitlemets restrictions:
$ks = $client->session->start($secret, $userId, KalturaSessionType::ADMIN, $partnerId, 86400, 'disableentitlement');
$client->setKs($ks);
 
$client->startMultiRequest();
$entryId = '1_u7aj9kasw'; //replace this with your entry Id
$client->flavorAsset->getwebplayablebyentryid($entryId);
$req1ResultFlavorId = '{1:result:0:id}'; //get the first flavor from the result of getwebplayablebyentryid
$client->flavorAsset->geturl($req1ResultFlavorId); //this action will return a valid download URL
$multiRequestResults = $client->doMultiRequest();
$downloadUrl = $multiRequestResults[1];
echo 'The entry download URL is: '.$downloadUrl;


{% endhighlight %}

### Video Flavor ID  

The VideoFlavorId parameter determines which video flavor the API will return as download. This parameter has various options, depending on the Kaltura server deployment and publisher account.

The following lists few of the conventional flavor IDs:

>Note:Note: Only flavor id 0 (zero) is static and the same across Kaltura editions. The following list are common flavor Ids on the Kaltura SaaS edition, but note flavors change and upgraded often (improved quality, new codecs, etc.) - Use this list for example purposes.

* The original uploaded video (before transcoding) = 0
* iPhone / Android (mp4) = 301951
* iPad (mp4) = 301971
* Nokia/Blackberry (3gp) = 301991
* Other devices (mp4) = 301961

The correct flavor IDs (per account and Kaltura edition) can be retrieved using one of the following ways:

1. Visiting the KMC Settings > [Transcoding Profiles](http://knowledge.kaltura.com/faq/how-create-transcoding-profile).
2. Making an API call to the [ConversionProfile.list action](https://developer.kaltura.com/api-docs/#/conversionProfile.list).

### >Retrieving Streaming URL for Mobile Applications  

To retrive streaming URL for mobile applications, use the following guidelines:

* For Apple iPad devices – <a href="#acl-entitlements-consider">get all the flavors</a> (marked ready) that have the tag 'ipadnew' and build the following URL:

{% highlight c %}
<pre class="brush: jscript;fontsize: 100; first-line: 1; ">serviceUrl + '/p/' + partnerId + '/sp/' + partnerId + '00/playManifest/entryId/' + entryId + '/flavorIds/' + flavorIds.join(',') + '/format/applehttp/protocol/http/a.m3u8?ks=' + ks + '&referrer=' + base64_encode(application_name)</pre>
<pre class="brush: jscript;fontsize: 100; first-line: 1; ">serviceUrl + '/p/' + partnerId + '/sp/' + partnerId + '00/playManifest/entryId/' + entryId + '/flavorIds/' + flavorIds.join(',') + '/format/applehttp/protocol/http/a.m3u8?ks=' + ks + '&referrer=' + base64_encode(application_name)</pre>

{% endhighlight %}

* For Apple iPhone devices – <a href="#acl-entitlements-consider">get all the flavors</a> (marked ready) that have the tag 'iphonenew' tag and build the following URL:

{% highlight c %}
<pre class="brush: jscript;fontsize: 100; first-line: 1; ">serviceUrl + '/p/' + partnerId + '/sp/' + partnerId + '00/playManifest/entryId/' + entryId + '/flavorIds/' + flavorIds.join(',') + '/format/applehttp/protocol/http/a.m3u8?ks=' + ks + '&referrer=' + base64_encode(application_name)</pre>
{% endhighlight %}

* For Android devices that support HLS – <a href="#acl-entitlements-consider">get all the flavors</a> (marked ready) that have the tag 'iphonenew' tag (excluding audio-only flavors where width, height & framerate fields equal to zero) and build the following URL:

{% highlight c %}
<pre class="brush: jscript;fontsize: 100; first-line: 1; ">serviceUrl + '/p/' + partnerId + '/sp/' + partnerId + '00/playManifest/entryId/' + entryId + '/flavorIds/' + flavorIds.join(',') + '/format/applehttp/protocol/http/a.m3u8?ks=' + ks + '&referrer=' + base64_encode(application_name)</pre>
{% endhighlight %}

* For Android devices that do not support HLS – get a single video flavor that has the 'iPhoneNew' tag and build the following URL:

{% highlight c %}
<pre class="brush: jscript;fontsize: 100; first-line: 1; ">serviceUrl + '/p/' + partnerId + '/sp/' + partnerId + '00/playManifest/entryId/' + entryId + '/flavorId/' + flavorId + '/format/url/protocol/http/a.mp4?ks=' + ks + '&referrer=' + base64_encode(application_name)</pre>
{% endhighlight %}

## Retrieving the Currently Playing Video URL using the Player JS API  

To retrieve the URL of the video that is being played in the player, use the following player call:

[`kWidget.getSources`](http://player.kaltura.com/kWidget/tests/kWidget.getSources.html)

To learn more about the [evaluate function](http://www.kaltura.org/demos/kdp3/docs.html#evaluate) and the KDP API, read: [JavaScript API for Kaltura Media Players](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/javascript-api-kaltura-media-players.html).

