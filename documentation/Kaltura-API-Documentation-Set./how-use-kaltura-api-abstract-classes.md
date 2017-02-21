---
layout: page
title: How to use Kaltura API Abstract Classes
---

Abstract classes cannot be instantiated. Therefore abstracts have derived classes, but not objects. For each abstract class, use one of its sub classes.

Each abstract class has a subset of required properties. The specific properties that are required depend on the service/action pair and object used with the sub class.

<p class="APEdocument APEinternal">
  For example, for the <a href="https://developer.kaltura.com/api-docs/#/syndicationFeed.add">syndicationFeed.add</a> API, select one of the sub classes listed for the abstract <a href="https://developer.kaltura.com/api-docs/#/KalturaBaseSyndicationFeed">KalturaBaseSyndicationFeed</a> class, such as <a href="https://developer.kaltura.com/api-docs/#/KalturaGenericSyndicationFeed">KalturaGenericSyndicationFeed</a>.
</p>

<p class="APEdocument APEinternal">
  <a href="https://developer.kaltura.com/api-docs/#/KalturaBaseSyndicationFeed">KalturaBaseSyndicationFeed</a> supports <a href="https://developer.kaltura.com/api-docs/#/KalturaGoogleVideoSyndicationFeed">Google</a>, <a href="https://developer.kaltura.com/api-docs/#/KalturaITunesSyndicationFeed">iTunes</a>, <a href="https://developer.kaltura.com/api-docs/#/KalturaTubeMogulSyndicationFeed">TubeMogul</a>, <a href="https://developer.kaltura.com/api-docs/#/KalturaYahooSyndicationFeed">Yahoo</a>, and <a href="https://developer.kaltura.com/api-docs/#/KalturaGenericXsltSyndicationFeed">KalturaGenericXsltSyndicationFeed</a> (a sub class of <a href="https://developer.kaltura.com/api-docs/#/KalturaGenericSyndicationFeed" class="APEdocument APEinternal">KalturaGenericSyndicationFeed</a>). <a href="https://developer.kaltura.com/api-docs/#/KalturaGenericXsltSyndicationFeed">KalturaGenericXsltSyndicationFeed</a> supports running a custom XSLT on the XML feed that the Kaltura system generates internally.
</p>

<p class="APEdocument APEinternal">
  To call the <a href="https://developer.kaltura.com/api-docs/#/syndicationFeed.add">syndicationFeed.add</a> API with the <a href="https://developer.kaltura.com/api-docs/#/KalturaGenericXsltSyndicationFeed">KalturaGenericXsltSyndicationFeed</a> sub class:
</p>{% highlight php %}
<?php 
require_once('lib/KalturaClient.php'); 
$config = new KalturaConfiguration($partnerId); 
$config->serviceUrl = 'http://www.kaltura.com/'; 
$client = new KalturaClient($config); 
$ks = '213mg23433_q2fq'; //Add your KS here 
$client->setKs('$ks'); 
$syndicationFeed = new KalturaGenericXsltSyndicationFeed(); 
$syndicationFeed->type = KalturaSyndicationFeedType::KALTURA_XSLT; 
$results = $client-> syndicationFeed ->add($syndicationFeed);
?>
{% endhighlight %}
