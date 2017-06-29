---
layout: page
---

## Implementing the Live Stream Functionality  

The Kaltura live functionality is automatically supported, so that once you receive the live stream, you won't need to perform any additional configurations on the player.

### Live Stream Duration

The duration value of the video player will show the seekable time range size, which you can then use to seek content backwards.
The value of the video player's current time will show the relative position to the time range; i.e., the currentTime = 0 means the left (furthest back) edge of the time range, while currentTime = duration represents the live edge.

### Best Practices and Guidelines

You can seek to the live edge as follows:

>swift

```swift
self.player.currentTime = self.player.duration
```
>objc

```objc
self.player.currentTime = self.player.duration;
```

Guidelines:
- The current time may sometimes exceed the player's duration because the duration in live is based on seekable times ranges of the asset which are constantly changing in live, therefore in some situtation for example the duration can be 100s and the current time 104s, this difference usually doesn't exceeds 10s when we are on the live edge of the stream.
- Current time in live streams is relative to the seekble time ranges. </br>
For example, after playing 30 minutes with a window size of 10 minutes we will have this seekable time range:</br>
[20 minutes - 30 minutes].</br>
The live edge in this scenario is 10 minutes (or 10 * 60 in seconds) and the duration is also 10 minutes (the duration is always the size of our seekable range window) because our current time is relative to our start range. 
If we were to move 5 minutes backwards the current time would be 5 minutes (5 * 60 in seconds),

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
