---
layout: page
---

## Tracks Selection

This document describes the steps required for adding support for the multi-audio and captions functionality in your application on iOS devices.

### Get Available Tracks

To get the available captions and audio tracks, register to the 'PlayerEvents.tracksAvailable' event on the player as follows:

>swift

```swift
self.player.addObserver(self, events: [PlayerEvents.tracksAvailable.self], block: { (event: Any) -> Void in
  if let eventData = event as? PlayerEvents.tracksAvailable {
     self.audioTracks = eventData.tracks.audioTracks
     self.captions = eventData.tracks.textTracks
     //configure UI with the result
  }
})

```
>objc

```objc


```

### Change Track

To switch between tracks, use the following code:

>swift

```swift

// Audio Tracks
self.player.selectTrack(trackId: self.audioTracks[index].id)

// Text Tracks
self.player.selectTrack(trackId: self.captions[index].id)

```
>objc

```objc


```

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
