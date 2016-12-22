---
layout: page
title: Getting available captions and audio tracks in iOS Devices
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required for adding support for the multi-audio and captions functionality in your application on iOS devices.

1. In order to get the available tracks, register to 'PlayerEvents.tracksAvailable' event on the player:

```
self.player.addObserver(self, events: [PlayerEvents.tracksAvailable.self], block: { (event: Any) -> Void in
  if let eventData = event as? PlayerEvents.tracksAvailable {
     self.audioTracks = eventData.tracks.audioTracks
     self.captions = eventData.tracks.textTracks
     //configure UI with the result
  }
})
```

2. In order to switch between tracks, use the following code:

```
self.player.selectTrack(trackId: self.audioTracks[index].id)

or

self.player.selectTrack(trackId: self.captions[index].id)
```
