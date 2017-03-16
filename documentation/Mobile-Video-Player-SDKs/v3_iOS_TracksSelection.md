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
- (void)handleTracks {
    // don't forget to use weak self to prevent retain cycles when needed
    __weak __typeof(self) weakSelf = self;
    
    // add observer to tracksAvailable event
    [self.player addObserver:self events:@[PlayerEvent.tracksAvailable] block:^(PKEvent * _Nonnull event) {
        if ([event isKindOfClass:PlayerEvent.tracksAvailable]) {
            // Extract Audio Tracks
            if (event.tracks.audioTracks) {
                weakSelf.audioTracks = event.tracks.audioTracks;
            }
            // Extract Text Tracks
            if (event.tracks.textTracks) {
                weakSelf.textTracks = event.tracks.textTracks;
            }
        }
    }];
}
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
// Select Track
- (void)selectTrack:(Track *)track {
    [self.player selectTrackWithTrackId:track.id];
}
```

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
