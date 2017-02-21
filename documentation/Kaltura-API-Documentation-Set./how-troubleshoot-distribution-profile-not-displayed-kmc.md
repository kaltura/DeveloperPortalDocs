---
layout: page
title: How to Troubleshoot a Distribution Profile that is not Displayed in the KMC
---

If a distribution profile that you create is not displayed in the KMC:

1.  Call the [distributionProfile.list][1] API action to get your default YouTube demo profile.  
    {% highlight php %}<?php require_once('lib/KalturaClient.php'); $config = new KalturaConfiguration($partnerId); $config->serviceUrl = 'http://www.kaltura.com/'; $client = new KalturaClient($config); $client->setKs('AddYourKSHere'); $pager = new KalturaFilterPager(); $pager->pageSize = 30; $filter = new KalturaDistributionProfileFilter(); $filter->idEqual = 'DistributionProfileId'; $results = $client-> distributionProfile ->listAction($filter, $pager);{% endhighlight %}
2.  Compare the default YouTube profile to the distribution profile that is not displayed.

 [1]: http://www.kaltura.com/api_v3/testmeDoc/index.php?service=contentdistribution_distributionprofile&action=list

<span class="mce-note-graphic">You can use this method to troubleshoot a distribution profile that you create using a client library API.</span>
