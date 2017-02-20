---
layout: page
title: Creating a Dynamic List of Entries Using the listAction API for KGallery Implementation
---

## Introduction to the listAction API

This article describes how to use the <a href="https://developer.kaltura.com/api-docs/#/baseEntry.list" class="bb-url">list action</a> API available on the <a href="https://developer.kaltura.com/api-docs/#/baseEntry" class="bb-url">baseEntry</a> object API. As an example, we will create an HTML list view with pager and entry type filter.  
This article also describes how to use  <a href="https://developer.kaltura.com/api-docs/#/baseEntry.list" class="bb-url">list action</a> API to create the <a href="http://knowledge.kaltura.com/kgallery-kaltura-video-gallery" class="bb-url">KGallery implementation</a>.

<a href="http://knowledge.kaltura.com/sites/default/files/list-entries-script.zip" class="bb-url">Download the list entries script.</a>

### Using the Code

To call the <a href="https://developer.kaltura.com/api-docs/#/baseEntry.list" class="bb-url">list entries action</a>, you will need to use an ADMIN type KS (<a href="http://knowledge.kaltura.com/kaltura-api-usage-guidelines" class="bb-url">Read more</a>). Before calling the list action, you will need to define the Partner id and it's ADMIN secret.

<div class="geshifilter">
  <div class="php geshifilter-php">
    {% highlight php %}
<?php
//define constants 
define("KALTURA_PARTNER_ID", ""); 
define("KALTURA_PARTNER_WEB_SERVICE_ADMIN_SECRET", ""); 
{% endhighlight %}
Using the partner credentials, generate the KS:
  </div>
</div>

<div class="geshifilter">
  <div class="php geshifilter-php">
    {% highlight php %}
<?php
//define session variables 
$partnerUserID = '31'; // this can be whatever you decide depending on your implementation //Construction of Kaltura objects for session initiation 
$config = new KalturaConfiguration(KALTURA_PARTNER_ID); 
$client = new KalturaClient($config); 
$ks = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_ADMIN_SECRET, $partnerUserID,KalturaSessionType::ADMIN); //Set the generated KS as the default actions KS to use by the client library 
$client->setKs($ks);
?>
{% endhighlight %}
  </div>
</div>

After the KS is  set up, perform the following steps to call the list action:

1.  Define the filter to use when listing the entries.<div class="geshifilter">
      <div class="php geshifilter-php">
        {% highlight php %}
<?php
$entryFilter = new KalturaBaseEntryFilter(); 
/** * Available types (defined within KalturaEntryType class under KalturaClient.php): 
* AUTOMATIC = -1; 
* MEDIA_CLIP = 1; 
* MIX = 2; 
* PLAYLIST = 5; 
* DATA = 6; 
* DOCUMENT = 10; 
*/ 
if (isset($_GET['entryType'])) 
	$entryFilter->typeEqual = (int)$_GET['entryType']; 
?>
{% endhighlight %}

{% highlight php %}
<?php
$entryFilter->statusEqual = KalturaEntryStatus::READY; 
$entryFilter->orderBy = KalturaBaseEntryOrderBy::CREATED_AT_DESC; 
?>
{% endhighlight %}
To allow for the list to filter according to a url parameter by the name of entryType, use the <span class="geshifilter"><code class="geshifilter-php">$_GET['entryType']</code></span> variable. If a filter is not defined, all entries will be returned by the list action.
      </div>
    </div>
    
    <span class="geshifilter"><code class="geshifilter-php">statusEqual</code></span> is used to return only the entries that have finished the ingestion process and that are ready to be used and viewed by the users. <span class="geshifilter"><code class="geshifilter-php">orderBy&nbsp;</code></span>is used to return the list ordered such as the latest entries created will be shown first.

2.  Define the pager.  
    <div class="geshifilter">
      <div class="php geshifilter-php">
        {% highlight php %}
<?php
$kalturaPager = new KalturaFilterPager(); 
$kalturaPager->pageSize = 10; 
$kalturaPager->pageIndex = (isset($_GET['p']))? $_GET['p']: 1;
?>
{% endhighlight %}
      </div>
    </div>
    
    In order to divide the result to smaller chunks and return only 10 entries per request, we use a pager. The pager decide how many results to return and the results chunk number (page).  
    i.e. if we have 120 entries and we set the <span class="geshifilter"><code class="geshifilter-php">pageSize</code></span> to 10, we will have 12 pages that each represents a chunk of 10 entries.  
    Again, in order to set the page number from a url parameter, we use the <span class="geshifilter"><code class="geshifilter-php">$_GET['p']</code></span> variable.

3.  Call the list action with the filter and pager you created.  
      
    $result = $client->baseEntry->listAction($entryFilter, $kalturaPager);
    To present the list on the page, print out an HTML for the returned list.
    
    <div class="geshifilter">
      <div class="php geshifilter-php">
        {% highlight javascript %}
<?php foreach($result->objects as $entry): ?> 
<div id="<?php echo $entry->id; ?>" class="doc"> 
<div><span>Name: </span>
<?php echo $entry->name; ?></div> 
<div><span>Created: </span>
<?php echo date('Y-m-d H:i:s', $entry->createdAt); ?></div> 
<div><a href="#" onclick="$('#infodiv<?php echo $entry->id; ?>').toggle('fast');" >More...</a>
<div style="display:none;overflow:hidden;" id="infodiv<?php echo $entry->id; ?>">
<pre><?php echoprint_r($entry, true); ?></pre>
</div>
</div> 
</div> 
<? endforeach; ?>
?>
{% endhighlight %}
      </div>
    </div>

4.  Create the pager.

<div class="geshifilter">
  <div class="php geshifilter-php">
        {% highlight php %}
<div class="pager">
<?php
$page = 1;
while($page)
{
        $filename = pathinfo(__FILE__, PATHINFO_FILENAME).'.'.pathinfo(__FILE__, PATHINFO_EXTENSION);
        if($page == $kalturaPager->pageIndex)
                echo $page.' ';
        else
                if (isset($_GET['entryType']))
                        echo '<a href="'.$filename.'?p='.$page.'&entryType='.$_GET['entryType'].'>'.$page.'</a>';
                else
                        echo '<a href="'.$filename.'?p='.$page.'>'.$page.'</a>';

        if($page*$kalturaPager->pageSize > $result->totalCount)
                break;

        $page++;
}
?>
</div>
{% endhighlight %}
  </div>
</div>

<span class="geshifilter"><code class="geshifilter-php">$filename</code></span> - holds the base url to the page, to build the url according to the selected page.  
The rest of the code prints a list of links. Each represents a call for a new page, building the page links using the base url (<span class="geshifilter"><code class="geshifilter-php">$filename</code></span>), the page selected and the entryType specified on the url.
