---
layout: page
title: Kaltura Analytics - Metrics Lexicon
---

| Name     | ID     | Description
|:---|:---|:---|
|Play Impression|	playImpression|	The number of times the video player was loaded.|
|Play Requested |playRequested |The number of times that the "Play" button is triggered either manually or automatically. The requested content could be ad content or the actual video content.A plays requested is counted regardless of which type of content is requested to play. Plays requested will not include the Replay event.|
|Play	|play	|The number of times that actual non-ad video content starts playing. If the user initiates the playback experience and only watches a pre-roll ad without continuing on to the actual video content, a Plays Requested event is reported, but not a Play. Video Starts is only recorded if the user waits until the actual video starts playing back.|
|Estimated Minutes Watched|	estimatedMinutesWatched|	The sum of minutes that actual video content were watched across all the users viewing this content across the different platforms.|
|Average View Duration|	averageViewDuration	|The average time watched across all the users viewing this content across the different platforms. Computed by: estimatedMinutesWatched/60/plays|
|Play-through 25%	|playThrough25	|The number of video plays for the selected video assets that reached the state of 25% of completion.|
|Play-through 50%	|playThrough50	|The number of video plays for the selected video assets that reached the state of 50% of completion.|
|Play-through 75%	|playThrough75 |	The number of video plays for the selected video assets that reached the state of 75% of completion.|
|Play-through 100%|	playThrough100|	The number of video plays for the selected video assets that reached the state of 100% of completion.|
|Play Ratio	|playRatio|	The number of Plays divided by the number of Player Impressions|
||
||
||
||
||
