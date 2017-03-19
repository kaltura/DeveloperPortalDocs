---
layout: page
---

## Tracks Selection

This document describes the steps required for adding support for the multi-audio and captions functionality in your application on iOS devices.

### Get Available Tracks

To get the available captions and audio tracks, register to the 'PlayerEvents.tracksAvailable' event on the player as follows:

>swift

```swift
func handleTracks() {
    self.addObserver(self, events: [PlayerEvent.tracksAvailable]) { [weak self] event in
        if type(of: event) == PlayerEvent.tracksAvailable {
            guard let tracks = event.tracks else {
                print("No Tracks Available")
                return
            }
            
            if let audioTracks = tracks.audioTracks {
                self.audioTracks = audioTracks
            }
            
            if let textTracks = tracks.textTracks {
                self.textTracks = textTracks
            }
        }
    }
}
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

### Select Track

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

### Get Current Tracks

>swift

```swift
// Get Current Audio/Text Track
let currentAudioTrack = self.player.currentAudioTrack
let currentTextTrack = self.player.currentTextTrack
```
>objc

```objc
// Get Current Audio/Text Track
NSString *currentAudioTrack = self.player.currentAudioTrack;
NSString *currentTextTrack = self.player.currentTextTrack;
```

### Get Current Bitrate

>swift

```swift
// Get Current Bitrate
func currentBitrateHandler() {
    self.addObserver(self, events: [PlayerEvent.playbackParamsUpdated]) { [weak self] event in
        if type(of: event) == PlayerEvent.tracksAvailable {
            // Get Current Bitrate Value
            if let currentBitrate = event.currentBitrate {
                print("currentBitrate: ", currentBitrate)
            }
        }
    }
}
```
>objc

```objc
// Get Current Bitrate
- (void)currentBitrateHandler {   
    [self.player addObserver:self events:@[PlayerEvent.playbackParamsUpdated] block:^(PKEvent * _Nonnull event) {
        if ([event isKindOfClass:PlayerEvent.playbackParamsUpdated]) {
            // Get Current Bitrate Value
            if (event.currentBitrate) {
                NSLog(@"%@", event.currentBitrate);
            }
        }
    }];
}
```

## Code Sample

[PlayKit iOS Tracks Sample](https://github.com/kaltura/playkit-ios-samples/tree/master/TracksSample) repo has a dedicated samples with more details.

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
