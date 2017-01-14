---
layout: page
title: iOS Google Cast Subtitles Support
subcat: SDK 2.0 - iOS
weight: 240
---

This article describes how to set/ switch subtitles on when casting to Chromecast device.

## Get Subtitles

### Make sure you impliment **KCastProviderDelegate** 

To get subtitles dictionary you should impliment the following delegate method:

```objective_c    
- (void)castProvider:(KCastProvider *)provider availableTextTracks:(NSDictionary *)subtitles {
    // here you get subtitles
}
```

## Set/ Switch Subtitle

To set/ switch chosen subtitle from your menu on Chromecast device please use:

```objective_c    
[_player.castProvider switchTextTrack:{selected_index}];
```
