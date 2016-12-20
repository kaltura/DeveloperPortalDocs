---
layout: page
title: Live support in iOS devices
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required for adding support for the Live functionality on iOS devices.

Once you get the live stream, no additional configurations required for the player.
The value of duration of the player will present the buffer size, that you can seek backwards
The value of current time of the player will present the relative position to the buffer, i.e. currentTime = 0 for left edge of the buffer. while currentTime = duration is represents live edge
If your live stream doesn't have DVR, the way to be stick to live edge is:
```
self.player?.seek(to: CMTime(seconds: 999999, preferredTimescale: 1))
```

