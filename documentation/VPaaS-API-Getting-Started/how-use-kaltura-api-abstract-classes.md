---
layout: page
title: How to use Kaltura's API Abstract Classes
weight: 107
---

Abstract classes cannot be instantiated; therefore abstracts have derived classes, but not objects. For each abstract class, use one of its sub classes.

Each abstract class has a subset of required properties. The specific properties that are required depend on the service/action pair and object used with the sub class.

For example, for the [syndicationFeed.add](https://developer.kaltura.com/api-docs/#/syndicationFeed.add) API, select one of the sub classes listed for the abstract [KalturaBaseSyndicationFeed](https://developer.kaltura.com/api-docs/#/KalturaBaseSyndicationFeed) class, such as [KalturaGenericSyndicationFeed]"https://developer.kaltura.com/api-docs/#/KalturaGenericSyndicationFeed).

The [KalturaBaseSyndicationFeed](https://developer.kaltura.com/api-docs/#/KalturaBaseSyndicationFeed) supports the following:

* [Google](https://developer.kaltura.com/api-docs/#/KalturaGoogleVideoSyndicationFeed)
* [iTunes](https://developer.kaltura.com/api-docs/#/KalturaITunesSyndicationFeed)
* [TubeMogul](https://developer.kaltura.com/api-docs/#/KalturaTubeMogulSyndicationFeed)
* [Yahoo](https://developer.kaltura.com/api-docs/#/KalturaYahooSyndicationFeed)
* [KalturaGenericXsltSyndicationFeed](https://developer.kaltura.com/api-docs/#/KalturaGenericXsltSyndicationFeed) a sub class of [KalturaGenericSyndicationFeed](https://developer.kaltura.com/api-docs/#/KalturaGenericSyndicationFeed), which supports running a custom XSLT on the XML feed that the Kaltura system generates internally.

To call the [syndicationFeed.add](https://developer.kaltura.com/api-docs/#/syndicationFeed.add) API with the [KalturaGenericXsltSyndicationFeed](https://developer.kaltura.com/api-docs/#/KalturaGenericXsltSyndicationFeed) sub class use the following:

{% highlight php %}
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
