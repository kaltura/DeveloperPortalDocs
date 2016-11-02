---
layout: page
title: Kaltura Video Insights - Data Retrieval API
weight: 150
subcat: Analytics API - Limited Alpha
---

*This new analytics service is in limited alpha version.*
*Access to this service is available by request, as it is currently released as an Early Preview.*
*Please write to VPaaS@kaltura.com to request activation.*

The Kaltura Video Insights Data Retrieval API provides a simple but powerful tool to query data programmatically using Kaltura API standards, such as authentication, client libraries, etc.

## Endpoint  

http://www.kaltura.com/api_v3/index.php?service=analytics&action=query

### Input  


| Parameter     | DescriptionD     | Expected Values | Mandatory |
|:---|:---|:---|:---|
|startDate|	 start date from which to fetch the data|	The	date and time with the format MM/dd/yyyy HH:mi| Yes |
|endDate |	The end date until which to fetch the data	|A date and time with the format MM/dd/yyyy HH:mi | Yes|
|partnerId |	The ID of the partner who owns the data	| A valid partner ID (an integer) |Yes|
|metrics |	A comma separated list of metrics | playImpression,playRequested,play,estimatedMinutesWatched, averageViewDuration,playThrough25,playThrough50, playThrough75,playThrough100,playRatio,averageViewDropOff, segmentsWatched,percentageWatched,uniqueKnownUsers, uniquePlayerSessionId,uniqueVideos,view,dvrView,peakView, peakDvrView,bufferingTime,averageActualBitrate, loadToPlayTime | Yes|
|dimensions| 	A comma-separated list of dimensions |partner, entry, device, operatingSystem, browser, country, city, syndicationDomain, referrer, application, category, playbackContext, day, hour, minute, tenSeconds. The following dimension combinations are supported: application-playbackContext; country-browser; country-OS; country-OS-browser; device-OS; OS-browser; entry-application; entry-application-playbackContext; entry-browser; entry-category; entry-country; entry-city;  entry-device;  entry-device-OS;  entry-customVar; entry-domain; entry-domain-referrer; entry-OS; entry-OS-browser; entry-playbackContext    |No|
|filters |	A comma-separated list of filters |N/A |No |
|timezoneOffset	 |The timezone offset from UTC (GMT) |	Any integer value of an offset between UTC-12 and UTC+14 | No |

### Code Example (Java)

KalturaConfiguration config = new KalturaConfiguration();

config.setEndpoint("https://www.kaltura.com/");

KalturaClient client = new KalturaClient(config);

client.setKs("<KS GOES HERE>");

KalturaAnalyticsFilter filter = new KalturaAnalyticsFilter();

filter.from_time = "06/10/2016 00:00";

filter.to_time = "06/12/2016 00:00";

filter.metrics = "play,playRequested,playerImpression";

filter.utcOffset = 0;

filter.dimensions = "entry,hour";

KalturaReportResponse result = client.getAnalyticsService().query(filter);

System.out.println(result.columns);

for (KalturaString ks : result.results) {

    System.out.println(ks.value);
    
}

