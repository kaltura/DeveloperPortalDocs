---
layout: page
title: Configuring Kaltura Live Support on iOS Devices
subcat: SDK 3.0 (Beta) - iOS
weight: 301
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

The Kaltura Live functionality is automatically supported on iOS devices, so that once you receive the live stream, you won't need to perform any additional configurations on the Kaltura Video Player.

The duration value of the video player will show the buffer size, which you can then use to seek backwards.
The value of the video player's current time will show the relative position to the buffer; i.e., the currentTime = 0 means the left (furthest back) edge of the buffer, while currentTime = duration represents the live edge.

If your live stream doesn't have DVR, add the live edge as follows:
```
self.player?.seek(to: CMTime(seconds: 999999, preferredTimescale: 1))
```

