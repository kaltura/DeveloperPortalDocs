---
layout: page
title: Kaltura Video Insights - Metrics Lexicon
weight: 120
subcat: Analytics API - Limited Alpha
---

*The below metrics are part of Kaltura's new analytics platform.*
*This service is still being stabilized.*
*If you have any questions or encounter any issues, please write to VPaaS@kaltura.com.*

| Name     | ID     | Description
|:---|:---|:---|
|Player Impression|	playerImpression|	The number of times the video player was loaded.|
|Play Requested |playRequested |The number of times that the "Play" button is triggered either manually or automatically. The requested content could be ad content or the actual video content.A plays requested is counted regardless of which type of content is requested to play. Plays requested will not include the Replay event.|
|Play	|play	|The number of times that actual non-ad video content starts playing. If the user initiates the playback experience and only watches a pre-roll ad without continuing on to the actual video content, a Plays Requested event is reported, but not a Play. Video Starts is only recorded if the user waits until the actual video starts playing back.|
|Estimated Minutes Watched|	estimatedMinutesWatched|	The sum of minutes that actual video content were watched across all the users viewing this content across the different platforms.|
|Average View Duration|	averageViewDuration	|The average time watched across all the users viewing this content across the different platforms. Computed by: estimatedMinutesWatched/60/plays|
|Play-through 25%	|playThrough25	|The number of video plays for the selected video assets that reached the state of 25% of completion.|
|Play-through 50%	|playThrough50	|The number of video plays for the selected video assets that reached the state of 50% of completion.|
|Play-through 75%	|playThrough75 |	The number of video plays for the selected video assets that reached the state of 75% of completion.|
|Play-through 100%|	playThrough100|	The number of video plays for the selected video assets that reached the state of 100% of completion.|
|Play Ratio	|playRatio|	The number of Plays divided by the number of Player Impressions|
|Average View Drop-Off	|averageViewDropOff	|The viewing drop percentage to consider, relatively, 25%, 50%, 75% play-through weights.
(0.25*playThrough25 + 0.25*playThrough50 + 0.25*playThrough75 + 0.25*playThrough100%) / Plays|
|View	|view	|The number of people that are watching right now a broadcast / live event or viewing on-demand content|
|Peak View|	peakView	|The maximum number of real-time viewers watched a broadcast / live event or viewing on-demand content in any given minute to this moment.|
