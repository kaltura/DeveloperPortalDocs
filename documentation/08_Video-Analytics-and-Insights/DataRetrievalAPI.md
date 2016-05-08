---
layout: page
title: Kaltura Analytics - Data Retrieval API
---
## Overview
The Kaltura Analytics Data Retrieval API provides a simple but powerful tool to query data programmatically using the standards of the Kaltura API, such as authentication, client libraries, etc.

## Endpoint
http://www.kaltura.com/api_v3/index.php?service=analytics&action=getData

### Input


| Parameter     | DescriptionD     | Expected Values | Mandatory |
|:---|:---|:---|:---|
|startDate|	 start date from which to fetch the data|	The	date and time with the format yyyyMMdd-HH24:mi:ss| Yes |
|endDate |	The end date until which to fetch the data	|A date and time with the format yyyyMMdd-HH24:mi:ss | Yes|
|partnerId |	The ID of the partner who owns the data	| A valid partner ID (an integer) |Yes|
|metrics |	A comma separated list of metrics | playImpression,playRequested,play,estimatedMinutesWatched, averageViewDuration,playThrough25,playThrough50, playThrough75,playThrough100,playRatio,averageViewDropOff, segmentsWatched,percentageWatched,uniqueKnownUsers, uniquePlayerSessionId,uniqueVideos,view,dvrView,peakView, peakDvrView,bufferingTime,averageActualBitrate, loadToPlayTime | Yes|
|dimensions| 	A comma-separated list of dimensions	|partner,entry,knownUserId,device,operatingSystem,browser,country,city,syndicationDomain,syndicationURL,application,category,playbackContext,day,hour,minute,10sec,streamingProtocol,expectedQuality,uiConfID |No|
|filters |	A comma-separated list of filters | | |
|pagination|	Index, number of rows |Two comma separated numbers [i,n], such as i >= 0 and n > 0. For example: the value 0,20 will cause the API to return the first 20 rows | No|
|sorting |A comma-separated list of sorting fields |Supported dimension/metrics to sort the results by. Each field can be prepended with + or - to denote ascending or descending sorting | No |
|timezoneOffset	The timezone offset from UTC (GMT) |	Any integer value of an offset between UTC-12 and UTC+14 | No |

	
