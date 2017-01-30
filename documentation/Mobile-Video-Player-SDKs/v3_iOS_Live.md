---
layout: page
---

## Implementing the Live Stream Functionality  

The Kaltura Live functionality is automatically supported on iOS devices, so that once you receive the live stream, you won't need to perform any additional configurations on the Kaltura Video Player.

### Live Stream Duration

The duration value of the video player will show the buffer size, which you can then use to seek content backwards.
The value of the video player's current time will show the relative position to the buffer; i.e., the currentTime = 0 means the left (furthest back) edge of the buffer, while currentTime = duration represents the live edge.

### Live Stream without DVR

If your live stream doesn't have DVR, add the live edge as follows:

>swift

```swift
self.player?.seek(to: CMTime(seconds: 999999, preferredTimescale: 1))

```
>objc

```objc


```

</br>

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
