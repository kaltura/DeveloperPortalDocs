---
layout: page
title: Creating A Kaltura Video Gallery
---

## Prerequisites  

Kaltura Partner Service: 3.0 (aka api_v3)

Web site designers may want to add a Gallery component to their web pages so that end-users can browse within a large set of media files and conveniently select the media they want to see. For additional information, read the overview of the  [KGallery widget](http://knowledge.kaltura.com/kgallery-kaltura-video-gallery).

See [demo](http://www.kaltura.org/sites/default/themes/kdotorg/demos/kgallery/kgalleryScrollable.php) for details.

## Integration Steps  

To get started please read the [Kaltura API usage guidelines](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/Getting-Started-VPaaS-API.html).

## Editing your Web Page to Integrate with Kaltura Gallery Services

Integrating KGallery services into your web site requires that you add following to your web page:

*  <a href="#ext">Inclusion of External Scripts</a>
*  <a href="#define">Definition of constants and variables</a>
*  <a href="#construct">Construction of Kaltura Objects for Session Initiation</a>
*  <a href="#media">Media entries list retrieval</a>
*  <a href="#pop">Population of media entries within Gallery layout</a>
*  <a href="#java">JavaScript implementation for showing selected media</a>


## Full Example Script

The following example of PHP/JavaScript script demonstrates the integration of the KGallery services into a PHP based web application. To run this script, please make sure you set your partner identifiers at the <span class="geshifilter"><code class="geshifilter-php">KALTURA_PARTNER_ID</code></span> and <span class="geshifilter"><code class="geshifilter-php">KALTURA_PARTNER_SERVICE_SECRET</code></span> constants.  
Look for detailed information on this example in the files contained in <a href="http://knowledge.kaltura.com/sites/default/files/KGallery.zip" class="bb-url">Download Simple KGallery script.</a>

## <a name="ext"></a>Inclusion of External Scripts

The following example displays the external script required for the KGallery Services.

<div class="geshifilter">
  <div class="php geshifilter-php">
    {% highlight php %}<html> <head> </head> <body> 
<!--include external scripts--> 
<?php require_once("kaltura_client_v3/KalturaClient.php");
{% endhighlight %}
  </div>
</div>

The <span class="geshifilter"><code class="geshifilter-php">KalturaClient&lt;span>.&lt;/span>php</code></span> scripts are part of the PHP Kaltura API Client Library being included to enable the use of Kaltura objects.

## <a name="define"></a>Define Constants and Variables

In the following example, the PHP code defines 2 constants and one variable, to be used later within the implementation.

<div class="geshifilter">
  <div class="php geshifilter-php">
    {% highlight php %}
//define constants define("KALTURA_PARTNER_ID", Your Partner Id); 
define("KALTURA_PARTNER_WEB_SERVICE_SECRET", "Your Partner ADMIN secret");
{% endhighlight %}
  </div>
</div>

The following describes the parameters in detail.

<table>
  <thead>
    <tr>
      <th>
        Parameter
      </th>
      
      <th>
        Type
      </th>
      
      <th>
        Default
      </th>
      
      <th>
        Description
      </th>
    </tr>
  </thead>
  
  <tbody>
    <tr>
      <td style="text-align: left;">
        KALTURA_PARTNER_ID
      </td>
      
      <td>
        Numeric
      </td>
      
      <td style="text-align: left;">
        N/A
      </td>
      
      <td style="text-align: left;">
        Enter your Partner ID. Please refer to <a href="http://knowledge.kaltura.com/kaltura-api-usage-guidelines">Kaltura API usage guidelines</a>
      </td>
    </tr>
    
    <tr>
      <td>
        KALTURA_PARTNER_WEB_SERVICE_SECRET
      </td>
      
      <td style="text-align: left;">
        String
      </td>
      
      <td style="text-align: left;">
        N/A
      </td>
      
      <td style="text-align: left;">
        Enter your Web Service Secret. Please refer to <a href="http://knowledge.kaltura.com/kaltura-api-usage-guidelines">Kaltura API usage guidelines</a>. This Secret string is used within Kaltura objects to create a secured session ID, preventing hacking and abuse attempts aiming to damage Partner/end-user’s content.
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        partnerUserID
      </td>
      
      <td style="text-align: left;">
        String
      </td>
      
      <td style="text-align: left;">
        N/A
      </td>
      
      <td style="text-align: left;">
        This is an example of a variable that could be used for content filtering. This variable may be used to populate the relevant content within the Gallery layout. It makes sense to apply this specific identifier as filter criteria only if it was assigned to media content upon media uploading. For the benefit of a generic example script, this parameter was not actually assigned as a filter, but was only defined and set for example purposes.
      </td>
    </tr>
  </tbody>
</table>

## <a name="construct"></a>Construct Kaltura Objects for Session Initiation

The following example shows how the PHP code constructs the relevant Kaltura objects, used for session initiation. The objects are constructed as defined and implemented at the relevant Kaltura API Client Library. A unique session (KS) is then generated and set.

<div class="geshifilter">
  <div class="php geshifilter-php">
    {% highlight php %}
$config = new KalturaConfiguration(KALTURA_PARTNER_ID); 
$client = new KalturaClient($config); 
$ks = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_SECRET, $partnerUserID,KalturaSessionType::USER); 
$client->setKs($ks); // set the session in the client
{% endhighlight %}
  </div>
</div>

## <a name="media"></a>Media Entries List Retrieval

The following example shows how the PHP code constructs a filter object and a pager object for controlling the selection of media elements to be displayed within the gallery layout. These objects are passed as arguments to the Kaltura <a href="https://developer.kaltura.com/api-docs/#/media.list" class="bb-url">media:list</a> service for setting the proper selection criteria.

<div class="geshifilter">
  <div class="php geshifilter-php">
    {% highlight php %}
$filter = new KalturaMediaEntryFilter(); 
$filter->statusEqual = KalturaEntryStatus::READY; 
$filter->mediaTypeEqual = KalturaMediaType::VIDEO ; 
$pager = new KalturaFilterPager(); 
$pager->pageSize = 5; 
$pager->pageIndex = 1; 
$list = $client->media->listAction($filter,$pager); // list all of the media items in the partner 
?>
{% endhighlight %}
  </div>
</div>

The <a href="https://developer.kaltura.com/api-docs/#/KalturaMediaEntryFilter" class="bb-url">KalturaMediaEntryFilter</a> object allows specific filters to apply on media selection and order. The filter parameters set in the example are only a few of the possible sets of filter parameters. A full list of filter parameters is available at the <a href="https://developer.kaltura.com/api-docs/#/KalturaMediaEntryFilter" class="bb-url">KalturaMediaEntryFilter</a> page within the Kaltura API documentation site.

The <a href="https://developer.kaltura.com/api-docs/#/KalturaFilterPager" class="bb-url">KalturaFilterPager</a> object enables paging management while retrieving media elements. This is an optional mechanism which may be in use when gallery design includes pages layout. When no pager object is passed as an argument to the Kaltura <a href="https://developer.kaltura.com/api-docs/#/media.list" class="bb-url">media:list</a> service, the returned list will include all media items (according to filter object only). Look for more information on this object in the <a href="https://developer.kaltura.com/api-docs/#/KalturaFilterPager" class="bb-url">KalturaFilterPager</a> page within the Kaltura API documentation site.

The Kaltura <a href="https://developer.kaltura.com/api-docs/#/media.list" class="bb-url">media:list</a> service, returns a <a href="https://developer.kaltura.com/api-docs/#/KalturaMediaListResponse" class="bb-url">KalturaMediaListResponse</a> Object. This is an array of <a href="https://developer.kaltura.com/api-docs/#/KalturaMediaEntryFilter" class="bb-url">KalturaMediaEntry</a> objects, holding information on the entries to be presented within the Gallery implementation. The common parameters to be used within a gallery implementation are:<span class="geshifilter"><code class="geshifilter-php">thumbnailUrl&lt;span>,&lt;/span>&nbsp;mediaType&lt;span>,&lt;/span>&nbsp;id&lt;span>,&lt;/span>&nbsp;name</code></span> and <span class="geshifilter"><code class="geshifilter-php">description</code></span>. Look for more information on these parameters at the <a href="https://developer.kaltura.com/api-docs/#/KalturaMediaEntryFilter" class="bb-url">KalturaMediaEntry</a> page within the Kaltura API documentation site

## <a name="pop"></a>Population of Media Entries within the Gallery Layout

The following example shows how the  <span class="geshifilter"><code class="geshifilter-php">KalturaGallary</code></span> div is set to contain a simple html table based layout Gallery. The PHP script loops over the returned list of media entries and for each entry it lays out its thumbnail and its name. Clicking on a gallery thumbnail image will activate media loading for the selected entry. In this example media loading is triggered using selected entryId as a unique identifier.

<div class="geshifilter">
  <div class="php geshifilter-php">
    {% highlight javascript %}
<div id="KalturaGallary" style="position:relative;overflow:hidden;"> <table> 
<?php foreach ($list->objects as $mediaEntry): ?> 
<?php $name = $mediaEntry->name; // get the entry name 
$id = $mediaEntry->id; 
$thumbUrl = $mediaEntry->thumbnailUrl; // get the entry thumbnail URL 
$description = $mediaEntry->description; 
?> 
<td> <ul style="list-style:none;"> <li style="width:120px; height:90px;"><a href="javascript:LoadMedia('<?php echo $id; ?>')"> <img border="0" src="<?php echo $thumbUrl; ?>" > </a></li> <li style="width:120px; height:40px;">
<?php echo $name; ?></li> </ul> </td> <?php endforeach; ?> </table> </div>
{% endhighlight %}
  </div>
</div>

 

## <a name="java"></a>JavaScript Implementation for Showing Selected Media

The following example shows how a JavaScript method is defined, when receiving the media’s <span class="geshifilter"><code class="geshifilter-php">entryId</code></span> as an argument. This is where the implementation of media loading should be set. An example of this type of implementation may be loading the selected media to be played by the Kaltura Dynamic Player Widget.

<div class="geshifilter">
  <div class="javascript geshifilter-javascript">
    {% highlight javascript %}
<script language="javascript"> 
function LoadMedia(entryId) { 
	alert (entryId); // show media implementation should go here. 
} 
</script> 
{% endhighlight %}
  </div>
</div>

In you are using media components which are not based on Kaltura technology, a content url may be constructed out of <span class="geshifilter"><code class="geshifilter-php">entryId</code></span> and Partner’s identifiers according to the following format:

<span class="geshifilter"><code class="geshifilter-text">http://cdn.kaltura.com/p/{partner_id}/sp/{subpartner_id}/flvclipper/{entryid}</code></span>

## Integrating Kaltura Gallery Services into a Scrollable Gallery Layout

Several open source projects implement built-in technology for scrollable media galleries. Integrating Kaltura Gallery Services into that type of layout is easy and follows the same logic described in this article.

The following example demonstrates integration with jQuery scrollable tools. More information on these tools is available in the <a href="http://plugins.jquery.com/project/scrollable" class="bb-url">jQuery Scrollable</a> page. To run this script, please make sure you set your partner identifiers at the <span class="geshifilter"><code class="geshifilter-php">KALTURA_PARTNER_ID</code></span> and <span class="geshifilter"><code class="geshifilter-php">KALTURA_PARTNER_SERVICE_SECRET</code></span> constants.

Click to <a href="http://knowledge.kaltura.com/sites/default/files/kgalleryScrollable.zip" class="bb-url">Download a Scrollable based KGallery script.</a>

For further problem solving and more details about the KGallery, see <a href="http://knowledge.kaltura.com/search/KGallery" class="bb-url">Frequently Asked Questions about KGallery Integration</a>.
